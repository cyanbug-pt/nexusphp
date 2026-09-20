<?php

namespace Tests\Unit;

use Nexus\Database\TorrentCountCache;
use Nexus\Tracker\AnnounceUserUpdater;
use PHPUnit\Framework\TestCase;

class TrackerPerformanceTest extends TestCase
{
    public function testPresenceIsThrottledPerUserAndExpires(): void
    {
        $redis = new PerformanceRedisFake();
        $writes = 0;
        $write = function () use (&$writes) { $writes++; return true; };
        $this->assertTrue(AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:00'", $write));
        $this->assertFalse(AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:01'", $write));
        $this->assertTrue(AnnounceUserUpdater::update($redis, 2, [], "'2026-09-20 01:00:01'", $write));
        $redis->now = 60;
        $this->assertTrue(AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:01:00'", $write));
        $this->assertSame(3, $writes);
    }

    public function testAccountingAndOtherBusinessFieldsBypassPresenceThrottle(): void
    {
        $redis = new PerformanceRedisFake();
        AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:00'", fn () => true);
        $fields = ['uploaded = uploaded + 123', 'downloaded = downloaded + 456', 'clientselect = 2'];
        $calls = 0;
        for ($i = 0; $i < 2; $i++) {
            $this->assertTrue(AnnounceUserUpdater::update($redis, 1, $fields, "'2026-09-20 00:59:59'", function ($actual) use ($fields, &$calls) {
                $calls++;
                $this->assertSame($fields, array_slice($actual, 0, 3));
                $this->assertSame("last_announce_at = GREATEST(COALESCE(last_announce_at, '2026-09-20 00:59:59'), '2026-09-20 00:59:59')", $actual[3]);
                return true;
            }));
        }
        $this->assertSame(2, $calls);
    }

    public function testDatabaseFailureReleasesOwnLockAndPropagates(): void
    {
        $redis = new PerformanceRedisFake();
        try {
            AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:00'", function () { throw new \RuntimeException('database failure'); });
            $this->fail('Database exception must propagate');
        } catch (\RuntimeException $e) {
            $this->assertSame('database failure', $e->getMessage());
        }
        $this->assertTrue(AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:00'", fn () => true));
    }

    public function testFalseDatabaseResultAlsoReleasesLock(): void
    {
        $redis = new PerformanceRedisFake();
        $this->assertFalse(AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:00'", fn () => false));
        $this->assertTrue(AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:00'", fn () => true));
    }

    public function testFailedOldRequestDoesNotDeleteNewOwnerLock(): void
    {
        $redis = new PerformanceRedisFake();
        AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:00'", function () use ($redis) {
            $redis->set('announce_user_presence:v1:1', 'new-owner', ['ex' => 60]);
            return false;
        });
        $this->assertFalse(AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:01'", fn () => true));
    }

    public function testRedisFailureFallsBackToDatabase(): void
    {
        $redis = new PerformanceRedisFake();
        $redis->unavailable = true;
        $calls = 0;
        $this->assertTrue(AnnounceUserUpdater::update($redis, 1, [], "'2026-09-20 01:00:00'", function () use (&$calls) { $calls++; return true; }));
        $this->assertSame(1, $calls);
    }

    public function testZeroCountsAreCachedAndExpire(): void
    {
        $cache = new PerformanceCountCacheFake();
        $calls = 0;
        $load = function () use (&$calls) { $calls++; return 0; };
        $this->assertSame(0, TorrentCountCache::count($cache, [1, 2], 'sql', $load));
        $this->assertSame(0, TorrentCountCache::count($cache, [1, 2], 'sql', $load));
        $this->assertSame(1, $calls);
        $cache->now = 15;
        TorrentCountCache::count($cache, [1, 2], 'sql', $load);
        $this->assertSame(2, $calls);
    }

    public function testCountsAreIsolatedByUserPermissionsAndFullSql(): void
    {
        $cache = new PerformanceCountCacheFake();
        $calls = 0;
        $load = function () use (&$calls) { return ++$calls; };
        $this->assertSame(1, TorrentCountCache::count($cache, [1, 2], 'sql', $load));
        $this->assertSame(2, TorrentCountCache::count($cache, [2, 2], 'sql', $load));
        $this->assertSame(3, TorrentCountCache::count($cache, [1, 3], 'sql', $load));
        $this->assertSame(4, TorrentCountCache::count($cache, [1, 2], 'different sql', $load));
        $this->assertSame(1, TorrentCountCache::count($cache, [1, 2], 'sql', $load));
    }

    public function testCountCacheFailureDoesNotBreakQuery(): void
    {
        $cache = new PerformanceCountCacheFake();
        $cache->unavailable = true;
        $this->assertSame(42, TorrentCountCache::count($cache, [1], 'sql', fn () => 42));
    }

    public function testCountSqlFailureIsNotCached(): void
    {
        $cache = new PerformanceCountCacheFake();
        try {
            TorrentCountCache::count($cache, [1], 'sql', function () { throw new \RuntimeException('sql failure'); });
            $this->fail('SQL exception must propagate');
        } catch (\RuntimeException $e) {
            $this->assertSame('sql failure', $e->getMessage());
        }
        $this->assertSame(42, TorrentCountCache::count($cache, [1], 'sql', fn () => 42));
    }
}

class PerformanceRedisFake
{
    public int $now = 0;
    public bool $unavailable = false;
    private array $values = [];

    public function set($key, $value, $options)
    {
        if ($this->unavailable) { throw new \RuntimeException('redis unavailable'); }
        if (in_array('nx', $options, true) && ($this->values[$key][1] ?? 0) > $this->now) { return false; }
        $this->values[$key] = [$value, $this->now + $options['ex']];
        return true;
    }

    public function eval($script, $args, $numKeys)
    {
        if (($this->values[$args[0]][0] ?? null) === $args[1]) { unset($this->values[$args[0]]); return 1; }
        return 0;
    }
}

class PerformanceCountCacheFake
{
    public int $now = 0;
    public bool $unavailable = false;
    private array $values = [];

    public function get_value($key)
    {
        if ($this->unavailable) { throw new \RuntimeException('cache unavailable'); }
        return ($this->values[$key][1] ?? 0) > $this->now ? (string) $this->values[$key][0] : false;
    }

    public function cache_value($key, $value, $ttl)
    {
        if ($this->unavailable) { throw new \RuntimeException('cache unavailable'); }
        $this->values[$key] = [$value, $this->now + $ttl];
    }
}

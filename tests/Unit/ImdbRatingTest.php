<?php

namespace Tests\Unit;

use Nexus\Imdb\Imdb;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

#[RunTestsInSeparateProcesses]
#[PreserveGlobalState(false)]
class ImdbRatingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        require __DIR__ . '/fixtures/imdb_helpers.php';
        class_alias(ImdbTestCache::class, 'Nexus\\Database\\NexusDB');
        class_alias(ImdbTestQueue::class, 'Nexus\\Nexus');
        class_alias(ImdbTestJob::class, 'App\\Jobs\\FetchImdbCacheJob');
    }

    public function testTraditionalEntryUsesNexusQueue(): void
    {
        define('IN_NEXUS', true);
        $this->imdb()->queueFetchIfMissing('tt12345');

        self::assertCount(1, ImdbTestQueue::$jobs);
        self::assertSame('12345', ImdbTestQueue::$jobs[0]->imdbId);
        self::assertNull(ImdbTestQueue::$jobs[0]->torrentId);
        self::assertSame([], ImdbTestJob::$dispatched);
        self::assertSame(600, ImdbTestCache::$ttl['imdb:fetch_queue:12345']);
    }

    public function testLaravelEntryUsesBusDispatch(): void
    {
        define('IN_NEXUS', false);
        $this->imdb()->queueFetchIfMissing(12345);

        self::assertCount(1, ImdbTestJob::$dispatched);
        self::assertSame('12345', ImdbTestJob::$dispatched[0]->imdbId);
        self::assertSame([], ImdbTestQueue::$jobs);
    }

    public function testInvalidIdDoesNotQueueOrLock(): void
    {
        define('IN_NEXUS', true);
        $this->imdb()->queueFetchIfMissing('invalid');

        self::assertSame([], ImdbTestCache::$values);
        self::assertSame([], ImdbTestQueue::$jobs);
    }

    public function testExistingLockDoesNotQueueAgain(): void
    {
        define('IN_NEXUS', true);
        ImdbTestCache::$values['imdb:fetch_queue:12345'] = 1;
        $this->imdb()->queueFetchIfMissing(12345);

        self::assertSame([], ImdbTestQueue::$jobs);
        self::assertSame([], ImdbTestCache::$ttl);
    }

    public function testTraditionalQueueFailureReleasesLockWithoutAbortingPage(): void
    {
        define('IN_NEXUS', true);
        ImdbTestQueue::$fail = true;
        $this->imdb()->queueFetchIfMissing(12345);

        self::assertArrayNotHasKey('imdb:fetch_queue:12345', ImdbTestCache::$values);
        self::assertSame('error', ImdbTestLog::$entries[0][0]);
    }

    public function testLaravelQueueFailureReleasesLockWithoutAbortingPage(): void
    {
        define('IN_NEXUS', false);
        ImdbTestJob::$fail = true;
        $this->imdb()->queueFetchIfMissing(12345);

        self::assertArrayNotHasKey('imdb:fetch_queue:12345', ImdbTestCache::$values);
        self::assertSame('error', ImdbTestLog::$entries[0][0]);
    }

    public function testCachedRatingIsPreserved(): void
    {
        $imdb = $this->ratingImdb();
        $imdb->method('getCacheStatus')->willReturn(1);
        $imdb->method('getMovie')->willReturn(new class {
            public function rating(): float { return 8.5; }
        });

        self::assertSame(8.5, $imdb->getRating(12345));
    }

    public function testRatingErrorReturnsUnavailableInsteadOfAbortingPage(): void
    {
        $imdb = $this->ratingImdb();
        $imdb->method('getCacheStatus')->willReturn(1);
        $imdb->method('getMovie')->willReturn(new class {
            public function rating(): float { throw new \Error('IMDb method unavailable'); }
        });

        self::assertSame('N/A', $imdb->getRating(12345));
        self::assertSame('error', ImdbTestLog::$entries[0][0]);
    }

    public function testCacheFailureReturnsUnavailableInsteadOfAbortingPage(): void
    {
        $imdb = $this->ratingImdb();
        $imdb->method('getCacheStatus')->willThrowException(new RuntimeException('Cache unavailable'));

        self::assertSame('N/A', $imdb->getRating(12345));
        self::assertSame('error', ImdbTestLog::$entries[0][0]);
    }

    private function imdb(): Imdb
    {
        return (new ReflectionClass(Imdb::class))->newInstanceWithoutConstructor();
    }

    private function ratingImdb(): Imdb
    {
        return $this->getMockBuilder(Imdb::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getCacheStatus', 'getMovie'])
            ->getMock();
    }
}

class ImdbTestCache
{
    public static array $values = [];
    public static array $ttl = [];

    public static function cache_get($key) { return self::$values[$key] ?? null; }
    public static function cache_put($key, $value, $ttl): void
    {
        self::$values[$key] = $value;
        self::$ttl[$key] = $ttl;
    }
    public static function cache_del($key): void { unset(self::$values[$key]); }
}

class ImdbTestQueue
{
    public static array $jobs = [];
    public static bool $fail = false;

    public static function dispatchQueueJob($job): void
    {
        if (self::$fail) { throw new RuntimeException('Queue unavailable'); }
        self::$jobs[] = $job;
    }
}

class ImdbTestJob
{
    public static array $dispatched = [];
    public static bool $fail = false;

    public function __construct(public ?int $torrentId, public string $imdbId) {}

    public static function dispatch($torrentId, $imdbId): void
    {
        if (self::$fail) { throw new RuntimeException('Bus unavailable'); }
        self::$dispatched[] = new self($torrentId, $imdbId);
    }
}

class ImdbTestLog
{
    public static array $entries = [];
}

<?php

namespace Nexus\Tracker;

/** Coalesce presence-only writes; accounting changes always reach the database. */
final class AnnounceUserUpdater
{
    public const INTERVAL_SECONDS = 60;

    public static function update($redis, int $userId, array $updates, string $quotedTime, callable $write): bool
    {
        $presenceOnly = $updates === [];
        $key = "announce_user_presence:v1:$userId";
        $token = bin2hex(random_bytes(16));
        $ownsLock = false;
        if ($presenceOnly) {
            try {
                $ownsLock = (bool) $redis->set($key, $token, ['nx', 'ex' => self::INTERVAL_SECONDS]);
                if (!$ownsLock) {
                    return false;
                }
            } catch (\Throwable $e) {
                // Cache outages must not prevent a database update.
            }
        }

        // An older, slower request must not move the timestamp backwards.
        $updates[] = "last_announce_at = GREATEST(COALESCE(last_announce_at, $quotedTime), $quotedTime)";
        $success = false;
        try {
            $success = $write($updates) !== false;
            if ($success && !$presenceOnly) {
                try {
                    $redis->set($key, $token, ['ex' => self::INTERVAL_SECONDS]);
                } catch (\Throwable $e) {
                    // Accounting has already been committed.
                }
            }
            return $success;
        } finally {
            if (!$success && $ownsLock) {
                try {
                    // Do not remove a newer request's lock after ours expired.
                    $redis->eval(
                        "if redis.call('get', KEYS[1]) == ARGV[1] then return redis.call('del', KEYS[1]) else return 0 end",
                        [$key, $token],
                        1
                    );
                } catch (\Throwable $e) {
                    // A remaining presence-only lock expires within 60 seconds.
                }
            }
        }
    }
}

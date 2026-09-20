<?php

namespace Nexus\Database;

/** Cache totals only; torrent rows and authorization remain live queries. */
final class TorrentCountCache
{
    public const TTL_SECONDS = 15;

    public static function count($cache, array $userContext, string $sql, callable $load): int
    {
        $key = 'torrent_list_count:v1:' . hash('sha256', serialize([$userContext, $sql]));
        try {
            $cached = $cache->get_value($key);
            // The application's Redis adapter returns numeric values as strings.
            if ((is_int($cached) || (is_string($cached) && ctype_digit($cached))) && $cached >= 0) {
                return (int) $cached;
            }
        } catch (\Throwable $e) {
            // Fall back to SQL if the optional cache is unavailable.
        }

        $count = (int) $load();
        try {
            $cache->cache_value($key, $count, self::TTL_SECONDS);
        } catch (\Throwable $e) {
            // A cache write failure must not break the page.
        }
        return $count;
    }
}

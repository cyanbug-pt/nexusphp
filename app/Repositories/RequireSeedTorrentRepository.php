<?php

namespace App\Repositories;

use App\Models\RequireSeedTorrent;
use App\Models\Setting;
use App\Models\Torrent;
use App\Models\UserRequireSeedTorrent;
use Illuminate\Support\Collection;
use Nexus\Database\NexusDB;

class RequireSeedTorrentRepository extends BaseRepository
{
    public function autoAddToListCronjob(): void
    {
        $logPrefix = "[RequireSeedTorrentRepository.autoAddToListCronjob]";
        $enabled = Setting::getIsRequireSeedSectionEnabled();
        if (!$enabled) {
            do_log("$logPrefix, not enabled");
            return;
        }
        $countMaxAllowed = Setting::getRequireSeedSectionTorrentCountMax();
        $countNow = RequireSeedTorrent::query()->count();
        if ($countNow >= $countMaxAllowed) {
            do_log("$logPrefix, max allowed $countMaxAllowed reached");
            return;
        }
        $count = $countMaxAllowed - $countNow;
        $seederMax = Setting::getRequireSeedSectionSeederLte();
        $seederMin = Setting::getRequireSeedSectionSeederGte();
        $logPrefix .= ", countMaxAllowed: $countMaxAllowed, countNow: $countNow, count: $count, seederMax: $seederMax, seederMin: $seederMin";
        $query = Torrent::query()->where('banned', 'no')
            ->where('seeders', '<=', $seederMax)
            ->where('seeders', '>=', $seederMin)
        ;
        $tags = Setting::getRequireSeedSectionTags();
        if (!empty($tags)) {
            $logPrefix .= ", tags: " . implode(',', $tags);
            $query->whereHas('torrent_tags', function ($query) use ($tags) {
                $query->whereIn('tag_id', $tags);
            });
        }
        $list = $query->leftJoin("require_seed_torrents", "torrents.id", "=", "require_seed_torrents.torrent_id")
            ->whereNull("require_seed_torrents.id")
            ->orderBy('torrents.seeders', 'asc')
            ->orderBy('torrents.times_completed', 'desc')
            ->orderBy('torrents.hits', 'desc')
            ->limit($count)
            ->get(['torrents.id'])
        ;
        $data = [];
        $nowStr = now()->toDateTimeString();
        $redis = NexusDB::redis();
        $cacheKey = self::getTorrentCacheKey();
        foreach ($list as $item) {
            $data[] = [
                'torrent_id' => $item->id,
                'created_at' => $nowStr,
                'updated_at' => $nowStr,
            ];
            $redis->hset($cacheKey, $item->id, $nowStr);
        }
        RequireSeedTorrent::query()->insert($data);
        do_log("$logPrefix, success inserted: " . count($data));
    }

    public function autoRemoveFromListCronjob(): void
    {
        $idArr = RequireSeedTorrent::query()->pluck('torrent_id')->toArray();
        if (empty($idArr)) {
            do_log("no data to remove");
            return;
        }
        $seederMax = Setting::getRequireSeedSectionSeederLte();
        $seederMin = Setting::getRequireSeedSectionSeederGte();
        $torrents = Torrent::query()->whereIn('id', $idArr)
            ->where('seeders', '<', $seederMin)
            ->get(['id'])
        ;
        if (!empty($torrents)) {
            $this->doRemove($torrents);
            do_log(sprintf("remove %s seeders < %s", count($torrents), $seederMin));
        }
        $torrents = Torrent::query()->whereIn('id', $idArr)
            ->where('seeders', '>', $seederMax)
            ->get(['id'])
        ;
        if (!empty($torrents)) {
            $this->doRemove($torrents);
            do_log(sprintf("remove %s seeders > %s", count($torrents), $seederMax));
        }
    }

    public function doRemove(Collection $torrents): void
    {
        $idArr = [];
        $redis = NexusDB::redis();
        $promotionState = Setting::getRequireSeedSectionPromotionState();
        $ttlInSeconds = 24 * 3600;
        foreach ($torrents as $torrent) {
            $idArr[] = $torrent->id;
            $promotionStateCacheKey = sprintf("%s:%s", Torrent::REQUIRE_SEED_SECTION_PROMOTION_STATE_CACHE_KEY, $torrent->id);
            $redis->setex($promotionStateCacheKey, $ttlInSeconds, $promotionState);
            //remove torrent from list
            $redis->hDel(self::getTorrentCacheKey(), $torrent->id);
            //remove all users under torrent
            $redis->del(self::getTorrentUserCacheKey($torrent->id));
        }
        RequireSeedTorrent::query()->whereIn('torrent_id', $idArr)->delete();
        UserRequireSeedTorrent::query()->whereIn('torrent_id', $idArr)->delete();
        do_log("success removed " . count($idArr));
    }

    private static function getTorrentCacheKey(): string
    {
        return Torrent::REQUIRE_SEED_SECTION_TORRENT_ON_LIST_CACHE_KEY;
    }

    private static function getTorrentUserCacheKey($torrentId): string
    {
        return sprintf("%s:%s", Torrent::REQUIRE_SEED_SECTION_TORRENT_USER_CACHE_KEY, $torrentId);
    }

    public static function shouldRecordUser(\Redis $redis, $userId, $torrentId): bool
    {
        $logPrefix = "userId: $userId, torrentId: $torrentId";
        //check enabled or not
        if (!Setting::getIsRequireSeedSectionEnabled()) {
            do_log("$logPrefix, not enabled", 'debug');
            return false;
        }
        //first, torrent on list
        $onListCacheKey = self::getTorrentCacheKey();
        if (!$redis->hExists($onListCacheKey, $torrentId)) {
            do_log("$logPrefix, torrent not on list: $onListCacheKey", 'debug');
            return false;
        }
        //second, torrent user not exists
        $torrentUserCacheKey = self::getTorrentUserCacheKey($torrentId);
        if ($redis->hExists($torrentUserCacheKey, $userId)) {
            do_log("$logPrefix, user already exists: $torrentUserCacheKey", 'debug');
            return false;
        }
        return true;
    }

    public static function recordUser(\Redis $redis, $userId, $torrentId, array $snatchedInfo): void
    {
        $torrentUserCacheKey = self::getTorrentUserCacheKey($torrentId);
        $nowStr = now()->toDateTimeString();
        $values = [
            'user_id' => $userId,
            'torrent_id' => $torrentId,
            'seed_time_begin' => $snatchedInfo['seedtime'],
            'uploaded_begin' => $snatchedInfo['uploaded'],
            'created_at' => $nowStr,
        ];
        $uniqueBy = ['user_id', 'torrent_id'];
        $update = ['updated_at'];
        UserRequireSeedTorrent::query()->upsert($values, $uniqueBy, $update);
        $redis->hset($torrentUserCacheKey, $userId, $nowStr);
        do_log("success insert user: $userId, torrent: $torrentId");
    }

    public function autoSettlementCronjob(): void
    {

    }
}

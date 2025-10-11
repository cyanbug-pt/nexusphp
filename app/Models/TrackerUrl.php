<?php

namespace App\Models;

use App\Models\Traits\NexusActivityLogTrait;
use Nexus\Database\NexusDB;

class TrackerUrl extends NexusModel
{
    use NexusActivityLogTrait;

    protected $fillable = ['url', 'enabled', 'is_default', 'priority'];

    public $timestamps = true;

    const TRACKER_URL_CACHE_KEY = "TRACKER_URL";
    const TRACKER_URL_DEFAULT_CACHE_KEY = "TRACKER_URL_DEFAULT";

    protected static function booted(): void
    {
        static::saved(function (TrackerUrl $model) {
            if ($model->is_default == 1) {
                self::query()->where("id", "!=", $model->id)->update(["is_default" => 0]);
            }
            self::saveUrlCache();
        });
        static::saving(function (TrackerUrl $model) {
            if ($model->is_default == 1) {
                $model->enabled = 1;
            }
        });
    }

    public static function saveUrlCache(): void
    {
        //添加 id 与 URL 映射
        $redis = NexusDB::redis();
        $redis->del(self::TRACKER_URL_CACHE_KEY);
        $list = self::listAll();
        $first = $list->first();
        $hasDefault = false;
        foreach ($list as $item) {
            $redis->hset(self::TRACKER_URL_CACHE_KEY, $item->id, $item->url);
            if ($item->is_default == 1) {
                $hasDefault = true;
                $redis->set(self::TRACKER_URL_DEFAULT_CACHE_KEY, $item->url);
            }
        }
        if (!$hasDefault && $first) {
            $redis->set(self::TRACKER_URL_DEFAULT_CACHE_KEY, $first->url);
        }
    }

    public static function listAll()
    {
        return self::query()
            ->where("enabled", 1)
            ->orderBy("is_default", "desc")
            ->orderBy("priority", "desc")
            ->get();
    }

    public static function getById(int $trackerUrlId)
    {
        $redis = NexusDB::redis();
        $notFoundFlagKey = "TRACKER_URL_NOT_FOUND:$trackerUrlId";
        if ($trackerUrlId == 0) {
            return self::getFromRedisWithRetry($redis, 'get', [self::TRACKER_URL_DEFAULT_CACHE_KEY], $notFoundFlagKey);
        }
        $result = self::getFromRedisWithRetry($redis, 'hGet', [self::TRACKER_URL_CACHE_KEY, $trackerUrlId], $notFoundFlagKey);
        if ($result !== false) {
            return $result;
        }
        do_log("No tracker url found for $trackerUrlId, try default", 'warning');
        return self::getFromRedisWithRetry($redis, 'get', [self::TRACKER_URL_DEFAULT_CACHE_KEY], $notFoundFlagKey);
    }

    private static function getFromRedisWithRetry(\Redis $redis, string $command, array $params, string $notFoundFlagKey)
    {
        $result = call_user_func_array([$redis, $command], $params);
        if ($result !== false) {
            return $result;
        }
        //有不存在标记，不要再尝试，直接返回 false
        if ($redis->exists($notFoundFlagKey)) {
            return false;
        }
        self::saveUrlCache();
        $result = call_user_func_array([$redis, $command], $params);
        if ($result !== false) {
            return $result;
        }
        //只从 db 拉取一次，仍然没有即标记不存在, 有效期 15 分钟
        $redis->setex($notFoundFlagKey, 900, date("Y-m-d H:i:s"));
        do_log(sprintf("redis command %s with args %s no result", $command, json_encode($params)), 'error');
        return false;
    }
}

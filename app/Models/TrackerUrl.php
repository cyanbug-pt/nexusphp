<?php

namespace App\Models;

use Nexus\Database\NexusDB;

class TrackerUrl extends NexusModel
{
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
        if ($trackerUrlId == 0) {
            return $redis->get(self::TRACKER_URL_DEFAULT_CACHE_KEY);
        }
        $result = $redis->hget(self::TRACKER_URL_CACHE_KEY, $trackerUrlId);
        if (!$result) {
            $result = $redis->get(self::TRACKER_URL_DEFAULT_CACHE_KEY);
        }
        return $result;
    }
}

<?php

namespace App\Models;

use App\Enums\ModelEventEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Nexus\Database\NexusDB;

class HitAndRun extends NexusModel
{
    protected $table = 'hit_and_runs';

    protected $fillable = ['uid', 'snatch_id', 'torrent_id', 'status', 'comment'];

    public $timestamps = true;

    const STATUS_INSPECTING = 1;
    const STATUS_REACHED = 2;
    const STATUS_UNREACHED = 3;
    const STATUS_PARDONED = 4;

    public static array $status = [
        self::STATUS_INSPECTING => ['text' => 'Inspecting'],
        self::STATUS_REACHED => ['text' => 'Reached'],
        self::STATUS_UNREACHED => ['text' => 'Unreached'],
        self::STATUS_PARDONED => ['text' => 'Pardoned'],
    ];

    const CAN_PARDON_STATUS = [
        self::STATUS_INSPECTING,
        self::STATUS_UNREACHED,
    ];

    const MODE_DISABLED = 'disabled';
    const MODE_MANUAL = 'manual';
    const MODE_GLOBAL = 'global';

    public static $modes = [
        self::MODE_DISABLED => ['text' => 'Disabled'],
        self::MODE_MANUAL => ['text' => 'Manual'],
        self::MODE_GLOBAL => ['text' => 'Global'],
    ];

    const MINIMUM_IGNORE_USER_CLASS = User::CLASS_VIP;

    protected static function booted()
    {
        static::saved(function ($model) {
            self::clearCache($model);
        });
        static::deleted(function ($model) {
            self::clearCache($model, ModelEventEnum::HIT_AND_RUN_DELETED);
        });
    }

    public static function getCacheKey(int $userId, int $torrentId): string
    {
        return sprintf("hit_and_run:user:%d:torrent:%d", $userId, $torrentId);
    }

    public static function clearCache(HitAndRun $hitAndRun, string $event = ModelEventEnum::HIT_AND_RUN_UPDATED): void
    {
        NexusDB::cache_del(self::getCacheKey($hitAndRun->uid, $hitAndRun->torrent_id));
        fire_event($event, $hitAndRun);
        do_log(sprintf(
            "userId: %s, torrentId: %s hit and run cache cleared, and trigger event: %s",
            $hitAndRun->uid, $hitAndRun->torrent_id, $event
        ));
    }

    protected function seedTimeRequired(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => $this->doGetSeedTimeRequired()
        );
    }

    protected function inspectTimeLeft(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => $this->doGetInspectTimeLeft()
        );
    }

    private function doGetInspectTimeLeft(): string
    {
        if ($this->status != self::STATUS_INSPECTING) {
            return '---';
        }
        //change to use create time
//        if (!$this->snatch->completedat) {
//            //not download completed
//            return '---';
//        }
        $searchBoxId = $this->torrent->basic_category->mode ?? 0;
        if ($searchBoxId == 0) {
            do_log(sprintf('[INVALID_CATEGORY], Torrent: %s', $this->torrent_id), 'error');
            return '---';
        }
        $inspectTime = HitAndRun::getConfig('inspect_time', $searchBoxId);
        $diffInSeconds = Carbon::now()->diffInSeconds($this->created_at->addHours(intval($inspectTime)), true);
        return mkprettytime($diffInSeconds);
    }

    private function doGetSeedTimeRequired(): string
    {
        if ($this->status != self::STATUS_INSPECTING) {
            return '---';
        }
        $searchBoxId = $this->torrent->basic_category->mode ?? 0;
        if ($searchBoxId == 0) {
            do_log(sprintf('[INVALID_CATEGORY], Torrent: %s', $this->torrent_id), 'error');
            return '---';
        }
        if (!$this->snatch) {
            do_log("hit and run: {$this->id} no snatch", 'warning');
            return '---';
        }
        $seedTimeMinimum = HitAndRun::getConfig('seed_time_minimum', $searchBoxId);
        $diffInSeconds = 3600 * $seedTimeMinimum - $this->snatch->seedtime;
        return mkprettytime($diffInSeconds);
    }

    public function getStatusTextAttribute()
    {
        return nexus_trans('hr.status_' . $this->status);
    }

    public static function listStatus($onlyKeyValue = false): array
    {
        $result = self::$status;
        $keyValues = [];
        foreach ($result as $key => &$value) {
            $text = nexus_trans('hr.status_' . $key);
            $value['text'] = $text;
            $keyValues[$key] = $text;
        }
        if ($onlyKeyValue) {
            return $keyValues;
        }
        return $result;
    }

    public static function listModes($onlyKeyValue = false): array
    {
        $result = self::$modes;
        $keyValues = [];
        foreach ($result as $key => &$value) {
            $text = nexus_trans('hr.mode_' . $key);
            $value['text'] = $text;
            $keyValues[$key] = $text;
        }
        if ($onlyKeyValue) {
            return $keyValues;
        }
        return $result;
    }

    public static function getIsEnabled(): bool
    {
        $enableSpecialSection = Setting::get('main.spsct') == 'yes';
        $browseMode = self::getConfig('mode', Setting::get('main.browsecat'));
        $browseEnabled = $browseMode && in_array($browseMode, [self::MODE_GLOBAL, self::MODE_MANUAL]);
        if (!$enableSpecialSection) {
            do_log("Not enable special section, browseEnabled: $browseEnabled");
            return $browseEnabled;
        }
        $specialMode = self::getConfig('mode', Setting::get('main.specialcat'));
        $specialEnabled =  $specialMode && in_array($specialMode, [self::MODE_GLOBAL, self::MODE_MANUAL]);
        $result = $browseEnabled || $specialEnabled;
        do_log("Enable special section, browseEnabled: $browseEnabled, specialEnabled: $specialEnabled, result: $result");
        return $result;
    }

    public static function getConfig($name, $searchBoxId)
    {
        if ($name == '*') {
            $key = "hr";
        } else {
            $key = "hr.$name";
        }
        $default = Setting::get($key);
        return apply_filter("nexus_setting_get", $default, $name, ['mode' => $searchBoxId]);
    }

    public static function diffInSection(): bool
    {
        $enableSpecialSection = Setting::get('main.spsct') == 'yes';
        return $enableSpecialSection && apply_filter("hit_and_run_diff_in_section", false);
    }

    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class, 'torrent_id');
    }

    public function snatch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Snatch::class, 'snatched_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'uid');
    }


}

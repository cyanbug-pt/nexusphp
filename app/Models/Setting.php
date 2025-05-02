<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Nexus\Database\NexusDB;

class Setting extends NexusModel
{
    protected $fillable = ['name', 'value', 'autoload'];

    public $timestamps = true;

    const PERMISSION_NO_CLASS = 100;

    public static array $permissionMustHaveClass = ['defaultclass', 'staffmem'];

    const DIRECT_PERMISSION_CACHE_KEY_PREFIX = 'nexus_direct_permissions_';
    const ROLE_PERMISSION_CACHE_KEY_PREFIX = 'nexus_role_permissions_';

    const TORRENT_GLOBAL_STATE_CACHE_KEY = 'global_promotion_state';
    const USER_TOKEN_PERMISSION_ALLOWED_CACHE_KRY = 'user_token_permission_allowed';

    /**
     * get setting autoload = yes with cache
     *
     * @param null $name
     * @param null $default
     * @return mixed
     */
    public static function get($name = null, $default = null): mixed
    {
        static $settings = null;
        if (is_null($settings)) {
            $settings = NexusDB::remember("nexus_settings_in_laravel", 600, function () {
                return self::getFromDb();
            });
        }
        if (is_null($name)) {
            return $settings;
        }
        return Arr::get($settings, $name, $default);
    }

    /**
     * get setting autoload = yes without cache
     *
     * @param null $name
     * @param null $default
     * @return mixed
     */
    public static function getFromDb($name = null, $default = null): mixed
    {
        $rows = self::query()->where('autoload', 'yes')->get(['name', 'value']);
        $result = [];
        foreach ($rows as $row) {
            $value = self::normalizeValue($row);
            Arr::set($result, $row->name, $value);
        }
        if (is_null($name)) {
            return $result;
        }
        return Arr::get($result, $name, $default);
    }

    /**
     * get from db by name, generally used for `autoload` = 'no'
     *
     * @param $name
     * @param null $default
     * @return mixed
     */
    public static function getByName($name, $default = null): mixed
    {
        $result = self::query()->where('name', $name)->first();
        if ($result) {
            return self::normalizeValue($result);
        }
        return $default;
    }

    public static function getByWhereRaw($whereRaw): array
    {
        $result = [];
        $list = self::query()->whereRaw($whereRaw)->get();
        foreach ($list as $value) {
            Arr::set($result, $value->name, self::normalizeValue($value));
        }
        return $result;
    }

    public static function normalizeValue(Setting $setting)
    {
        $value = $setting->value;
        if (!is_null($value)) {
            $arr = json_decode($value, true);
            if (is_array($arr)) {
                $value = $arr;
            }
        }
        return $value;
    }

    public static function updateUserTokenPermissionAllowedCache(array $allowed = []): void
    {
        $redis = NexusDB::redis();
        $key = self::USER_TOKEN_PERMISSION_ALLOWED_CACHE_KRY;
        $redis->del($key);
        //must not use cache
        if (empty($allowed)) {
            $allowed = self::getFromDb("permission.user_token_allowed");
        }
        if (!empty($allowed)) {
            $redis->sAdd($key, ...$allowed);
        }
    }

    public static function getDefaultLang(): string
    {
        return self::get("main.defaultlang");
    }

    public static function getIsUseChallengeResponseAuthentication(): bool
    {
        return self::get("security.use_challenge_response_authentication") == "yes";
    }

    public static function getUploadTorrentMaxSize(): int
    {
        return intval(self::get("main.max_torrent_size"));
    }

    public static function getUploadTorrentMaxPrice(): int
    {
        return intval(self::get("torrent.max_price"));
    }

    public static function getIsPaidTorrentEnabled(): bool
    {
        return self::get("torrent.paid_torrent_enabled") == "yes";
    }

    public static function getUploadDenyApprovalDenyCount(): int
    {
        return intval(self::get("main.upload_deny_approval_deny_count"));
    }

    public static function getOfferSkipApprovedCount(): int
    {
        return intval(self::get("main.offer_skip_approved_count"));
    }

    public static function getLargeTorrentSize(): int
    {
        return intval(self::get("torrent.largesize"));
    }

    public static function getLargeTorrentSpState(): int
    {
        return intval(self::get("torrent.largepro"));
    }

    public static function getUploadTorrentHalfDownProbability(): int
    {
        return intval(self::get("torrent.randomhalfleech"));
    }

    public static function getUploadTorrentFreeProbability(): int
    {
        return intval(self::get("torrent.randomfree"));
    }

    public static function getUploadTorrentTwoTimesUpProbability(): int
    {
        return intval(self::get("torrent.randomtwoup"));
    }

    public static function getUploadTorrentFreeTwoTimesUpProbability(): int
    {
        return intval(self::get("torrent.randomtwoupfree"));
    }

    public static function getUploadTorrentHalfDownTwoTimesUpProbability(): int
    {
        return intval(self::get("torrent.randomtwouphalfdown"));
    }

    public static function getUploadTorrentOneThirdDownProbability(): int
    {
        return intval(self::get("torrent.randomthirtypercentdown"));
    }

    public static function getUploadTorrentRewardBonus(): int
    {
        return intval(self::get("bonus.uploadtorrent"));
    }



    public static function getIsUploadOpenAtWeekend(): bool
    {
        return self::get("main.sptime") == "yes";
    }

    public static function getIsSpecialSectionEnabled(): bool
    {
        return self::get('main.spsct') == 'yes';
    }

    public static function getIsComplainEnabled(): bool
    {
        return self::get('main.complain_enabled') == 'yes';
    }

    public static function getIsAllowUserReceiveEmailNotification(): bool
    {
        return self::get('smtp.emailnotify') == 'yes';
    }

    public static function getBaseUrl(): string
    {
        $result = self::get('basic.BASEURL', $_SERVER['HTTP_HOST'] ?? '');
        return rtrim($result, '/');
    }

    public static function getSiteName(): string
    {
        return self::get("basic.SITENAME");
    }

    public static function getTorrentSaveDir(): string
    {
        return self::get("main.torrent_dir");
    }

    public static function getSmtpType(): string
    {
        return self::get("smtp.smtptype");
    }

    public static function getPermissionUserTokenAllowed(): array
    {
        return self::get("permission.user_token_allowed");
    }


}

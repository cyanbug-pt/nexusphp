<?php

namespace App\Models;

use Nexus\Database\NexusDB;

class Language extends NexusModel
{
    const DEFAULT_ENABLED = ['en', 'chs', 'cht'];

    const TRANS_STATE_UP_TO_DATE = 'up-to-date';
    const TRANS_STATE_OUT_DATE = 'outdate';
    const TRANS_STATE_INCOMPLETE = 'incomplete';
    const TRANS_STATE_NEED_NEW = 'need-new';
    const TRANS_STATE_UNAVAILABLE = 'unavailable';

    const CONFIG = [
        'en' => [
            'lang_name' => 'English',
            'lang_name_cn' => '英语',
            'trans_state' => self::TRANS_STATE_UP_TO_DATE,
        ],
        'chs' => [
            'lang_name' => '简体中文',
            'lang_name_cn' => '简体中文',
            'trans_state' => self::TRANS_STATE_UP_TO_DATE,
        ],
        'cht' => [
            'lang_name' => '繁體中文',
            'lang_name_cn' => '繁體中文',
            'trans_state' => self::TRANS_STATE_UP_TO_DATE,
        ],
        'ja' => [
            'lang_name' => '日本語',
            'lang_name_cn' => '日语',
            'trans_state' => self::TRANS_STATE_NEED_NEW,
        ],
        'cs' => [
            'lang_name' => 'Czech',
            'lang_name_cn' => '捷克语',
            'trans_state' => self::TRANS_STATE_INCOMPLETE,
        ]
    ];

    protected $table = 'language';

    protected $fillable = [
        'lang_name', 'site_lang_folder',
    ];

    public static function listAvailable(): array
    {
        $result = [];
        foreach (self::CONFIG as $locale => $info) {
            if ($info['trans_state'] != self::TRANS_STATE_UNAVAILABLE) {
                $result[] = $locale;
            }
        }
        return $result;
    }


    public static function listEnabled($withoutCache = false)
    {
        if ($withoutCache) {
            return Setting::getFromDb('main.site_language_enabled', self::DEFAULT_ENABLED);
        }
        return Setting::get('main.site_language_enabled', self::DEFAULT_ENABLED);
    }

    public static function updateTransStatus(): void
    {
        foreach (self::CONFIG as $locale => $info) {
            self::query()->where('site_lang_folder', $locale)->update([
                'trans_state' => $info['trans_state'],
                'site_lang' => 1,
            ]);
        }
        NexusDB::cache_del("site_lang_lang_list");
    }
}

<?php

namespace App\Models;


class SiteLog extends NexusModel
{
    protected $table = 'sitelog';

    protected $fillable = ['added', 'txt', 'security_level', 'uid'];

    public static function add($uid, $content, $isMod = false): void
    {
        self::query()->insert([
            'uid' => $uid,
            'txt' => $content,
            'security_level' => $isMod ? 'mod' : 'normal',
            'added' => now(),
        ]);
    }

}

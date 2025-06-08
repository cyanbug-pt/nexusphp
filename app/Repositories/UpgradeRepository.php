<?php
namespace App\Repositories;

class UpgradeRepository extends BaseRepository
{
    const DATETIME_INVALID_VALUE_FIELDS = [
        'comments' => ['editdate'],
        'invites' => ['time_invited'],
        'offers' => ['allowedtime'],
        'peers' => ['last_action', 'prev_action'],
        'posts' => ['editdate'],
        'snatched' => ['last_action', 'completedat'],
        'torrents' => ['last_action', 'promotion_until', 'picktime', 'last_reseed'],
        'users' => [
            'last_login', 'last_access', 'last_home', 'last_offer', 'forum_access', 'last_staffmsg',
            'last_pm', 'last_comment', 'last_post', 'donoruntil', 'warneduntil', 'noaduntil', 'vip_until',
            'leechwarnuntil', 'lastwarned',
        ],
    ];
}

<?php

namespace App\Enums;

use App\Events\NewsCreated;
use App\Events\SnatchedUpdated;
use App\Events\TorrentCreated;
use App\Events\TorrentDeleted;
use App\Events\TorrentUpdated;
use App\Events\UserCreated;
use App\Events\UserDeleted;
use App\Events\UserDisabled;
use App\Events\UserEnabled;
use App\Events\UserUpdated;
use App\Models\News;
use App\Models\Snatch;
use App\Models\Torrent;
use App\Models\User;

final class ModelEventEnum {
    const TORRENT_CREATED = 'torrent_created';
    const TORRENT_UPDATED = 'torrent_updated';
    const TORRENT_DELETED = 'torrent_deleted';

    const USER_CREATED = 'user_created';
    const USER_UPDATED = 'user_updated';
    const USER_DELETED = 'user_deleted';
    const USER_ENABLED = 'user_enabled';
    const USER_DISABLED = 'user_disabled';

    const NEWS_CREATED = 'news_created';

    const SNATCHED_UPDATED = 'snatched_updated';

    public static array $eventMaps = [
        self::TORRENT_CREATED => ['event' => TorrentCreated::class, 'model' => Torrent::class],
        self::TORRENT_UPDATED => ['event' => TorrentUpdated::class, 'model' => Torrent::class],
        self::TORRENT_DELETED => ['event' => TorrentDeleted::class, 'model' => Torrent::class],

        self::USER_CREATED => ['event' => UserCreated::class, 'model' => User::class],
        self::USER_UPDATED => ['event' => UserUpdated::class, 'model' => User::class],
        self::USER_DELETED => ['event' => UserDeleted::class, 'model' => User::class],
        self::USER_ENABLED => ['event' => UserEnabled::class, 'model' => User::class],
        self::USER_DISABLED => ['event' => UserDisabled::class, 'model' => User::class],

        self::NEWS_CREATED => ['event' => NewsCreated::class, 'model' => News::class],

        self::SNATCHED_UPDATED => ['event' => SnatchedUpdated::class, 'model' => Snatch::class],
    ];
}

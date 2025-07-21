<?php

namespace App\Enums;

use App\Events\AgentAllowCreated;
use App\Events\AgentAllowDeleted;
use App\Events\AgentAllowUpdated;
use App\Events\AgentDenyCreated;
use App\Events\AgentDenyDeleted;
use App\Events\AgentDenyUpdated;
use App\Events\HitAndRunCreated;
use App\Events\HitAndRunDeleted;
use App\Events\HitAndRunUpdated;
use App\Events\MessageCreated;
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
use App\Models\AgentAllow;
use App\Models\AgentDeny;
use App\Models\HitAndRun;
use App\Models\Message;
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

    const HIT_AND_RUN_CREATED = 'hit_and_run_created';
    const HIT_AND_RUN_UPDATED = 'hit_and_run_updated';
    const HIT_AND_RUN_DELETED = 'hit_and_run_deleted';

    const AGENT_ALLOW_CREATED = 'agent_allow_created';
    const AGENT_ALLOW_UPDATED = 'agent_allow_updated';
    const AGENT_ALLOW_DELETED = 'agent_allow_deleted';

    const AGENT_DENY_CREATED = 'agent_deny_created';
    const AGENT_DENY_UPDATED = 'agent_deny_updated';
    const AGENT_DENY_DELETED = 'agent_deny_deleted';

    const SNATCHED_UPDATED = 'snatched_updated';
    const MESSAGE_CREATED = 'message_created';

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

        self::MESSAGE_CREATED => ['event' => MessageCreated::class, 'model' => Message::class],

        self::HIT_AND_RUN_CREATED => ['event' => HitAndRunCreated::class, 'model' => HitAndRun::class],
        self::HIT_AND_RUN_UPDATED => ['event' => HitAndRunUpdated::class, 'model' => HitAndRun::class],
        self::HIT_AND_RUN_DELETED => ['event' => HitAndRunDeleted::class, 'model' => HitAndRun::class],

        self::AGENT_ALLOW_CREATED => ['event' => AgentAllowCreated::class, 'model' => AgentAllow::class],
        self::AGENT_ALLOW_UPDATED => ['event' => AgentAllowUpdated::class, 'model' => AgentAllow::class],
        self::AGENT_ALLOW_DELETED => ['event' => AgentAllowDeleted::class, 'model' => AgentAllow::class],

        self::AGENT_DENY_CREATED => ['event' => AgentDenyCreated::class, 'model' => AgentDeny::class],
        self::AGENT_DENY_UPDATED => ['event' => AgentDenyUpdated::class, 'model' => AgentDeny::class],
        self::AGENT_DENY_DELETED => ['event' => AgentDenyDeleted::class, 'model' => AgentDeny::class],
    ];
}

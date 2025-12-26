<?php

namespace App\Enums;

use function PHPUnit\Framework\matches;

enum AnnounceEventEnum: string
{
    case STARTED = "started";
    case STOPPED = "stopped";
    case PAUSED = "paused";
    case COMPLETED = "completed";
    case NONE = "none";

    public function label(): string
    {
        return match ($this) {
            self::STARTED => nexus_trans("announce_log.events.started"),
            self::STOPPED => nexus_trans("announce_log.events.stopped"),
            self::PAUSED => nexus_trans("announce_log.events.paused"),
            self::COMPLETED => nexus_trans("announce_log.events.completed"),
            self::NONE => nexus_trans("announce_log.events.none"),
            default => '',
        };
    }
}

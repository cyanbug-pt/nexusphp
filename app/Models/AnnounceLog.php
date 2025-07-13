<?php

namespace App\Models;

use App\Enums\AnnounceEventEnum;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AnnounceLog extends NexusModel
{
    protected $fillable = [
        'timestamp', 'user_id', 'passkey', 'torrent_id', 'info_hash', 'torrent_size',
        'promotion_state', 'promotion_state_desc', 'up_factor', 'up_factor_desc', 'down_factor', 'down_factor_desc',
        'event', 'peer_id',
        'uploaded_total_last', 'uploaded_total', 'uploaded_increment', 'uploaded_increment_for_user','uploaded_offset',
        'downloaded_total_last', 'downloaded_total', 'downloaded_increment', 'downloaded_increment_for_user', 'downloaded_offset',
        'announce_time', 'speed', 'ip', 'ipv4', 'ipv6', 'port', 'agent', 'left', 'started', 'prev_action', 'last_action',
        'client_select', 'seeder_count', 'leecher_count', 'scheme', 'host', 'path',
        'continent', 'country', 'city', 'request_id', 'batch_no'
    ];

    protected $table = null;
    protected $primaryKey = "request_id";

    protected $keyType = 'string';

    protected function timestamp(): Attribute
    {
        return Attribute::make(
            set: function (?string $value) {
                return $this->toLocaleTime($value, "Y-m-d H:i:s.u");
            },
        );
    }

    protected function started(): Attribute
    {
        return Attribute::make(
            set: function (?string $value) {
                return $this->toLocaleTime($value);
            },
        );
    }

    protected function prevAction(): Attribute
    {
        return Attribute::make(
            set: function (?string $value) {
                return $this->toLocaleTime($value);
            },
        );
    }

    protected function lastAction(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                return $this->toLocaleTime($value);
            },
        );
    }

    private function toLocaleTime(?string $time, string $format = "Y-m-d H:i:s"): ?string
    {
        static $fromTimezone;
        static $toTimezone;
        if ($fromTimezone == null) {
            $fromTimezone = new DateTimeZone('UTC');
        }
        if ($toTimezone == null) {
            $toTimezone = new DateTimeZone(config('app.timezone'));
        }
        if (empty($time)) {
            return $time;
        }
        // 创建 DateTime 对象
        $date = DateTime::createFromFormat($format, $time, $fromTimezone);
        // 转换时区
        $date->setTimezone($toTimezone);
        // 输出转换后的时间
        return $date->format($format);
    }

    public static function listEvents(): array
    {
        $result = [];
        foreach (AnnounceEventEnum::cases() as $event) {
            $result[$event->value] = $event->value;
        }
        return $result;
    }
}

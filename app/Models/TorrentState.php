<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;
use Nexus\Database\NexusDB;

class TorrentState extends NexusModel
{
    use NexusActivityLogTrait;

    public const NOTICE_NONE = 0;
    public const NOTICE_UNLIMITED = -1;

    protected $fillable = ['global_sp_state', 'deadline', 'begin', 'remark', 'notice_days'];

    protected $table = 'torrents_state';

    protected $casts = [
        'begin' => 'datetime',
        'deadline' => 'datetime',
        'notice_days' => 'integer',
    ];

    protected static function booted()
    {
        parent::booted();

        static::saving(function (TorrentState $state) {
            $state->validateTimeRange();
            $state->ensureNoOverlap();
        });

        static::saved(function () {
            static::flushCache();
        });

        static::deleted(function () {
            static::flushCache();
        });
    }

    public function getGlobalSpStateTextAttribute()
    {
        return Torrent::$promotionTypes[$this->global_sp_state]['text'] ?? '';
    }

    public function getNoticeDaysTextAttribute(): string
    {
        return self::noticeOptions()[$this->notice_days] ?? '';
    }

    public function scopeActive(Builder $query, ?Carbon $moment = null): Builder
    {
        $moment = $moment ?? Carbon::now();

        return $query
            ->where('global_sp_state', '!=', Torrent::PROMOTION_NORMAL)
            ->where(function (Builder $query) use ($moment) {
                $query->whereNull('begin')->orWhere('begin', '<=', $moment);
            })
            ->where(function (Builder $query) use ($moment) {
                $query->whereNull('deadline')->orWhere('deadline', '>=', $moment);
            })
            ->orderBy('begin')
            ->orderBy('id');
    }

    public function scopeUpcoming(Builder $query, ?Carbon $moment = null): Builder
    {
        $moment = $moment ?? Carbon::now();

        return $query
            ->where('global_sp_state', '!=', Torrent::PROMOTION_NORMAL)
            ->whereNotNull('begin')
            ->where('begin', '>', $moment)
            ->orderBy('begin')
            ->orderBy('id');
    }

    public static function current(?Carbon $moment = null): ?self
    {
        return self::query()->active($moment)->first();
    }

    public static function next(?Carbon $moment = null): ?self
    {
        return self::query()->upcoming($moment)->first();
    }

    public static function cachedStates(): array
    {
        return NexusDB::remember(Setting::TORRENT_GLOBAL_STATE_CACHE_KEY, 600, function () {
            return self::query()
                ->where('global_sp_state', '!=', Torrent::PROMOTION_NORMAL)
                ->orderByRaw('begin is null')
                ->orderBy('begin')
                ->orderBy('id')
                ->get()
                ->toArray();
        });
    }

    public static function flushCache(): void
    {
        do_log("cache_del: " . Setting::TORRENT_GLOBAL_STATE_CACHE_KEY);
        NexusDB::cache_del(Setting::TORRENT_GLOBAL_STATE_CACHE_KEY);
        do_log("publish_model_event: global_promotion_state_updated");
        publish_model_event("global_promotion_state_updated", 0);
    }

    public static function resolveTimeline(?Carbon $moment = null): array
    {
        $moment = $moment ?? Carbon::now();
        $states = self::cachedStates();
        $current = null;
        $upcoming = null;

        foreach ($states as $state) {
            $begin = self::parseDateTimeValue($state['begin'] ?? null);
            $deadline = self::parseDateTimeValue($state['deadline'] ?? null);
            $noticeDays = (int)($state['notice_days'] ?? self::NOTICE_NONE);

            $hasBegun = !$begin || $begin->lessThanOrEqualTo($moment);
            $notExpired = !$deadline || $deadline->greaterThanOrEqualTo($moment);

            if ($hasBegun && $notExpired) {
                if (!$current) {
                    $current = $state;
                }
                continue;
            }

            if ($begin && $begin->greaterThan($moment)) {
                if (!self::isWithinNoticeWindow($begin, $noticeDays, $moment)) {
                    continue;
                }
                if (!$upcoming) {
                    $upcoming = $state;
                    continue;
                }
                $upcomingBegin = self::parseDateTimeValue($upcoming['begin'] ?? null);
                if ($upcomingBegin && $begin->lessThan($upcomingBegin)) {
                    $upcoming = $state;
                }
            }
        }

        return [
            'current' => $current,
            'upcoming' => $upcoming,
        ];
    }

    protected function validateTimeRange(): void
    {
        $begin = self::parseDateTimeValue($this->begin);
        $deadline = self::parseDateTimeValue($this->deadline);

        if ($begin && $deadline && $deadline->lessThanOrEqualTo($begin)) {
            throw ValidationException::withMessages([
                self::errorFieldKey('deadline') => __('label.torrent_state.deadline_after_begin'),
            ]);
        }
    }

    protected function ensureNoOverlap(): void
    {
        self::validateNoOverlap($this->attributesToArray(), $this->id);
    }

    protected function getRangeForComparison(TorrentState $state): array
    {
        $min = Carbon::createFromTimestamp(0);
        $max = Carbon::create(9999, 12, 31, 23, 59, 59);

        $begin = self::parseDateTimeValue($state->begin) ?? $min;

        $deadline = self::parseDateTimeValue($state->deadline) ?? $max;

        return [
            'begin' => $begin,
            'end' => $deadline,
        ];
    }

    protected static function parseDateTimeValue(mixed $value): ?Carbon
    {
        if ($value instanceof Carbon) {
            return $value;
        }

        if (empty($value) || $value === '0000-00-00 00:00:00') {
            return null;
        }

        return Carbon::parse($value);
    }

    public static function validateNoOverlap(array $attributes, ?int $ignoreId = null): void
    {
        $globalState = (int) Arr::get($attributes, 'global_sp_state', Torrent::PROMOTION_NORMAL);
        if ($globalState === Torrent::PROMOTION_NORMAL) {
            return;
        }

        $range = self::getRangeForArray($attributes);

        $conflicts = self::query()
            ->where('global_sp_state', '!=', Torrent::PROMOTION_NORMAL)
            ->when($ignoreId, fn (Builder $query) => $query->whereKeyNot($ignoreId))
            ->get(['id', 'begin', 'deadline']);

        $beginConflict = $conflicts->first(function (TorrentState $state) use ($range) {
            $other = $state->getRangeForComparison($state);
            return $range['begin']->greaterThanOrEqualTo($other['begin']) && $range['begin']->lessThanOrEqualTo($other['end']);
        });

        $endConflict = $conflicts->first(function (TorrentState $state) use ($range) {
            $other = $state->getRangeForComparison($state);
            return $range['end']->greaterThanOrEqualTo($other['begin']) && $range['end']->lessThanOrEqualTo($other['end']);
        });

        $coverageConflict = $conflicts->first(function (TorrentState $state) use ($range) {
            $other = $state->getRangeForComparison($state);
            return $range['begin']->lt($other['begin']) && $range['end']->gt($other['end']);
        });

        if ($beginConflict || $endConflict || $coverageConflict) {
            $errors = [];

            if ($beginConflict) {
                $errors[self::errorFieldKey('begin')] = self::buildOverlapMessage($beginConflict);
            }

            if ($endConflict) {
                $errors[self::errorFieldKey('deadline')] = self::buildOverlapMessage($endConflict);
            }

            if (empty($errors) && $coverageConflict) {
                $msg = self::buildOverlapMessage($coverageConflict);
                $errors[self::errorFieldKey('begin')] = $msg;
                $errors[self::errorFieldKey('deadline')] = $msg;
            }

            if (empty($errors)) {
                $msg = __('label.torrent_state.time_overlaps');
                $errors[self::errorFieldKey('begin')] = $msg;
                $errors[self::errorFieldKey('deadline')] = $msg;
            }

            throw ValidationException::withMessages($errors);
        }
    }

    protected static function getRangeForArray(array $attributes): array
    {
        $min = Carbon::createFromTimestamp(0);
        $max = Carbon::create(9999, 12, 31, 23, 59, 59);

        $begin = self::parseDateTimeValue($attributes['begin'] ?? null) ?? $min;
        $deadline = self::parseDateTimeValue($attributes['deadline'] ?? null) ?? $max;

        return [
            'begin' => $begin,
            'end' => $deadline,
        ];
    }

    protected static function errorFieldKey(string $field): string
    {
        $prefix = 'mountedActions.0.data.';

        return $prefix . $field;
    }

    protected static function buildOverlapMessage(TorrentState $conflict): string
    {
        $begin = self::parseDateTimeValue($conflict->begin);
        $deadline = self::parseDateTimeValue($conflict->deadline);

        $beginText = $begin ? $begin->toDateTimeString() : '-∞';
        $deadlineText = $deadline ? $deadline->toDateTimeString() : '∞';

        return __('label.torrent_state.time_overlaps_with', [
            'id' => $conflict->id,
            'begin' => $beginText,
            'end' => $deadlineText,
        ]);
    }

    public static function noticeOptions(): array
    {
        return [
            self::NOTICE_NONE => __('label.torrent_state.notice_none'),
            1 => __('label.torrent_state.notice_day', ['days' => 1]),
            3 => __('label.torrent_state.notice_day', ['days' => 3]),
            7 => __('label.torrent_state.notice_day', ['days' => 7]),
            15 => __('label.torrent_state.notice_day', ['days' => 15]),
            30 => __('label.torrent_state.notice_day', ['days' => 30]),
            self::NOTICE_UNLIMITED => __('label.torrent_state.notice_unlimited'),
        ];
    }

    protected static function isWithinNoticeWindow(?Carbon $begin, int $noticeDays, Carbon $now): bool
    {
        if (!$begin) {
            return true;
        }
        if ($noticeDays === self::NOTICE_NONE) {
            return false;
        }
        if ($noticeDays === self::NOTICE_UNLIMITED) {
            return true;
        }
        return $begin->copy()->subDays($noticeDays)->lessThanOrEqualTo($now);
    }
}

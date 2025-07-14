<?php

namespace App\Models;

class UserMedal extends NexusModel
{
    protected $fillable = ['uid', 'medal_id', 'expire_at', 'status', 'bonus_addition_expire_at'];

    const STATUS_NOT_WEARING = 0;
    const STATUS_WEARING = 1;

    public function getWearingStatusTextAttribute(): string
    {
        return nexus_trans("medal.wearing_status_text." . $this->status);
    }

    public static function listWearingStatusLabels(): array
    {
        return [
            self::STATUS_WEARING => nexus_trans("medal.wearing_status_text." . self::STATUS_WEARING),
            self::STATUS_NOT_WEARING => nexus_trans("medal.wearing_status_text." . self::STATUS_NOT_WEARING),
        ];
    }

    public function medal()
    {
        return $this->belongsTo(Medal::class, 'medal_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }

}

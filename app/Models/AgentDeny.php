<?php

namespace App\Models;

use App\Enums\ModelEventEnum;

class AgentDeny extends NexusModel
{
    protected $table = 'agent_allowed_exception';

    protected $fillable = [
        'family_id', 'name', 'peer_id', 'agent', 'comment'
    ];

    protected static function booted()
    {
        static::created(function ($model) {
            fire_event(ModelEventEnum::AGENT_DENY_CREATED, $model);
        });
        static::updated(function ($model) {
            fire_event(ModelEventEnum::AGENT_DENY_UPDATED, $model);
        });
        static::deleted(function ($model) {
            fire_event(ModelEventEnum::AGENT_DENY_DELETED, $model);
        });
    }

    public function family(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AgentAllow::class, 'family_id');
    }
}

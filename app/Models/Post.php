<?php

namespace App\Models;


class Post extends NexusModel
{
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'userid');
    }
}

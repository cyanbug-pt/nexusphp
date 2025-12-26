<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;

class PollAnswer extends NexusModel
{
    use NexusActivityLogTrait;

    protected $table = 'pollanswers';

    protected $fillable = ['pollid', 'userid', 'selection',];

    public function poll()
    {
        return $this->belongsTo(Poll::class, 'pollid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

}

<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;

class Poll extends NexusModel
{
    use NexusActivityLogTrait;

    protected $fillable = ['added', 'question', 'option0', 'option1', 'option2', 'option3', 'option4', 'option5'];

    protected $casts = [
        'added' => 'datetime'
    ];

    const MAX_OPTION_INDEX = 19;

    public function answers()
    {
        return $this->hasMany(PollAnswer::class, 'pollid');
    }

}

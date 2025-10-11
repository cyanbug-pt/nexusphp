<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;

class Isp extends NexusModel
{
    use NexusActivityLogTrait;

    protected $table = 'isp';

    protected $fillable = ['name'];
}

<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;

class UploadSpeed extends NexusModel
{
    use NexusActivityLogTrait;

    protected $table = 'uploadspeed';

    protected $fillable = ['name'];
}

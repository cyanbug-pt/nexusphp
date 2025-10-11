<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;

class DownloadSpeed extends NexusModel
{
    use NexusActivityLogTrait;

    protected $table = 'downloadspeed';

    protected $fillable = ['name'];
}

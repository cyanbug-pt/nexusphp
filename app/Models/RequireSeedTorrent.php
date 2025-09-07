<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequireSeedTorrent extends NexusModel
{
    protected $fillable = ['torrent_id'];

    public $timestamps = true;
}

<?php

namespace App\Models;

class UserRequireSeedTorrent extends NexusModel
{
    protected $fillable = ['user_id', 'torrent_id', 'seed_time_begin', 'uploaded_begin', 'last_settlement_at'];

    public $timestamps = true;
}

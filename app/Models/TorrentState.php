<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;

class TorrentState extends NexusModel
{
    use NexusActivityLogTrait;

    protected $fillable = ['global_sp_state', 'deadline', 'begin'];

    protected $table = 'torrents_state';

    public function getGlobalSpStateTextAttribute()
    {
        return Torrent::$promotionTypes[$this->global_sp_state]['text'] ?? '';
    }
}

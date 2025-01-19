<?php

namespace App\Models;

use Nexus\Database\NexusDB;

class TorrentExtra extends NexusModel
{
    public $timestamps = true;

    protected $fillable = ['torrent_id', 'descr', 'ori_descr', 'media_info'];

    public function torrent()
    {
        return $this->belongsTo(Torrent::class, 'torrent_id');
    }

}

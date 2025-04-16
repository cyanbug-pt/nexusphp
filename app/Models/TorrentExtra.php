<?php

namespace App\Models;

use Nexus\Database\NexusDB;
use Nexus\Torrent\TechnicalInformation;

class TorrentExtra extends NexusModel
{
    public $timestamps = true;

    protected $fillable = ['torrent_id', 'descr', 'ori_descr', 'media_info', 'nfo'];

    public function torrent()
    {
        return $this->belongsTo(Torrent::class, 'torrent_id');
    }

    protected $appends = ['media_info_summary'];

    public function getMediaInfoSummaryAttribute(): array
    {
        $technicalInfo = new TechnicalInformation($this->media_info ?? '');
        return $technicalInfo->getSummaryInfo();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Nexus\Database\NexusDB;
use Nexus\Torrent\TechnicalInformation;

class TorrentExtra extends NexusModel
{
    public $timestamps = true;

    protected $fillable = ['torrent_id', 'descr', 'ori_descr', 'media_info', 'nfo', 'pt_gen'];

    protected function ptGen(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (is_null($value)) {
                    return null;
                }
                $jsonDecoded = json_decode($value, true);
                if (is_array($jsonDecoded)) {
                    return $jsonDecoded;
                } else {
                    return $value;
                }
            },
            set: function ($value) {
                return is_array($value) ? json_encode($value) : $value;
            }
        );
    }


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

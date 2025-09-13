<?php

namespace App\Models;


class Bookmark extends NexusModel
{
    protected $table = 'bookmarks';

    protected $fillable = ['userid', 'torrentid'];

    const FILTER_IGNORE = '0';
    const FILTER_INCLUDE = '1';
    const FILTER_EXCLUDE = '2';

    public function torrent()
    {
        return $this->belongsTo(Torrent::class, 'torrentid');
    }

    public function user()
    {
        return $this->belongsTo(Torrent::class, 'userid');
    }
}

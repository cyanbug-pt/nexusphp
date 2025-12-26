<?php

namespace App\Models;

use App\Models\Traits\NexusActivityLogTrait;
use Nexus\Database\NexusDB;

class TorrentDenyReason extends NexusModel
{
    use NexusActivityLogTrait;

    protected $table = 'torrent_deny_reasons';

    public $timestamps = true;

    protected $fillable = ['name', 'hits', 'priority',];

}

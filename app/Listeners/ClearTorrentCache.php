<?php

namespace App\Listeners;

use App\Models\Torrent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearTorrentCache implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $torrentId = $event->model?->id ?? 0;
        if ($torrentId > 0) {
            $infoHash = Torrent::query()->where('id', $torrentId)->value('info_hash');
            clear_torrent_cache($infoHash);
            do_log("success clear torrent: $torrentId cache with info_hash: " . rawurlencode($infoHash));
        } else {
            do_log("no torrent id", 'error');
        }
    }
}

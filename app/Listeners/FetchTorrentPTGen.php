<?php

namespace App\Listeners;

use App\Models\Setting;
use App\Models\Torrent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Nexus\PTGen\PTGen;

class FetchTorrentPTGen implements ShouldQueue
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
        $logPrefix = "FetchTorrentPTGen";
        if (!Setting::getIsPTGenEnabled()) {
            do_log("$logPrefix, PTGen is disabled");
            return;
        }
        $torrent = $event->model;
        if (!$torrent instanceof Torrent) {
            do_log("$logPrefix, not Torrent: " . Torrent::class);
            return;
        }
        $torrentId = $torrent->id ?? 0;
        if (empty($torrentId)) {
            do_log("$logPrefix, no torrent_id");
            return;
        }
        $torrentTool = new PTGen();
        $torrentTool->updateTorrentPtGen($torrentId);
        do_log("FetchTorrentPTGen for torrent: $torrentId done!");
    }
}

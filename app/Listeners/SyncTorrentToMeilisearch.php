<?php

namespace App\Listeners;

use App\Events\TorrentCreated;
use App\Repositories\MeiliSearchRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncTorrentToMeilisearch implements ShouldQueue
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
    public function handle($event): void
    {
        $id = $event->model->id ?? 0;
        if ($id == 0) {
            do_log("event: " . get_class($event) . " no model id", 'error');
            return;
        }
        $meiliSearch = new MeiliSearchRepository();
        $result = $meiliSearch->doImportFromDatabase($id);
        do_log(sprintf("doImportFromDatabase: %s result: %s", $id, var_export($result, true)));
    }
}

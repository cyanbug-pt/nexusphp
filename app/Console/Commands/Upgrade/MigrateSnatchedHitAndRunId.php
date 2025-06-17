<?php

namespace App\Console\Commands\Upgrade;

use Illuminate\Console\Command;
use Nexus\Database\NexusDB;

class MigrateSnatchedHitAndRunId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upgrade:migrate_snatched_hr_id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        NexusDB::statement("update snatched inner join hit_and_runs on snatched.userid = hit_and_runs.uid and snatched.torrentid = hit_and_runs.torrent_id set snatched.hit_and_run_id = hit_and_runs.id");
    }
}

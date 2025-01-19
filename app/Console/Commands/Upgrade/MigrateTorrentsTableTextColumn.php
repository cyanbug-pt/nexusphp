<?php

namespace App\Console\Commands\Upgrade;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Nexus\Database\NexusDB;

class MigrateTorrentsTableTextColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upgrade:migrate_torrents_table_text_column';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate torrents table text column';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (Schema::hasTable("torrent_extras") && Schema::hasColumn("torrents", "descr")) {
            NexusDB::statement("insert into torrent_extras (torrent_id, descr, media_info, nfo, created_at) select id, descr, technical_info, nfo, now() from torrents on duplicate key update torrent_id = values(torrent_id)");
        }
        $columns = ["ori_descr", "descr", "nfo", "technical_info", "pt_gen"];
        $sql = "alter table torrents ";
        $drops = [];
        foreach ($columns as $column) {
            if (Schema::hasColumn("torrents", $column)) {
                $drops[] = "drop column $column";
            }
        }
        if (!empty($drops)) {
            $sql .= implode(",", $drops);
            NexusDB::statement($sql);
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'mysql') {
            $previous = DB::selectOne('SELECT @@SESSION.lock_wait_timeout AS timeout')?->timeout;
            try {
                DB::statement('SET SESSION lock_wait_timeout = 5');
                DB::statement('ALTER TABLE shoutbox ADD INDEX shoutbox_type_date_id_index (type, date, id), ADD INDEX shoutbox_date_id_index (date, id), ALGORITHM=INPLACE, LOCK=NONE');
            } finally {
                if ($previous !== null) {
                    DB::statement('SET SESSION lock_wait_timeout = ' . (int) $previous);
                }
            }
            return;
        }
        Schema::table('shoutbox', function (Blueprint $table) {
            $table->index(['type', 'date', 'id'], 'shoutbox_type_date_id_index');
            $table->index(['date', 'id'], 'shoutbox_date_id_index');
        });
    }

    public function down(): void
    {
        Schema::table('shoutbox', function (Blueprint $table) {
            $table->dropIndex('shoutbox_type_date_id_index');
            $table->dropIndex('shoutbox_date_id_index');
        });
    }
};

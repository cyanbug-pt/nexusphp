<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('torrents_state', function (Blueprint $table) {
            if (!Schema::hasColumn('torrents_state', 'notice_days')) {
                $table->integer('notice_days')->default(0)->after('remark');
            }
        });
    }

    public function down(): void
    {
        Schema::table('torrents_state', function (Blueprint $table) {
            if (Schema::hasColumn('torrents_state', 'notice_days')) {
                $table->dropColumn('notice_days');
            }
        });
    }
};

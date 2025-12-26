<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('torrents_state', function (Blueprint $table) {
            if (!Schema::hasColumn('torrents_state', 'remark')) {
                $table->string('remark')->nullable()->after('deadline');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('torrents_state', function (Blueprint $table) {
            if (Schema::hasColumn('torrents_state', 'remark')) {
                $table->dropColumn('remark');
            }
        });
    }
};

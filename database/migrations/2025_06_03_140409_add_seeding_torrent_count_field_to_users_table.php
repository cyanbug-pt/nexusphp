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
        Schema::table('users', function (Blueprint $table) {
            $table->integer("seeding_torrent_count")->default(0);
            $table->bigInteger("seeding_torrent_size")->default(0);
            $table->dateTime("last_announce_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("seeding_torrent_count", "seeding_torrent_size", "last_announce_at");
        });
    }
};

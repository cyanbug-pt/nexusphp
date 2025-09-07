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
        Schema::create('user_require_seed_torrents', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('torrent_id')->index();
            $table->bigInteger('seed_time_begin');
            $table->bigInteger('uploaded_begin');
            $table->dateTime('last_settlement_at')->nullable()->index();
            $table->timestamps();
            $table->unique(['user_id', 'torrent_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_require_seed_torrents');
    }
};

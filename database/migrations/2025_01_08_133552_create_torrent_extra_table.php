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
        Schema::create('torrent_extras', function (Blueprint $table) {
            $table->id();
            $table->integer('torrent_id')->unique();
            $table->mediumText('descr');
            $table->text('media_info')->nullable();
            $table->binary('nfo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torrent_extras');
    }
};

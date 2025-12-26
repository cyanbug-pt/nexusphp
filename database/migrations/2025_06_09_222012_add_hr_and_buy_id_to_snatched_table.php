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
        Schema::table('snatched', function (Blueprint $table) {
            $table->bigInteger("hit_and_run_id")->default(0);
            $table->bigInteger("buy_log_id")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('snatched', function (Blueprint $table) {
            $table->dropColumn("hit_and_run_id", "buy_log_id");
        });
    }
};

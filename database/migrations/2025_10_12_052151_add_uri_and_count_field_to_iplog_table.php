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
        Schema::table('iplog', function (Blueprint $table) {
            $table->string('uri')->nullable();
            $table->integer('count')->default(0);
            $table->index('ip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iplog', function (Blueprint $table) {
            $table->dropColumn(['uri', 'count']);
        });
    }
};

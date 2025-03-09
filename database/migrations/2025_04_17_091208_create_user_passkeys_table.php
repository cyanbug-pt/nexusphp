<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('user_passkeys')) return;
        Schema::create('user_passkeys', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('user_id');
            $table->text('AAGUID')->nullable();
            $table->text('credential_id');
            $table->text('public_key');
            $table->unsignedInteger('counter')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_passkeys');
    }
};

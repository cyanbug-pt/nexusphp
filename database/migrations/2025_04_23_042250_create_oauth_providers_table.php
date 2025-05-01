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
        Schema::create('oauth_providers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name')->unique();
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('authorization_endpoint_url');
            $table->string('token_endpoint_url');
            $table->string('user_info_endpoint_url');
            $table->string('id_claim');
            $table->string('username_claim')->nullable();
            $table->string('email_claim')->nullable();
            $table->string('level_claim')->nullable();
            $table->string('level_limit')->nullable();
            $table->boolean('enabled');
            $table->integer('priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oauth_providers');
    }
};

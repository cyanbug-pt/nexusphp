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
        Schema::table('medals', function (Blueprint $table) {
            $table->integer('bonus_addition_duration')->default(0)->after('bonus_addition_factor')->comment('魔力加成有效天数，0 永久有效');
        });
        Schema::table('user_medals', function (Blueprint $table) {
            $table->dateTime('bonus_addition_expire_at')->nullable()->after('expire_at')->comment('魔力加成过期时间，null 永不过期');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medals', function (Blueprint $table) {
            $table->dropColumn('bonus_addition_duration');
        });
        Schema::table('user_medals', function (Blueprint $table) {
            $table->dropColumn('bonus_addition_expire_at');
        });
    }
};

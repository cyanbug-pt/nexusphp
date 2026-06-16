<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('pollanswers')) {
            return;
        }
        Schema::create('pollanswers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('pollid')->default(0)->index();
            $table->unsignedMediumInteger('userid')->default(0)->index();
            $table->unsignedTinyInteger('selection')->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pollanswers');
    }
}

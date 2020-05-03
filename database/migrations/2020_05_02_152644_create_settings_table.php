<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('day')->unique();
            $table->unsignedBigInteger('breakfast_menu_id');
            $table->foreign('breakfast_menu_id')->references('id')->on('menus');
            $table->unsignedBigInteger('lunch_menu_id_one');
            $table->foreign('lunch_menu_id_one')->references('id')->on('menus');
            $table->unsignedBigInteger('lunch_menu_id_two')->nullable();
            $table->foreign('lunch_menu_id_two')->references('id')->on('menus');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

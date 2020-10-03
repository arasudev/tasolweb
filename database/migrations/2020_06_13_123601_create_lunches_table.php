<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunches', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('menu_id_one')->nullable();
            $table->foreign('menu_id_one')->references('id')->on('menus')->onDelete('cascade');
            $table->unsignedBigInteger('menu_id_two')->nullable();
            $table->foreign('menu_id_two')->references('id')->on('menus')->onDelete('cascade');
            $table->string('status');
            $table->string('bill_type')->nullable();
            $table->unsignedBigInteger('users_count')->nullable();
            $table->unsignedBigInteger('order_count')->nullable();
            $table->unsignedDouble('total_amount')->nullable();
            $table->json('ordered')->nullable();
            $table->json('cancelled')->nullable();
            $table->json('bulk_cancelled')->nullable();
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
        Schema::dropIfExists('lunches');
    }
}

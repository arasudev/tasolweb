<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreakfastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breakfasts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->string('status');
            $table->string('bill_type')->nullable();
            $table->unsignedBigInteger('users_count')->nullable();
            $table->unsignedBigInteger('ordered_count')->nullable();
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
        Schema::dropIfExists('breakfasts');
    }
}

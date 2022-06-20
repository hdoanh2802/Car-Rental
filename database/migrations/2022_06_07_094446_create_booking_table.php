<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('car_id')->unsigned();
            $table->dateTime('pick_up_date');
            $table->dateTime('return_date');
            $table->bigInteger('pick_up_office_id')->unsigned();
            $table->bigInteger('return_office_id')->unsigned();
            $table->string('status');
            $table->string('rental_type');
            $table->timestamps();
        });
        Schema::table('booking', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pick_up_office_id')->references('id')->on('office');
            $table->foreign('return_office_id')->references('id')->on('office');
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking');
    }
}

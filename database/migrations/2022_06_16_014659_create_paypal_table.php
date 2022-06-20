<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('booking_id')->unsigned();
            $table->string('paypal_id');
            $table->string('description');
            $table->string('total_paypal');
            $table->timestamps();
        });
        Schema::table('paypal', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('booking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paypal');
    }
}

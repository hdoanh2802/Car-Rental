<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('office_id')->unsigned();
            $table->string('color');
            $table->string('brand');
            $table->string('description')->nullable();
            $table->string('purch_date');
            $table->timestamps();
        });
        Schema::table('cars', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('car_type');
            $table->foreign('office_id')->references('id')->on('office');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}

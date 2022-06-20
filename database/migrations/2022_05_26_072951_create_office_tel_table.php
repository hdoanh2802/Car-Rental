<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeTelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_tel', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('phone');
            $table->bigInteger('office_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('office_tel', function (Blueprint $table) {
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
        Schema::dropIfExists('office_tel');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{

    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->integer('distination_id')->unsigned()->nullable()->default(0);
            $table->integer('commsission_id')->unsigned()->nullable()->default(0);
            $table->integer('ride_id')->unsigned()->nullable()->default(0);
            $table->integer('hotel_id')->unsigned()->nullable()->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}

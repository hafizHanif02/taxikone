<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->integer('hotel_id')->unsigned()->nullable()->default(0);
            $table->double('distination_id', 15, 8)->nullable()->default(0.00);
            $table->double('comission_rate', 15, 8)->nullable()->default(0.00);
            $table->integer('driver_paid')->unsigned()->nullable()->default(0);
            $table->integer('hotel_paid')->unsigned()->nullable()->default(0);
            $table->double('cost', 15, 8)->nullable()->default(0.00);
            $table->dateTime('ride_datetime')->nullable()->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rides');
    }
}

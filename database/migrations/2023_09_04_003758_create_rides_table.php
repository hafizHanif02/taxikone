<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('customer_name');
            $table->date('ride_date');
            $table->time('ride_time');
            $table->integer('hotel_id')->unsigned()->nullable()->default(0);
            $table->integer('destination_id')->nullable()->default(0);
            $table->double('comission_rate', 15, 8)->nullable()->default(0);
            $table->integer('driver_id')->nullable()->default(0);
            $table->integer('driver_paid')->unsigned()->nullable()->default(0);
            $table->integer('hotel_paid')->unsigned()->nullable()->default(0);
            $table->double('cost', 15, 8)->nullable()->default(0);
            // $table->dateTime('ride_datetime')->nullable()->default(DB::raw('CURRENT_DATE'));
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

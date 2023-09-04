<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('is_driver')->unsigned()->nullable()->default(0);
            $table->integer('is_hotel')->unsigned()->nullable()->default(0);
            $table->integer('is_controller')->unsigned()->nullable()->default(0);
            $table->integer('is_admin')->unsigned()->nullable()->default(0);
            $table->integer('role_id')->unsigned()->nullable()->default(0);
            $table->integer('is_active')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('users');
    }
}

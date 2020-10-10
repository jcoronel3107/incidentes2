<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransitoUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transito_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transito_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('transito_id')->references('id')->on('transitos');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('transito_user');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFugaUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuga_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fuga_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('fuga_id')->references('id')->on('fugas');
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
        Schema::dropIfExists('fuga_user');
    }
}

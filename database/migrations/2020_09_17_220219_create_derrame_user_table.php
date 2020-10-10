<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDerrameUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('derrame_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('derrame_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('derrame_id')->references('id')->on('derrames');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('derrame_user');
    }
}

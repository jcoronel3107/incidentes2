<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescate_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rescate_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('rescate_id')->references('id')->on('rescates');
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
        Schema::dropIfExists('rescate_user');
    }
}

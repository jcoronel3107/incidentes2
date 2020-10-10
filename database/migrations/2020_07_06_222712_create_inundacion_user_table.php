<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInundacionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inundacion_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inundacion_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('inundacion_id')->references('id')->on('inundacions');
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
        Schema::dropIfExists('inundacion_user');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncendioUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incendio_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incendio_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('incendio_id')->references('id')->on('incendios');
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
        Schema::dropIfExists('incendio_user');
    }
}

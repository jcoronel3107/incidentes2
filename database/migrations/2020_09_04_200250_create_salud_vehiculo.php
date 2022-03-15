<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaludVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salud_vehiculo', function (Blueprint $table) {
            $table->unsignedBigInteger('salud_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('km_salida')->nullable();
            $table->unsignedBigInteger('km_llegada')->nullable();
            $table->unsignedBigInteger('driver_id');
            $table->timestamps();
            $table->foreign('salud_id')->references('id')->on('saluds');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->foreign('driver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salud_vehiculo');
    }
}

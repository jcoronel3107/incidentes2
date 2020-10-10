<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFugaVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuga_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fuga_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('km_salida')->nullable();
            $table->unsignedBigInteger('km_llegada')->nullable();
            $table->timestamps();
            $table->foreign('fuga_id')->references('id')->on('fugas');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuga_vehiculo');
    }
}

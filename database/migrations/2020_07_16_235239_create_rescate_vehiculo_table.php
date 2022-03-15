<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescate_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rescate_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('km_salida')->nullable();
            $table->unsignedBigInteger('km_llegada')->nullable();
            $table->unsignedBigInteger('driver_id');
            $table->timestamps();
            $table->foreign('rescate_id')->references('id')->on('rescates');
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
        Schema::dropIfExists('rescate_vehiculo');
    }
}

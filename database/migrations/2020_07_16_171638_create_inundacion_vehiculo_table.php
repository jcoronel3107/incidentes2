<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInundacionVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inundacion_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inundacion_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('km_salida')->nullable();
            $table->unsignedBigInteger('km_llegada')->nullable();
            $table->timestamps();
            $table->foreign('inundacion_id')->references('id')->on('inundacions');
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
        Schema::dropIfExists('inundacion_vehiculo');
    }
}

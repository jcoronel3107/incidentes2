<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
			$table->string('codigodis');
			$table->string('placa');
			$table->string('tipo');
			$table->string('marca');
			$table->string('modelo');
			$table->string('clase');
			$table->string('pais_orig');
			$table->integer ('anio_fab');
			$table->string('carroceria');
			$table->string('color1');
			$table->string('color2');
			$table->string('tonelaje');
			$table->string('cilindraje');
			$table->string('motor');
			$table->string('chasis');
			$table->unsignedBigInteger('station_id');
			$table->string('responsab');
			$table->string('estado');
			$table->tinyInteger('activo');
			$table->string('codigoinv')->nullable();
			$table->date('fechacomp')->nullable();
			$table->string('facturacomp')->nullable();
			$table->decimal('valorcomp',8,2)->nullable();
			$table->date('fechabaja')->nullable();
			$table->string('concepbaja')->nullable();
			$table->string('observacion')->nullable();
			$table->integer('kmmantrut');
			$table->string('usuacrea')->nullable();
			$table->string('usuaedit')->nullable();
			$table->string('combustible')->nullable();
			$table->timestamps();
			$table->softDeletes();
            $table->foreign('station_id')->references('id')->on('stations')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}

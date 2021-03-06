<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('color',20);
            $table->string('textColor',20);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->text('reporte_conductor')->nullable();
            $table->enum('estado', ['En Curso', 'Finalizado']);
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('conductor_id');
            $table->unsignedBigInteger('solicitud_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('solicitud_id')->references('id')->on('solicituds');
            $table->foreign('vehiculo_id')->references('id')->on('user_vehiculo');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}

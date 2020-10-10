<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("salud_id");
            $table->unsignedBigInteger("cie_id");
            $table->string("paciente");
            $table->unsignedinteger("edad");
            $table->string("genero");
            $table->unsignedinteger("presion1")->nullable();
            $table->unsignedinteger("presion2")->nullable();
            $table->decimal("temperatura")->nullable();
            $table->unsignedinteger("glasglow")->nullable();
            $table->unsignedinteger("saturacion")->nullable();
            $table->string("casasalud",300)->nullable();
            $table->foreign('salud_id')->references('id')->on('saluds')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('cie_id')->references('id')->on('cies')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}

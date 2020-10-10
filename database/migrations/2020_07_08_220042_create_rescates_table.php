<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('rescates');
        Schema::create('rescates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("incidente_id");
            $table->string("tipo_escena");
            $table->unsignedBigInteger("station_id");
            $table->date("fecha");
            $table->string("direccion");
            $table->unsignedBigInteger("parroquia_id");
            $table->string("geoposicion")->nullable();
            $table->string("ficha_ecu911");
            $table->time("hora_fichaecu911");
            $table->time("hora_salida_a_emergencia");
            $table->time("hora_llegada_a_emergencia");
            $table->time("hora_fin_emergencia");
            $table->time("hora_en_base");
            $table->string("informacion_inicial",300);
            $table->string("detalle_emergencia",300);
            $table->string("usuario_afectado");
            $table->string("danos_estimados",300);
            $table->string("usr_creador");
            $table->string("usr_editor")->nullable();
            $table->foreign('incidente_id')->references('id')->on('incidentes')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('parroquia_id')->references('id')->on('parroquias')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('station_id')->references('id')->on('stations')
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
        Schema::dropIfExists('rescates');
    }
}

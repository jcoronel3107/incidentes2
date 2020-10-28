<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('servicios');
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->datetime("fecha_salida");
            $table->datetime("fecha_retorno");
            $table->string("delegante");
            $table->string("unidad");
            $table->unsignedBigInteger("km_salida");
            $table->unsignedBigInteger("km_retorno");
            $table->string("asunto",1000);
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("vehiculo_id");
            $table->string("usr_creador");
            $table->string("usr_editor")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('servicios');
    }
}

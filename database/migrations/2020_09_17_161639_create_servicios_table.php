<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments ('id');
            $table->datetime("fecha");
            $table->datetime("autorizacion");
            $table->string("km_salida");
            $table->string("km_llegada");
            $table->datetime("hrsalida");
            $table->datetime("hrretorno");
            $table->unsignedBigInteger("user_id");
            $table->text("asunto");
            $table->unsignedBigInteger("vehiculo_id");

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

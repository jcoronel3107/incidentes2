<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovilizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('movilizacions', function (Blueprint $table) {
            $table->id();
            $table->datetime("fecha_salida");
            $table->datetime("fecha_retorno");
            $table->unsignedBigInteger("km_salida");
            $table->unsignedBigInteger("km_retorno");
            $table->string("observaciones",1000);
            $table->string("usr_creador");
            $table->string("usr_editor")->nullable();
            $table->unsignedBigInteger("user_id");
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
        Schema::dropIfExists('movilizacions');
    }
}

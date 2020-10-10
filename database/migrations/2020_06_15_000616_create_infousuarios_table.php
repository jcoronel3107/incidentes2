<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateinfousuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void

     */
    public function up()
    {
        Schema::create('infousuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
			$table->string('direccion');
			$table->string('telefono');
			$table->string('cargo');
			$table->string('area');
			$table->string('departamento');
			$table->string('regimen');
			$table->string('sexo');
			$table->string('tipo_sangre');
			$table->string('tez');
			$table->string('estatura');
            $table->timestamps();
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
        Schema::dropIfExists('infousuarios');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('claves', function (Blueprint $table) {
            $table->id();
			$table->string("km_salida");
			$table->string("km_gasolinera");
			$table->string("km_llegada");
			$table->string("dolares");
			$table->string("galones");
			$table->string("combustible");
			$table->unsignedBigInteger("gasolinera_id");
			$table->unsignedBigInteger("user_id");
			$table->unsignedBigInteger("vehiculo_id");
            $table->string("Orden");
            $table->string("factura");
            $table->string('usr_creador');
            $table->string('usr_editor');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('gasolinera_id')->references('id')->on('gasolineras')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('claves');
    }
}

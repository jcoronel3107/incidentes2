<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id ();
			$table->unsignedBigInteger("user_id");
			$table->unsignedBigInteger("vehiculo_id");
            $table->unsignedBigInteger("gasolinera_id");
            $table->string('combustible');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')
            ->constrained();
            $table->foreign('user_id')->references('id')->on('users')
            ->constrained();
            $table->foreign('gasolinera_id')->references('id')->on('gasolineras')
            ->constrained();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicituds');
    }
}

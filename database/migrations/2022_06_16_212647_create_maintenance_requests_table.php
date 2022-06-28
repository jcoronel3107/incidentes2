<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->text('descripcion');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger("km_ingreso");
            $table->enum('status', ['Solicitado', 'Asignado', 'Cancelado','Finalizado']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_requests');
    }
}

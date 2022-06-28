<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->string('nro_orden')->nullable();
            $table->dateTime('fecha');
            $table->unsignedBigInteger('km_ingreso');
            $table->unsignedBigInteger('maintenance_request_id');
            $table->enum('status', ['Anulada', 'Liquidada','Asignada']);
            $table->foreign('maintenance_request_id')->references('id')->on('maintenance_requests');
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
        Schema::dropIfExists('workorders');
    }
}

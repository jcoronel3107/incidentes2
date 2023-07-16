<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('denominacion')->unique();
            $table->datetime('fecha');
            $table->string('plazo');
            $table->string('valor');
            $table->unsignedBigInteger("gasolinera_id");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('gasolinera_id')->references('id')->on('gasolineras')
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
        Schema::dropIfExists('contratos');
    }
}

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
            $table->id();
            $table->string('title',100);
            $table->text('descripcion')->nullable();
            $table->string('color',20);
            $table->string('textColor',20);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['Solicitado', 'Confirmado', 'Cancelado']);
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('solicituds');
    }
}

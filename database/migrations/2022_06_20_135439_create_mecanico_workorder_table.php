<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMecanicoWorkorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mecanico_workorder', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mecanico_id');
            $table->unsignedBigInteger('workorder_id');
            $table->foreign('mecanico_id')->references('id')->on('mecanicos');
            $table->foreign('workorder_id')->references('id')->on('workorders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mecanico_workorder');
    }
}

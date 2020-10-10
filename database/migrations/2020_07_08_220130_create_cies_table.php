<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cies');
        Schema::create('cies', function (Blueprint $table) {
            $table->id();
            $table->string("codigo",30);
            $table->string("padre",30);
            $table->string("concepto",300);
            $table->string("nivel",5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cies');
    }
}

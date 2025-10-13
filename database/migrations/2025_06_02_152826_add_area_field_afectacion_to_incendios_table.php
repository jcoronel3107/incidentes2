<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAreaFieldAfectacionToIncendiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incendios', function (Blueprint $table) {
            $table->integer('area_afectacion')->after('informacion_inicial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incendios', function (Blueprint $table) {
            $table->dropColumn('area_afectacion');
        });
    }
}

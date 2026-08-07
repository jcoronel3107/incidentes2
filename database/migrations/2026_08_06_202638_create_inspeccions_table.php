<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspeccionsTable extends Migration
{
    public function up()
    {
        Schema::create('inspeccions', function (Blueprint $table) {
            $table->id();
            
            // Datos de la inspección
            $table->string('codigo_inspeccion')->unique();
            $table->date('fecha_inspeccion');
            $table->string('tipo_inspeccion'); // preventiva, correctiva, etc.
            
            // Datos del lugar
            $table->string('lugar');
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('provincia')->nullable();
            
            // Datos del inspector
            $table->foreignId('inspector_id')->constrained('users')->onDelete('cascade');
            $table->string('cargo_inspector')->nullable();
            
            // Resultados
            $table->text('observaciones')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->enum('estado', ['pendiente', 'en_progreso', 'completada', 'aprobada', 'rechazada'])->default('pendiente');
            $table->enum('nivel_riesgo', ['bajo', 'medio', 'alto', 'critico'])->nullable();
            $table->date('fecha_proxima_inspeccion')->nullable();
            
            // Documentación
            $table->string('documento_adjunto')->nullable();
            $table->boolean('cumple_normativas')->default(false);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inspeccions');
    }
}
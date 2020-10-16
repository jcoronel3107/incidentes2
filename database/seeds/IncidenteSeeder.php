<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class IncidenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('incidentes')->truncate();
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_20',
            'nombre_incidente'=> 'Inundación Edificaciones',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_20',
            'nombre_incidente'=> 'Inundación Taponamiento Sumidero',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_20',
            'nombre_incidente'=> 'Desbordamiento de Quebrada',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_20',
            'nombre_incidente'=> 'Desbordamiento de Rio',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_33',
            'nombre_incidente'=> 'Rescate Persona en Montaña',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_33',
            'nombre_incidente'=> 'Rescate Animal',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_38',
            'nombre_incidente'=> 'Emergencia Medica',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_38',
            'nombre_incidente'=> 'Emergencia Trauma',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_38',
            'nombre_incidente'=> 'Emergencia Obstétrica',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_42',
            'nombre_incidente'=> 'Colisión',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_42',
            'nombre_incidente'=> 'Choque',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_42',
            'nombre_incidente'=> 'Atropello',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_42',
            'nombre_incidente'=> 'Arrollamiento',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_42',
            'nombre_incidente'=> 'Volque',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_70',
            'nombre_incidente'=> 'Incendio Estructural',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_70',
            'nombre_incidente'=> 'Incendio Forestal',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_70',
            'nombre_incidente'=> 'Incendio Vehicular',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
        	'tipo_incidente'=> '10_70',
        	'nombre_incidente'=> 'Conato Incendio',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> 'Fuga',
            'nombre_incidente'=> 'Fuga_GLP',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> 'Fuga',
            'nombre_incidente'=> 'Explosión',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> 'Fuga',
            'nombre_incidente'=> 'Inflamación',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_33',
            'nombre_incidente'=> 'Apertura Vehiculos',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_33',
            'nombre_incidente'=> 'Corte Arboles',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_33',
            'nombre_incidente'=> 'Rescate Persona Interior Domicilio',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_33',
            'nombre_incidente'=> 'Rescate Persona en Vehiculos',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> 'Derrame',
            'nombre_incidente'=> 'Derrame Combustible',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> 'Derrame',
            'nombre_incidente'=> 'Quimico',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
        	'tipo_incidente'=> '10_70',
        	'nombre_incidente'=> 'Quema Controlada Basura',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
//**********************************************************
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_70',
            'nombre_incidente'=> 'Quema Controlada Vegetación',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_70',
            'nombre_incidente'=> 'Interfaz',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_33',
            'nombre_incidente'=> 'Rescate Persona en Elevadores',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_33',
            'nombre_incidente'=> 'Rescate Persona en Esructura Colapsada',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_33',
            'nombre_incidente'=> 'Rescate Persona en Espacio Confinado',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_42',
            'nombre_incidente'=> 'Perdida Pista',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_42',
            'nombre_incidente'=> 'Clave 5 / Falsa Alarma',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_38',
            'nombre_incidente'=> 'Covid Falso Positivo',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_38',
            'nombre_incidente'=> 'Covid Positivo',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> '10_38',
            'nombre_incidente'=> 'Clave 5 / Falsa Alarma',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> 'Fuga',
            'nombre_incidente'=> 'Deflagración',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('incidentes')->insert([
            'tipo_incidente'=> 'Fuga',
            'nombre_incidente'=> 'Clave 5 / Falsa Alarma',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
    }
}

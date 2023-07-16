<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('stations')->truncate();
        DB::table('stations')->insert([
        	'nombre'=> 'Estacion_1',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
        	'nombre'=> 'Estacion_2',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
        	'nombre'=> 'Estacion_3',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
        	'nombre'=> 'Estacion_4',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
        	'nombre'=> 'Estacion_5',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
        	'nombre'=> 'Estacion_6',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
        	'nombre'=> 'Estacion_7',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
        	'nombre'=> 'Estacion_9',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);

        DB::table('stations')->insert([
            'nombre'=> 'Estacion_10',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
            'nombre'=> 'Estacion_11',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
            'nombre'=> 'Estacion_12',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
            'nombre'=> 'Estacion_13',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('stations')->insert([
            'nombre'=> 'Estacion_14',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);

    }
}

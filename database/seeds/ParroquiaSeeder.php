<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParroquiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('parroquias')->insert([
        	'nombre'=> 'No Disponible',
            'Postalcode'=> 'No Disponible',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('parroquias')->insert([
        	'nombre'=> 'Monay',
            'Postalcode'=> '010109',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('parroquias')->insert([
            'nombre'=> 'Bellavista',
            'Postalcode'=> '010101',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('parroquias')->insert([
            'nombre'=> 'San Sebastian',
            'Postalcode'=> '010111',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('parroquias')->insert([
            'nombre'=> 'Sucre',
            'Postalcode'=> '010112',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('parroquias')->insert([
            'nombre'=> 'San Blas',
            'Postalcode'=> '010110',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('parroquias')->insert([
            'nombre'=> 'Huaynacapac',
            'Postalcode'=> '010107',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('parroquias')->insert([
            'nombre'=> 'El Batan',
            'Postalcode'=> '010103',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
    }
}

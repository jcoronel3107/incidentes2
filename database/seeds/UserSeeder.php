<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('users')->insert([
        	'name'=> 'Juan Alvarez',
        	'email'=> 'jalvarez@bomberos.gob.ec',
            'avatar'=> 'avatar_default.png',
        	'cargo'=> 'Maquinista',
            'status'=>'Activo',
        	'password'=> Hash::make('secret'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);

        DB::table('users')->insert([
            'name'=> 'Juan Coronel',
            'email'=> 'jcoronel@bomberos.gob.ec',
            'avatar'=> 'avatar_default.png',
            'cargo'=> 'Analista2',
            'status'=>'Activo',
            'password'=> Hash::make('K@rin@2018'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);

        DB::table('users')->insert([
            'name'=> 'Juan Coronel',
            'email'=> 'jquintanilla@bomberos.gob.ec',
            'avatar'=> 'avatar_default.png',
            'cargo'=> 'Bombero',
            'status'=>'Activo',
            'password'=> Hash::make('secret'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);

        DB::table('users')->insert([
            'name'=> 'Juan Alvarado',
            'email'=> 'jalvarado@bomberos.gob.ec',
            'avatar'=> 'avatar_default.png',
            'cargo'=> 'Maquinista',
            'status'=>'Activo',
            'password'=> Hash::make('secret'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);

            DB::table('users')->insert([
                'name'=> 'Damian Pauta',
                'email'=> 'dpauta@bomberos.gob.ec',
                'avatar'=> 'avatar_default.png',
                'cargo'=> 'Bombero',
                'status'=>'Activo',
                'password'=> Hash::make('secret'),
                'created_at'=> '2020-06-27 04:33:16',
                'updated_at'=> '2020-06-27 04:33:16']);
    }
}

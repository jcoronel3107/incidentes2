<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('users')->truncate();
        DB::table('users')->insert([
        	'name'=> 'Dario Vimos',
        	'email'=> 'dvimos@bomberos.gob.ec',
        	'cargo'=> 'bombero',
        	'password'=> Hash::make('12345.a'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('users')->insert([
        	'name'=> 'Juan Llivisupa',
        	'email'=> 'jllivisupa@bomberos.gob.ec',
        	'cargo'=> 'bombero',
        	'password'=> Hash::make('12345.a'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('users')->insert([
        	'name'=> 'Lizardo Duran',
        	'email'=> 'lduran@bomberos.gob.ec',
        	'cargo'=> 'maquinista',
        	'password'=> Hash::make('12345.a'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('users')->insert([
        	'name'=> 'Jorge Webster',
        	'email'=> 'jwebster@bomberos.gob.ec',
        	'cargo'=> 'maquinista',
        	'password'=> Hash::make('12345.a'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('users')->insert([
        	'name'=> 'Juan Alvarez',
        	'email'=> 'jalvarez@bomberos.gob.ec',
        	'cargo'=> 'maquinista',
        	'password'=> Hash::make('12345.a'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);
    }
}

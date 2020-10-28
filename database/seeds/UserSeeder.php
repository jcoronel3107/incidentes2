<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
                

        
     /*   DB::table('users')->insert([
        	'name'=> 'Juan Alvarez',
        	'email'=> 'jalvarez@bomberos.gob.ec',
        	'cargo'=> 'maquinista',
        	'password'=> Hash::make('12345.a'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16']);*/
    }
}

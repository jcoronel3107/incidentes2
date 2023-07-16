<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GasolineraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('gasolineras')->insert([
        	'razonsocial'=> 'ESTACION DE SERVICIO VAZGAS S.A.',
        	'ruc'=> '0190343588001',
        	'direccion'=> 'GONZALES SUAREZ Y GARCIA MORENO ESQUINA',
        	'email'=> 'ximena.idrovo@vazgas.com',
			'status'=>'1',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);

            DB::table('gasolineras')->insert([
                'razonsocial'=> 'ESTACION DE SERVICIO GONZALEZ S.A.',
                'ruc'=> '0191112388001',
                'direccion'=> 'PANAMERICAANAA NORTE',
                'email'=> 'gonzalez.idrovo@vazgas.com',
                'status'=>'1',
                'created_at'=> '2020-06-27 04:33:16',
                'updated_at'=> '2020-06-27 04:33:16']);

    }
}

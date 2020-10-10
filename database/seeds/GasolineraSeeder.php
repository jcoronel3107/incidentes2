<?php

use Illuminate\Database\Seeder;

class GasolineraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('gasolineras')->truncate();
        DB::table('gasolineras')->insert([
        	'razonsocial'=> 'ESTACION DE SERVICIO VAZGAS S.A.',
        	'ruc'=> '0190343588001',
        	'direccion'=> 'GONZALES SUAREZ Y GARCIA MORENO ESQUINA',
        	'email'=> 'ximena.idrovo@vazgas.com',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('gasolineras')->insert([
        	'razonsocial'=> 'COMPAÑIA DE COMERCIO SERVIMIRAVALLE CIA. LTDA.',
        	'ruc'=> '0190349802001',
        	'direccion'=> 'AUTOPISTA CUENCA - AZOGUES',
        	'email'=> 'gasolineramiravalle@hotmail.com',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
        DB::table('gasolineras')->insert([
        	'razonsocial'=> 'WILSON GONZALEZ Y OTROS SOCIEDAD DE HECHO',
        	'ruc'=> '0190109666001',
        	'direccion'=> 'AV. SOLANO Y REMIGO TAMARIZ   ',
        	'email'=> 'gasolineragonzalez@hotmail.com',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);
    }
}

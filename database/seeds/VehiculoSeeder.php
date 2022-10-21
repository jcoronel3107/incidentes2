<?php

use Illuminate\Database\Seeder;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('vehiculos')->insert([
        	'codigodis'=> 'SC7',
        	'placa'=> 'AMA-1182',
        	'tipo'=> 'CAMIONETA',
        	'marca'=> 'CHEVROLET',
        	'modelo'=> '2014',
        	'clase'=> 'D-MAX',
        	'pais_orig'=> 'ECUADOR',
        	'anio_fab'=> '2014',
        	'carroceria'=> 'MT',
        	'color1'=> 'BLANCO',
        	'color2'=> 'ROJO',
        	'tonelaje'=> '3',
        	'cilindraje'=> '2150',
        	'motor'=> '4JJ1LP6607',
        	'chasis'=> '8LBETF3N0E0244617',
        	'station_id'=> '7',
        	'responsab'=> '0',
        	'estado'=> 'BUENO',
        	'activo'=> '1',
        	'codigoinv'=> '141.01.05.0093.0001',
        	'fechacomp'=> '2014-02-10',
        	'facturacomp'=> '342112 ',
        	'valorcomp'=> '35052.52',
        	'kmmantrut'=> '5000',
        	'usuacrea'=> 'Juan Fernando Coronel',
        	'combustible'=> '2',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);

			DB::table('vehiculos')->insert([
        	'codigodis'=> 'SC6',
        	'placa'=> 'AMA-1183',
        	'tipo'=> 'CAMIONETA',
        	'marca'=> 'CHEVROLET',
        	'modelo'=> '2014',
        	'clase'=> 'D-MAX',
        	'pais_orig'=> 'ECUADOR',
        	'anio_fab'=> '2014',
        	'carroceria'=> 'MT',
        	'color1'=> 'BLANCO',
        	'color2'=> 'ROJO',
        	'tonelaje'=> '3',
        	'cilindraje'=> '2150',
        	'motor'=> '4JJ1LP6610',
        	'chasis'=> '8LBETF3N2E0244618',
        	'station_id'=> '3',
        	'responsab'=> '0',
        	'estado'=> 'BUENO',
        	'activo'=> '1',
        	'codigoinv'=> '141.01.05.0094.0001',
        	'fechacomp'=> '2014-02-10',
        	'facturacomp'=> '342113',
        	'valorcomp'=> '35052.52',
        	'kmmantrut'=> '5000',
        	'usuacrea'=> 'Juan Fernando Coronel',
        	'combustible'=> '2',
        	'created_at'=> '2020-06-27 04:33:16',
        	'updated_at'=> '2020-06-27 04:33:16']);

			DB::table('vehiculos')->insert([
				'codigodis'=> 'SC5',
				'placa'=> 'AMA-1180',
				'tipo'=> 'CAMIONETA',
				'marca'=> 'CHEVROLET',
				'modelo'=> '2015',
				'clase'=> 'D-MAX',
				'pais_orig'=> 'ECUADOR',
				'anio_fab'=> '2015',
				'carroceria'=> 'MT',
				'color1'=> 'BLANCO',
				'color2'=> 'ROJO',
				'tonelaje'=> '3',
				'cilindraje'=> '2150',
				'motor'=> '4JJ1LP6610',
				'chasis'=> '8LBETF3N2E0244618',
				'station_id'=> '5',
				'responsab'=> '0',
				'estado'=> 'BUENO',
				'activo'=> '1',
				'codigoinv'=> '141.01.05.0094.0001',
				'fechacomp'=> '2014-02-10',
				'facturacomp'=> '342113',
				'valorcomp'=> '35052.52',
				'kmmantrut'=> '5000',
				'usuacrea'=> 'Juan Fernando Coronel',
				'combustible'=> '2',
				'created_at'=> '2020-06-27 04:33:16',
				'updated_at'=> '2020-06-27 04:33:16']);
    }
}

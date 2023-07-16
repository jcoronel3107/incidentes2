<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContratoclaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contratos')->insert([
        	'denominacion'=> 'SIE-BCBVC-2022-0122',
        	'fecha'=> '2020-02-27 04:33:16',
        	'plazo'=> '365',
			'valor'=> '45000',
            'gasolinera_id'=>'1',
        	'created_at'=> '2020-02-27 04:33:16',
        	'updated_at'=> '2020-02-27 04:33:16']);


        DB::table('contratos')->insert([
                'denominacion'=> 'SIE-BCBVC-2022-0132',
                'fecha'=> '2020-06-27 04:33:16',
                'plazo'=> '365',
                'valor'=> '25000',
                'gasolinera_id'=>'2',
                'created_at'=> '2020-06-27 04:33:16',
                'updated_at'=> '2020-06-27 04:33:16']);
       
    }
}

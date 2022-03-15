<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	
         $this->call(UserSeeder::class);
         $this->call(IncidenteSeeder::class);
         $this->call(StationSeeder::class);
         $this->call(GasolineraSeeder::class);
         $this->call(ParroquiaSeeder::class);
         $this->call(VehiculoSeeder::class);
         $this->call(RolesAndPermissionsSeeder::class);
    }
}

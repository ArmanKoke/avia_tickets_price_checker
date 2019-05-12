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
        $this->call(DepartureSeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(FlightSeeder::class);
    }
}

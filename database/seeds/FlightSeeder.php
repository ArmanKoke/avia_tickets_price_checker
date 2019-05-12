<?php

use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flights = [
            ['id' => 1, 'departure_point_id' => 1, 'destination_point_id' => 2],
            ['id' => 2, 'departure_point_id' => 2, 'destination_point_id' => 1],
            ['id' => 3, 'departure_point_id' => 1, 'destination_point_id' => 3],
            ['id' => 4, 'departure_point_id' => 3, 'destination_point_id' => 1],
            ['id' => 5, 'departure_point_id' => 1, 'destination_point_id' => 4],
            ['id' => 6, 'departure_point_id' => 4, 'destination_point_id' => 1],
            ['id' => 7, 'departure_point_id' => 2, 'destination_point_id' => 3],
            ['id' => 8, 'departure_point_id' => 3, 'destination_point_id' => 2],
            ['id' => 9, 'departure_point_id' => 2, 'destination_point_id' => 5],
            ['id' => 10, 'departure_point_id' => 5, 'destination_point_id' => 2],
        ];
        foreach($flights as $flight){
            \App\Flight::create($flight);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class DepartureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departure_points = [
            ['id' => 1, 'code' => 'ALA'],
            ['id' => 2, 'code' => 'TSE'],
            ['id' => 3, 'code' => 'MOW'],
            ['id' => 4, 'code' => 'CIT'],
            ['id' => 5, 'code' => 'LED'],
        ];
        foreach($departure_points as $departure_point){
            \App\Departure_point::create($departure_point);
        }
    }
}

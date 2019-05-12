<?php

use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destination_points = [
            ['id' => 1, 'code' => 'ALA'],
            ['id' => 2, 'code' => 'TSE'],
            ['id' => 3, 'code' => 'MOW'],
            ['id' => 4, 'code' => 'CIT'],
            ['id' => 5, 'code' => 'LED'],
        ];
        foreach($destination_points as $destination_point){
            \App\Destination_point::create($destination_point);
        }
    }
}

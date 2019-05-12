<?php

namespace App\Console\Commands;

use App\Flight;
use App\RestApiClients\Skypicker\Client;
use Illuminate\Console\Command;

class CheckFlights extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:flights';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check,validate and check if price changed for flights';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $this->info('Wait...');
        $skypicker_client = new Client();

        $flights = Flight::with('destination_points', 'departure_points')->get();
        $all = count($flights);
        foreach ($flights as $flight) {
            $flight_data = $skypicker_client->checkFlights($flight->token, 1,1);

            if (!empty($flight_data)) {
                $flight_collection = $flight_data->getData();

                $flight->checked = $flight_collection->flights_checked;
                $flight->invalid = $flight_collection->flights_invalid;
                $flight->price_change = $flight_collection->price_change;
                $flight->save();
            }
            $left = $all-=1;
            $this->info( $left .' left');
        }
        $this->info('Finished!');
    }
}

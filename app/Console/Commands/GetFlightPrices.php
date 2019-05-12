<?php

namespace App\Console\Commands;

use App\Flight;
use App\RestApiClients\Skypicker\Client;
use Illuminate\Console\Command;

class GetFlightPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:flightprices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get flights info and save';

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

        foreach ($flights as $flight) {
            $flight_data = $skypicker_client->getFlights($flight->departure_points->code, $flight->destination_points->code);

            $flight_array = $flight_data->getData()->data;
            if (!empty($flight_array))
            {
                $cheapest_flight = $this->findCheapestFlight($flight_array);

                $flight->token = $cheapest_flight->booking_token;
                $flight->price = $cheapest_flight->price;
                $flight->save();
            }
        }
        $this->info('Finished!');

    }

    /**
     * @param array $flights
     * @return mixed|null
     */
    public function findCheapestFlight(array $flights)
    {
        $prices = array_column($flights, 'price');
        $minPrice = min($prices);

        $cheapestFlight = null;
        foreach ($flights as $flight) {
            if ($flight->price === $minPrice)
                $cheapestFlight = $flight;
        }

        return $cheapestFlight;
    }
}

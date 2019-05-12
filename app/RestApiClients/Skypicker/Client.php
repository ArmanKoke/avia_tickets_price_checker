<?php

namespace App\RestApiClients\Skypicker;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Client
{
    /**
     * @var mixed
     */
    protected $api_url;
    protected $booking_api_url;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->api_url = env('SKYPICKER_API_URL');
        $this->booking_api_url = env('SKYPICKER_BOOKING_API_URL');
    }

    /**
     * Get all flights on given points from now till +31 days from now
     *
     * @param $from
     * @param $to
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFlights($from, $to)
    {
        try {
            $params = [
                'fly_from' => $from,
                'fly_to' => $to,
                'date_from' => Carbon::now()->format('d/m/Y'),
                'date_to' => Carbon::now()->addMonth()->format('d/m/Y'),
            ];

            $query = '/flights?' . http_build_query($params);

            $guzzle = new \GuzzleHttp\Client(['base_uri' => $this->api_url]);
            $response = $guzzle->request('GET', $query);

            if($response->getStatusCode() === 200) {
                $data = $response->getBody()->getContents();

                return response()->json(json_decode($data));
            }
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
        }
    }

    /**
     * bnum - bags number
     * pnum - passengers number
     *
     * @param $token
     * @param $bags_number
     * @param $passengers_number
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkFlights($token,$bags_number,$passengers_number)
    {
        try {
            $params = [
                'booking_token' => $token,
                'bnum' => $bags_number,
                'pnum' => $passengers_number,
            ];

            $query = '/api/v0.1/check_flights?' . http_build_query($params);

            $guzzle = new \GuzzleHttp\Client(['base_uri' => $this->booking_api_url]);
            $response = $guzzle->request('GET', $query);

            if($response->getStatusCode() === 200) {
                $data = $response->getBody()->getContents();

                return response()->json(json_decode($data));
            }
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
        }
    }

}

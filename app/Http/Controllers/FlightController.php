<?php

namespace App\Http\Controllers;

use App\Flight;

class FlightController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFlights()
    {
        $flights = Flight::with('destination_points', 'departure_points')->get();

        return view('pages.index',compact('flights'));
    }

}

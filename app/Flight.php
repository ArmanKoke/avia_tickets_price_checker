<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function departure_points()
    {
        return $this->hasOne('App\Departure_point','id','departure_point_id');
    }

    public function destination_points()
    {
        return $this->hasOne('App\Destination_point','id','destination_point_id');
    }
}

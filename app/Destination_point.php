<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination_point extends Model
{
    public function departure_points()
    {
        return $this->belongsToMany('App\Departure_point','flight','destination_point_id','departure_point_id');
    }
}

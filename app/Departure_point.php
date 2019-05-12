<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departure_point extends Model
{
    public function destination_points()
    {
        return $this->belongsToMany('App\Destination_point','flight','departure_point_id','destination_point_id');
    }
}

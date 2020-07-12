<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class car_models extends Model
{
    function car(){
        return $this->belongsTo('App\cars', 'model_id', 'id');
    }
}

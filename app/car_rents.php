<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class car_rents extends Model
{
    function carr(){
        return $this->belongsTo('App\car_models', 'car', 'id');
    }
    
    function clientt(){
        return $this->belongsTo('App\clients', 'client', 'id');
    }
}

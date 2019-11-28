<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function appointment(){
        return $this->hasMany('App\Appointment');
    }
}

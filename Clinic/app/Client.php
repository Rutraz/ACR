<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function analysis(){
        return $this->hasMany('App\Analysis');
    }
    
    public function appointment(){
        return $this->hasMany('App\Appointment');
    }
}

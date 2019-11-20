<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function medic()
    {
        return $this->belongsTo('App\Medic');
    }

}

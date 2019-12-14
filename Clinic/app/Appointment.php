<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'date', 'state_id', 'rating', 'comments','medic_id','user_id'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function medic()
    {
        return $this->belongsTo('App\Medic');
    }
    public function state(){
        return $this->belongsTo('App\State');
    }

}

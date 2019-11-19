<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medic extends Model
{
    protected $fillable = [
        'user_id', 'specialty', 'rating','adse'
    ];


    public function blocks(){

        return $this->belongsToMany('App\Block',"medic_has__blocks");

    }
    public function appointment(){
        return $this->hasMany('App\Appointment');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medic extends Model
{
    protected $fillable = [
        'user_id', 'specialty_id', 'rating','adse', 'calendarid'
    ];

    public function appointment(){
        return $this->hasMany('App\Appointment');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function specialty()
    {
        return $this->belongsTo('App\Specialty');
    }
}

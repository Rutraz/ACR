<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id', 'CC', 'adse', 'morada','idade'
    ];

    public function analysis(){
        return $this->hasMany('App\Analysis');
    }
    
    public function appointment(){
        return $this->hasMany('App\Appointment');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

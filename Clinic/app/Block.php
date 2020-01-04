<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'begin_hour', 'end_hour'
    ];
    public function medics(){

        return $this->belongsToMany('App\Medic',"medic_has__blocks");

    }
  
}

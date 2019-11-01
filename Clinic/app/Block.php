<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    public function medics(){

        return $this->belongsToMany('App\Medic');

    }
    
}

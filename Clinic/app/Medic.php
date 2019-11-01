<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medic extends Model
{
    public function blocks(){

        return $this->belongsToMany('App\Block');

    }
}

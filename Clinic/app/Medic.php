<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medic extends Model
{
    return $this->belongsToMany('App\Medic')
    ->withTimestamps();
}

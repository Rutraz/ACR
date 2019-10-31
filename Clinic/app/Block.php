<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    return $this->belongsToMany('App\Block');
}

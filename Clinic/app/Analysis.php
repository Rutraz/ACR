<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function state(){
        return $this->belongsTo('App\State');
    }
}

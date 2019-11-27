<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function medic(){
        return $this->hasMany('App\Medic');
    }
}

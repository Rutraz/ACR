<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id','admin'
    ];



    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

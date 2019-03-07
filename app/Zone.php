<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'zone'
    ];

    public function  regions(){
        return $this->hasMany('App\Region');
    }
}

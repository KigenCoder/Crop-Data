<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'region',
        'zone_id'
    ];

    public function zone(){
        return $this->belongsTo('App\Zone');
    }

    public function districts(){
        return $this->hasMany('App\District');
    }
}

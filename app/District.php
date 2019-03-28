<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'district',
        'region_id'
    ];


    public function region(){
        return $this->belongsTo('App\Region');
    }
}

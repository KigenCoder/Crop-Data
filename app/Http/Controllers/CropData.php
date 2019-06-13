<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CropData extends Controller
{

    public function index()
    {
        return view("data.table");
    }

    public function chart(){
        /*
         * By Region -> District, Years, Crops
         */
        return view("data.chart");
    }
}

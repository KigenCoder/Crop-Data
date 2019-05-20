<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisplayCropData extends Controller
{

    public function index()
    {
        return view("data.index");
    }

    public function chart(){
        /*
         * By Region -> District, Years, Crops
         */
        return view("data.chart");
    }
}

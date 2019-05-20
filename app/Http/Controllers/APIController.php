<?php

namespace App\Http\Controllers;

use App\Season;
use DB;
use App\Crop;
use App\CropData;
use App\Zone;

use App\LiveliHoodSystem;
use Illuminate\Http\Request;


class APIController extends Controller
{

    //Display all data
    public function data()
    {
        $query = $this->data_query();
        $query .= "ORDER by year desc, season ";
        $cropData = DB::select(DB::raw($query));
        return json_encode($cropData);
    }

    public function filter_data(Request $request)
    {
        if ($request->has('filter')) {
            $filterString = $request->all()['filter'];
            $query = $this->data_query();
            $query .= $filterString;
            $query .= "ORDER by year desc, season ";
            $cropData = DB::select(DB::raw($query));
            return json_encode($cropData);
        }
    }


    public function search_params()
    {
        $params = [];
        $params["years"] = CropData::select('year')
            ->orderBy('year', 'desc')
            ->groupBy('year')
            ->get()
            ->toArray();
        $params["crops"] = Crop::orderBy("crop", "asc")->get();
        $params["systems"] = LiveliHoodSystem::all();
        return json_encode($params);
    }

    function zones()
    {
        return json_encode(Zone::orderBy("zone", "asc")->get());
    }


    public function regions(Request $request)
    {
        $zones = $request->has('zones') ? $request->all()['zones'] : NULL;
        $query = "SELECT r.id, r.region ";
        $query .= "FROM regions r ";
        $query .= is_null($zones) ? "" : " WHERE r.zone_id in ($zones) ";
        $regions = DB::select(DB::raw($query));

        return json_encode($regions);
    }


    public function districts(Request $request)
    {
        $regions = $request->has('regions') ? $request->all()['regions'] : NULL;
        $query = "SELECT d.id, d.district ";
        $query .= "FROM districts d ";
        $query .= is_null($regions) ? "" : " WHERE d.region_id in ($regions) ";
        $districts = DB::select(DB::raw($query));
        return json_encode($districts);
    }

    public function seasons()
    {
        return json_decode(Season::all());
    }


    public function data_query()
    {
        $query = "SELECT d.id, z.zone, r.region, dr.district, d.year, c.crop, ";
        $query .= "l.livelihood_system, s.season, d.season_production, d.off_season_production ";
        $query .= "FROM crop_data d ";
        $query .= "JOIN districts dr on dr.id = d.district_id ";
        $query .= "JOIN regions r on r.id = dr.region_id ";
        $query .= "JOIN zones z on z.id = r.zone_id ";
        $query .= "JOIN livelihood_systems l on l.id = d.livelihood_system_id ";
        $query .= "JOIN seasons s ON s.id = d.season_id ";
        $query .= "JOIN crops c on c.id = d.crop_id ";
        return $query;
    }


}

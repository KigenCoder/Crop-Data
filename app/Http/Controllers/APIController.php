<?php

namespace App\Http\Controllers;

use App\Classes\ChartDataItem;
use App\District;
use App\Region;
use App\Season;
use DB;
use App\Crop;
use App\CropData;
use App\Zone;
use App\Classes\ChartData;
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

  public function chartData(Request $request)
  {
    try {
      $region_id = $request->has('region_id') ? $request->all()['region_id'] : NULL;
      $district_id = $request->has('district_id') ? $request->all()['district_id'] : NULL;
      $season_filter = $request->has('season_filter') ? $request->all()['season_filter'] : NULL;

      if($season_filter !== ''){
             $season_filter .= " ";
      }
      $location = '';


      $crop_id = $request->all()['crop_id'];
      $query = "";

      if (!is_null($region_id) && is_null($district_id)) {
        $query = $this->regionQuery($crop_id, $region_id, $season_filter);
        //Get region
        $region = Region::findOrFail($region_id);
        $location = $region->region;

      } elseif (!is_null($district_id)) {
        $query = $this->districtQuery($crop_id, $district_id, $season_filter);
        $district = District::findOrFail($district_id);
        $location = $district->district;
      }
      $cropObject = Crop::findOrFail($crop_id);
      $cropName = $cropObject->crop;
      $queryData = DB::select(DB::raw($query));

      $data = array();
      $gu_season = array();
      $deyr_season = array();

      foreach ($queryData as $dataItem) {
        $off_season_production = is_numeric($dataItem->off_season_production) ? $dataItem->off_season_production : 0;
        $season_production = is_numeric($dataItem->season_production) ? $dataItem->season_production : 0;
        $year = $dataItem->year;
        $harvest = $off_season_production + $season_production;

        if (strcasecmp($dataItem->season, 'Gu') == 0) {

          $gu_season[] = new ChartDataItem($year, $harvest);
        } elseif (strcasecmp($dataItem->season, 'Deyr') == 0) {
          $deyr_season[] = new ChartDataItem($year, $harvest);
        }
      }

      $data[] = new ChartData($cropName, $location, 'Gu', $gu_season);
      $data[] = new ChartData($cropName, $location, "Deyr", $deyr_season);

      return json_encode($data);

    } catch (\Exception $exception) {

    }

  }


  protected function regionQuery($crop_id, $region_id, $season_filter)
  {
    $query = "SELECT r.region, s.season, c.season_id, c.year, ";
    $query .= "SUM(c.off_season_production) as off_season_production,  ";
    $query .= "SUM(c.season_production) as season_production ";
    $query .= "FROM crop_data c ";
    $query .= "JOIN districts d ON d.id = c.district_id ";
    $query .= "JOIN regions r ON r.id = d.region_id ";
    $query .= "JOIN seasons s ON s.id = c.season_id ";
    $query .= "WHERE c.crop_id = $crop_id ";
    $query .= "AND  d.region_id = $region_id  ";
    $query .= $season_filter;
    $query .= "AND  c.year > 2007 ";
    $query .= "GROUP by r.region, s.season, c.season_id, c.year ";
    $query .= "ORDER BY c.year ";


    return $query;
  }

  protected function districtQuery($crop_id, $district_id, $season_filter)
  {
    $query = "SELECT d.district, s.season, c.season_id, c.year, ";
    $query .= "SUM(c.off_season_production) as off_season_production,  ";
    $query .= "SUM(c.season_production) as season_production ";
    $query .= "FROM crop_data c ";
    $query .= "JOIN districts d ON d.id = c.district_id ";
    $query .= "JOIN regions r ON r.id = d.region_id ";
    $query .= "JOIN seasons s ON s.id = c.season_id ";
    $query .= "WHERE c.crop_id = $crop_id ";
    $query .= "AND  c.district_id = $district_id  ";
    $query .= "AND  c.year > 2007 ";
    $query .= $season_filter;
    $query .= "GROUP by d.district, s.season, c.season_id, c.year ";
    $query .= "ORDER BY c.year ";
    return $query;
  }


}

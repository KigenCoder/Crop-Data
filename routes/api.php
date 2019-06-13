<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("data", "APIController@data");
Route::get('zones', "APIController@zones");
Route::post("filter", "APIController@filter_data");
Route::post('regions', "APIController@regions");
Route::post('districts', "APIController@districts");
Route::post('chart-data', "APIController@chartData");
Route::get('seasons', 'APIController@seasons');
Route::get("search_params", "APIController@search_params");

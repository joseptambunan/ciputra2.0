<?php

Route::group(['middleware' => 'web', 'prefix' => 'country', 'namespace' => 'Modules\Country\Http\Controllers'], function()
{
    Route::get('/', 'CountryController@index');
    Route::get('/detail', 'CountryController@detail');
    Route::post('/add-province', 'CountryController@addProvince');
    Route::post('/add-city', 'CountryController@addCities');
    Route::post("/deletecity/","CountryController@deleteCities");
    Route::post("/deleteProvince/","CountryController@deleteProvince");
    Route::post("/updatecity","CountryController@updateCity");
    Route::post("/updateProv","CountryController@updateProv");
});

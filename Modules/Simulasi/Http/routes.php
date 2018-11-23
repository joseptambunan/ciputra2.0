<?php

Route::group(['middleware' => 'web', 'prefix' => 'simulasi', 'namespace' => 'Modules\Simulasi\Http\Controllers'], function()
{
    Route::get('/', 'SimulasiController@index');
    Route::post('/store',"SimulasiController@store");

    Route::get('/tender','SimulasiController@show');
   	Route::post('/tenderbayar','SimulasiController@tender');
});

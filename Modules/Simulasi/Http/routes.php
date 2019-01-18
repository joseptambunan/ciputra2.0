<?php

Route::group(['middleware' => 'web', 'prefix' => 'simulasi', 'namespace' => 'Modules\Simulasi\Http\Controllers'], function()
{
    Route::get('/', 'SimulasiController@index');
    Route::post('/store',"SimulasiController@store");

    Route::get('/tender','SimulasiController@show');
   	Route::post('/tenderbayar','SimulasiController@tender');
   	Route::post('/update','SimulasiController@update');

   	Route::get('/erems','SimulasiController@erems');
   	Route::get('/erems/project','SimulasiController@eremsproject');

   	Route::post('/project/updateerems','SimulasiController@updateerems');
});

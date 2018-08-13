<?php

Route::group(['middleware' => 'web', 'prefix' => 'spk', 'namespace' => 'Modules\Spk\Http\Controllers'], function()
{
    Route::get('/', 'SpkController@index');
    Route::get('/create','SpkController@create');
    Route::get('/detail','SpkController@show');
    Route::post('/update','SpkController@update');
    Route::post('/update-date','SpkController@editdate');
    Route::post('/update-payment','SpkController@editpayment');
    Route::post('/create-termyn','SpkController@termyn');
    Route::post('/add-progress-detail','SpkController@termyndetail');
    Route::post('/update-progress-detail','SpkController@updatetermyn');
    Route::post('/approval','SpkController@approval');

    Route::get('/add-bap','SpkController@addbap');
    Route::post('/save-bap','SpkController@savebap');
});

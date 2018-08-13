<?php

Route::group(['middleware' => 'web', 'prefix' => 'pt', 'namespace' => 'Modules\Pt\Http\Controllers'], function()
{
    Route::get('/', 'PtController@index');
    Route::get('/add/','PtController@create');
    Route::post('/add-pt','PtController@store');
    Route::get('/detail','PtController@show');
    Route::post('/add-rekening','PtController@addrekening');
    Route::post('/update-rekening','PtController@update');
    Route::post('/delete-rekening','PtController@destroy');
    Route::post('/update-pt','PtController@edit');
    Route::post('/delete-project','PtController@deleteproject');
    Route::post('/add-proyek','PtController@addproject');
    Route::post('/add-mapping','PtController@addmapping');
    Route::post('/delete-mapping','PtController@deletemapping');
});

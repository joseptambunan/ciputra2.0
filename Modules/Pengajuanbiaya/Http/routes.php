<?php

Route::group(['middleware' => 'web', 'prefix' => 'pengajuanbiaya', 'namespace' => 'Modules\Pengajuanbiaya\Http\Controllers'], function()
{
    Route::get('/', 'PengajuanbiayaController@index');
    Route::get('/create','PengajuanbiayaController@create');
    Route::get('/detail','PengajuanbiayaController@show');
    Route::post('/store','PengajuanbiayaController@store');
    Route::post('/updatedetail','PengajuanbiayaController@update');
    Route::post("/loaditempekerjaan","PengajuanbiayaController@loaditempekerjaan");
    Route::post("/savedetail","PengajuanbiayaController@savedetail");
    Route::post("/delete","PengajuanbiayaController@destroy");
});

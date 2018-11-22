<?php

Route::group(['middleware' => 'web', 'prefix' => 'satuan', 'namespace' => 'Modules\Satuan\Http\Controllers'], function()
{
    Route::get('/', 'SatuanController@index');
    Route::post('/store','SatuanController@store');
});

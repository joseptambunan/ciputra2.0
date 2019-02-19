<?php

Route::group(['middleware' => 'web', 'prefix' => 'tendermaster', 'namespace' => 'Modules\TenderMaster\Http\Controllers'], function()
{
    Route::get('/', 'TenderMasterController@index');
    Route::post('/simpan','TenderMasterController@store');
    Route::post('/delete','TenderMasterController@destroy');
});

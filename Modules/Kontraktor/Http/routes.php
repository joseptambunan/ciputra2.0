<?php

Route::group(['middleware' => 'web', 'prefix' => 'kontraktor', 'namespace' => 'Modules\Kontraktor\Http\Controllers'], function()
{
    Route::get('/', 'KontraktorController@index');
    Route::get('/tender/detail','KontraktorController@show');
    Route::get('/tender','KontraktorController@tender');

    Route::get('/tender/add-penawaran','KontraktorController@tenderadd');
    Route::post('/tender/save-penawaran','KontraktorController@savepenawaran');
    Route::get('/tender/view-penawaran','KontraktorController@viewpenawaran');
    Route::post('/tender/update-penawaran','KontraktorController@updatepenawaran');
    Route::get('/tender/add-penawaran2','KontraktorController@addpenawaran2');
});

<?php

Route::group(['middleware' => 'web', 'prefix' => 'kontraktor', 'namespace' => 'Modules\Kontraktor\Http\Controllers'], function()
{
    Route::get('/', 'KontraktorController@index');
    Route::post('/ceknpwp','KontraktorController@ceknpwp');
    Route::post('/store','KontraktorController@store');
    Route::get('/detail','KontraktorController@show');
    Route::post('/update','KontraktorController@update');
});

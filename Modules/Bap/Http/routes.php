<?php

Route::group(['middleware' => 'web', 'prefix' => 'bap', 'namespace' => 'Modules\Bap\Http\Controllers'], function()
{
    Route::get('/', 'BapController@index');
    Route::get('/detail', 'BapController@show');
});

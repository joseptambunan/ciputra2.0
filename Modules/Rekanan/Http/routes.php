<?php

Route::group(['middleware' => 'web', 'prefix' => 'rekanan', 'namespace' => 'Modules\Rekanan\Http\Controllers'], function()
{
    Route::get('/', 'RekananController@index');
});

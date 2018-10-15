<?php

Route::group(['middleware' => 'web', 'prefix' => 'globalsetting', 'namespace' => 'Modules\Globalsetting\Http\Controllers'], function()
{
    Route::get('/', 'GlobalsettingController@index');
});

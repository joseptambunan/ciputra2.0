<?php

Route::group(['middleware' => 'web', 'prefix' => 'scheduler', 'namespace' => 'Modules\Scheduler\Http\Controllers'], function()
{
    Route::get('/', 'SchedulerController@index');
});

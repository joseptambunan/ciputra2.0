<?php

Route::group(['middleware' => 'web', 'prefix' => 'progress', 'namespace' => 'Modules\Progress\Http\Controllers'], function()
{
    Route::get('/', 'ProgressController@index');
    Route::get('/show', 'ProgressController@show');
    Route::get('/create', 'ProgressController@create');
    Route::post('/saveprogress','ProgressController@saveprogress');
    Route::post('/updatetermyn','ProgressController@edit');
});

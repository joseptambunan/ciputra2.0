<?php

Route::group(['middleware' => 'web', 'prefix' => 'project', 'namespace' => 'Modules\Project\Http\Controllers'], function()
{
    Route::get('/', 'ProjectController@index');
    Route::get('/add','ProjectController@create');
    Route::post('/add-proyek','ProjectController@store');
    Route::get('/detail','ProjectController@show');
});

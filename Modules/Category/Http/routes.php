<?php

Route::group(['middleware' => 'web', 'prefix' => 'category', 'namespace' => 'Modules\Category\Http\Controllers'], function()
{
    Route::get('/', 'CategoryController@index');
    Route::post('/add','CategoryController@store');
    Route::post('/delete','CategoryController@destroy');
    Route::get('/detail','CategoryController@show');
    Route::post('/add-detail','CategoryController@update');
    Route::post('/delete-detail','CategoryController@deletedetail');
    Route::post('/update-percentage','CategoryController@updatepercentage');
});

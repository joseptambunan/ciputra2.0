<?php

Route::group(['middleware' => 'web', 'prefix' => 'rab', 'namespace' => 'Modules\Rab\Http\Controllers'], function()
{
    Route::get('/', 'RabController@index');
    Route::get('/add','RabController@create');
    Route::post('/save','RabController@store');
    Route::get('/detail','RabController@show');
    Route::post('/update','RabController@update');
    Route::post('/pekerjaan','RabController@itempekerjaan');
    Route::post('/save-units','RabController@saveunit');
    Route::post('/delete-unit','RabController@deleteunit');
    Route::post('/save-pekerjaan','RabController@savepekerjaan');
    Route::post('/saveedit','RabController@updateitem');
    Route::post('/approval','RabController@approval');
    Route::post('/childcoa','RabController@childcoa');
    Route::post('/delete-pekerjaan','RabController@deletepekerjaan');
    Route::get('/approval_history','RabController@approval_history');
});

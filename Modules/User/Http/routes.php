<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
    Route::get('/master', 'UserController@show');
    Route::get('/detail', 'UserController@detail');
    Route::post('/update-project','UserController@updateProject');
    Route::post('/save-approval','UserController@saveapproval');
    Route::post('/delete-approval','UserController@deleteApproval');
    Route::post('/add-user','UserController@addUser');
    Route::post('/update-user','UserController@updateUser');
    Route::post('/delete-user','UserController@destroy');
});

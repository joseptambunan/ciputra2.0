<?php

Route::group(['middleware' => 'web', 'prefix' => 'pekerjaan', 'namespace' => 'Modules\Pekerjaan\Http\Controllers'], function()
{
    Route::get('/', 'PekerjaanController@index');
    Route::get('/add', 'PekerjaanController@create');
    Route::get('/detail', 'PekerjaanController@show');
    Route::post('/add-pekerjaan', 'PekerjaanController@store');
    Route::post('/update-pekerjaan', 'PekerjaanController@update');    
    Route::post('/delete-pekerjaan', 'PekerjaanController@destroy');
    Route::post('/add-coas', 'PekerjaanController@coas');
    Route::post('/add-subitem', 'PekerjaanController@coas');
    Route::post('/add-progress','PekerjaanController@addprogress');
    Route::post('/add-itemchild','PekerjaanController@addchilditem');
});

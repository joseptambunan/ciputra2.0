<?php

Route::group(['middleware' => 'web', 'prefix' => 'document', 'namespace' => 'Modules\Document\Http\Controllers'], function()
{
    Route::get('/', 'DocumentController@index');
    Route::post('/add-document', 'DocumentController@create');
    Route::post('/update-document', 'DocumentController@update');
    Route::post('/delete-document', 'DocumentController@destroy');
});

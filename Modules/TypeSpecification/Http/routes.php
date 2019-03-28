<?php

Route::group(['middleware' => 'web', 'prefix' => 'typespecification', 'namespace' => 'Modules\TypeSpecification\Http\Controllers'], function()
{
    Route::get('/', 'TypeSpecificationController@index');
    Route::post('/store','TypeSpecificationController@store');
});

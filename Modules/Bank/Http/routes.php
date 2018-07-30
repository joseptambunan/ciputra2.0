<?php

Route::group(['middleware' => 'web', 'prefix' => 'bank', 'namespace' => 'Modules\Bank\Http\Controllers'], function()
{
    Route::get('/', 'BankController@index');
    Route::post("/add-bank",'BankController@create');
    Route::post("/updatebank",'BankController@edit');
    Route::post("/deletedbank",'BankController@destroy');
});

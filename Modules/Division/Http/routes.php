<?php

Route::group(['middleware' => 'web', 'prefix' => 'division', 'namespace' => 'Modules\Division\Http\Controllers'], function()
{
    Route::get('/', 'DivisionController@index');
    Route::post('/add-division', 'DivisionController@adddivision');
    Route::post("/updatedivision",'DivisionController@update');
    Route::post("/deletedivision",'DivisionController@destroy');
});

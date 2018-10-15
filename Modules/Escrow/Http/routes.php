<?php

Route::group(['middleware' => 'web', 'prefix' => 'escrow', 'namespace' => 'Modules\Escrow\Http\Controllers'], function()
{
    Route::get('/', 'EscrowController@index');
    Route::get('/detail','EscrowController@show');
    Route::post('/save','EscrowController@store');
    Route::post('/update-itempekerjaan','EscrowController@update');
    Route::post('/delete','EscrowController@destroy');
});

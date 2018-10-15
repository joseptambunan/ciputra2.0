<?php

Route::group(['middleware' => 'web', 'prefix' => 'voucher', 'namespace' => 'Modules\Voucher\Http\Controllers'], function()
{
    Route::get('/', 'VoucherController@index');
    Route::get('/add', 'VoucherController@create');
    Route::post('/save','VoucherController@store');
    Route::get('/show','VoucherController@show');
    Route::post('/save-detail','VoucherController@savedetail');
    Route::post('/update','VoucherController@update');
    Route::get('/detail-units','VoucherController@detail_unit');
    Route::post('/checkbap','VoucherController@checkbap');
});

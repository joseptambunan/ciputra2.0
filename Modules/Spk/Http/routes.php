<?php

Route::group(['middleware' => 'web', 'prefix' => 'spk', 'namespace' => 'Modules\Spk\Http\Controllers'], function()
{
    Route::get('/', 'SpkController@index');
    Route::get('/create','SpkController@create');
    Route::get('/detail','SpkController@show');
    Route::post('/update','SpkController@update');
    Route::post('/update-date','SpkController@editdate');
    Route::post('/update-payment','SpkController@editpayment');
    Route::post('/create-termyn','SpkController@termyn');
    Route::post('/add-progress-detail','SpkController@termyndetail');
    Route::post('/update-progress-detail','SpkController@updatetermyn');
    Route::post('/approval','SpkController@approval');

    Route::get('/add-bap','SpkController@addbap');
    Route::post('/save-bap','SpkController@savebap');
    Route::get('/detail-bap','SpkController@detailbap');

    Route::get('/voucher-add','SpkController@addvoucher');

    Route::post('/update-dp/','SpkController@updatedp');
    Route::post('/save-dp','SpkController@savedptermin');

    Route::post('/save-retensi','SpkController@saveretensis');
    Route::post('/delete-retensi','SpkController@deleteretensi');
    Route::post('/minprogress','SpkController@saveprogress');

    Route::get('/approval_history','SpkController@approval_history');

    Route::get('/sik-create','SpkController@createsik');
    Route::post('/sik-store','SpkController@storesik');
    Route::get('/sik-show','SpkController@showsik');

    Route::get('/create-vo','SpkController@createvo');
    Route::post('/save-vo','SpkController@savevo');
    Route::post('/detailunit-vo','SpkController@detailunitvo');
    Route::post('/delete-vo','SpkController@deletevo');
    Route::post('/create-progress','SpkController@setprogress');

    Route::get('/sik-unit','SpkController@sikunit');
});

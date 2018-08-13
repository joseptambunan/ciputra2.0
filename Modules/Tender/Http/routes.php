<?php

Route::group(['middleware' => 'web', 'prefix' => 'tender', 'namespace' => 'Modules\Tender\Http\Controllers'], function()
{
    Route::get('/', 'TenderController@index');
    Route::get('/add','TenderController@create');
    Route::post('/save','TenderController@store');
    Route::get('/detail','TenderController@show');

    Route::post('/save-rekanans','TenderController@saverekanan');
    Route::post('/remove-rekanan','TenderController@removerekanan');
    Route::post('/approval-rekanan','TenderController@approvalrekanan');

    Route::get('/penawaran-add','TenderController@addpenawaran');
    Route::post('/penawaran-save','TenderController@savepenawaran');

    Route::get('/penawaran-addstep2','TenderController@addstep2');
    Route::post('/penawaran-save2','TenderController@savepenawaran2');
    Route::get('/penawaran-step2','TenderController@step2');
    Route::post('/penawaran-update2','TenderController@updatepenawaran2');

    Route::get('/penawaran-addstep3','TenderController@addstep3');
    Route::post('/penawaran-save3','TenderController@updatepenawaran3');
    Route::get('/penawaran-step3','TenderController@step3');

    Route::post('/ispemenang','TenderController@ispemenang');
    
});

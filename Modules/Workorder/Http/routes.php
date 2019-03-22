<?php

Route::group(['middleware' => 'web', 'prefix' => 'workorder', 'namespace' => 'Modules\Workorder\Http\Controllers'], function()
{
    Route::get('/', 'WorkorderController@index');
    Route::get('/add', 'WorkorderController@create');
    Route::post('/save', 'WorkorderController@store');
    Route::get('/detail','WorkorderController@show');
    Route::post('/budget-tahunan','WorkorderController@budgettahunan');
    Route::post('/budget-tahunan/item','WorkorderController@itempekerjaan');
    Route::post('/save-pekerjaan','WorkorderController@savepekerjaan');
    Route::post('/save-units','WorkorderController@saveunits');
    Route::post('/delete-unit','WorkorderController@deleteunit');
    Route::post('/update','WorkorderController@update');
    Route::post('/approve','WorkorderController@approve');
    Route::get('/approval_history','WorkorderController@approval_history');
    Route::post('/choose-budget','WorkorderController@choosebudget');
    Route::get('/non-budget','WorkorderController@nonbudget');
    Route::post('/updapprove','WorkorderController@updapprove');
    Route::post('/deletepekerjaan','WorkorderController@deletepekerjaan');
    Route::get('/unit','WorkorderController@getallunit');
    Route::post('/savenonbudget','WorkorderController@savenonbudget');
    Route::post('/search','WorkorderController@searchworkorder');
    Route::post('/itemdetail','WorkorderController@itemdetail');
    Route::post('/search','WorkorderController@search');
    Route::get('/dokument','WorkorderController@dokumen');
    Route::post('/save-document','WorkorderController@savedocument');
    Route::post('/deletedocument','WorkorderController@deletedocument');
    Route::get('/downloaddoc','WorkorderController@downloaddoc');
});

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

    Route::post('/choose-budget','WorkorderController@choosebudget');
});

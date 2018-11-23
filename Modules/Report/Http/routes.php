<?php

Route::group(['middleware' => 'web', 'prefix' => 'report', 'namespace' => 'Modules\Report\Http\Controllers'], function()
{
    Route::get('/', 'ReportController@index');
    Route::get('/project/detail','ReportController@show');
    Route::get('/project/hpp/history','ReportController@hpphistory');
    Route::get('/project/document','ReportController@document');
    Route::get('/project/budget',"ReportController@budget");
    Route::get('/project/budgetdetail',"ReportController@budgetdetail");

    Route::get('/document/budget','DocumentController@budget');
    Route::get('/document/budget/detail','DocumentController@budget_detail');
    Route::get('/document/budget/devcost','DocumentController@budget_devcost');
    Route::get('/document/budget/referensi','DocumentController@budget_referensi');

    Route::get('/document/pekerjaan','DocumentController@pekerjaan');
   
});

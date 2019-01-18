<?php

Route::group(['middleware' => 'web', 'prefix' => 'report', 'namespace' => 'Modules\Report\Http\Controllers'], function()
{
    Route::get('/all', 'ReportController@index');
    Route::get('/project/detail','ReportController@show');
    Route::get('/project/hpp/history','ReportController@hpphistory');
    Route::get('/project/document','ReportController@document');
    Route::get('/project/budget',"ReportController@budget");
    Route::get('/project/budgetdetail',"ReportController@budgetdetail");
    Route::get("/project/costreport",'ReportController@costreport');
    Route::get('/project/kontraktor','ReportController@kontraktor');
    Route::get("/project/reportkawasan",'ReportController@reportkawasan');
    Route::get('/project/reportpekerjaan','ReportController@reportpekerjaan');

    Route::post('/project/searchkawasan'.'ReportController@searchkawasan');

    Route::get('/document/budget','DocumentController@budget');
    Route::get('/document/budget/detail','DocumentController@budget_detail');
    Route::get('/document/budget/devcost','DocumentController@budget_devcost');
    Route::get('/document/budget/referensi','DocumentController@budget_referensi');

    Route::get('/document/pekerjaan','DocumentController@pekerjaan');

    Route::get('/cashflow','ReportController@cashflow');
    Route::get('/detailcashflow','ReportController@detailcashflow');
    Route::get('/cashflow/approval','ReportController@approvalcashflow');

    Route::get('/project/rakor/','RakorController@index');
    Route::get('/project/rakor/powerpoint','RakorController@create');

});

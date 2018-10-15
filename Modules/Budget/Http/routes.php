<?php

Route::group(['middleware' => 'web', 'prefix' => 'budget', 'namespace' => 'Modules\Budget\Http\Controllers'], function()
{
    Route::get('/', 'BudgetController@index');
    Route::get('/proyek','BudgetController@index');
    Route::get('/add-budget','BudgetController@create');
    Route::post('/save-budget','BudgetController@store');
    Route::get('/detail','BudgetController@show');
    Route::post('/update-budget','BudgetController@edit');

    Route::get('/item-budget','BudgetController@itempekerjaan');
    Route::post('/item-detail','BudgetController@itemdetail');

    Route::post('/item-save','BudgetController@itemsave');
    Route::post('/item-saveedit','BudgetController@itemupdate');
    Route::post('/delete-itembudget/','BudgetController@deletebudget');
    Route::post('/update-itembudget','BudgetController@itemupdate');
    Route::get('/edit-itembudget','BudgetController@edititem');
    Route::post('/save-itembudget','BudgetController@saveitem');

    Route::post("/approval-add",'BudgetController@approval');

    Route::get("/cashflow/", 'BudgetController@cashlflow');
    Route::post("/cashflow/add-cashflow", 'BudgetController@addcashflow');
    Route::get("/cashflow/detail-cashflow", 'BudgetController@detailcashflow');
    Route::post("/cashflow/update-cashflow",'BudgetController@updatecashflow');
    Route::get("/cashflow/add-item/","BudgetController@itemcashflow");
    Route::post("/cashflow/save-item","BudgetController@savecashflow");
    Route::get("/cashflow/view-item","BudgetController@viewcashflow");
    Route::post("/cashflow/update-item","BudgetController@updateitemcashflow");
    Route::post('/cashflow/save-monthly','BudgetController@savemonthly');
    Route::post('/cashflow/update-monthly','BudgetController@updatemonthly');
    Route::post('/cashflow/delete-monthly','BudgetController@deletemonthly');
    Route::post('/cashflow/approval','BudgetController@approval_cashflow');
    Route::get("/cashflow/newadd-item/","BudgetController@newitemcashflow");
    Route::post('/cashflow/savenewadd-item','BudgetController@savenewitemcashflow');
    
    Route::get('/revisibudget','BudgetController@revisibudget');
    Route::post('/save-budgetrevisi','BudgetController@saverevisi');
    Route::get('/show-budgetrevisi','BudgetController@detailrevisi');
    Route::get('/item-budgetrevisi','BudgetController@itemrevisi');
    Route::post('/saveitem-budgetrevisi','BudgetController@saveitemrevisi');
    Route::get('/list-budgetrevisi','BudgetController@listrevisi');
    Route::get('/item-revisi','BudgetController@additemrevisi');
    Route::post('/save-itemrevisi','BudgetController@savenewitemrevisi');

    Route::post('/save-carryover','BudgetController@savecaryyover');
    Route::post('/delete-carryover','BudgetController@deletecarryover');

    Route::get('/createrobot','BudgetController@createrobot');
    Route::get('/createhpp','BudgetController@createhpp');
    
    Route::get("/cashflow/revisi-item/","BudgetController@revitemcashflow");
    Route::post("/cashflow/save-revitem","BudgetController@saverevitem");
    Route::get("/cashflow/approval","BudgetController@approval_history");

    Route::get("/draft","BudgetController@draft");
    Route::post("/approval-update","BudgetController@updateapproval");
});

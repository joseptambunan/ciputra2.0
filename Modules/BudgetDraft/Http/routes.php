<?php

Route::group(['middleware' => 'web', 'prefix' => 'budgetdraft', 'namespace' => 'Modules\BudgetDraft\Http\Controllers'], function()
{
    Route::get('/', 'BudgetDraftController@index');
    Route::get('/detail','BudgetDraftController@show');
});

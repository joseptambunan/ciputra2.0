<?php

Route::group(['middleware' => 'web', 'prefix' => 'purchaseorder', 'namespace' => 'Modules\PurchaseOrder\Http\Controllers'], function()
{
    Route::get('/', 'PurchaseOrderController@index');
    Route::get('/detail/','PurchaseOrderController@detail');
    Route::get('/add/','PurchaseOrderController@create');
});

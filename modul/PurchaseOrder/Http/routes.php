<?php

Route::group(['middleware' => 'web', 'prefix' => 'purchaseorder', 'namespace' => 'Modules\PurchaseOrder\Http\Controllers'], function()
{
    Route::get('/', 'PurchaseOrderController@index');
    Route::get('/detail/','PurchaseOrderController@detail');
    Route::get('/add','PurchaseOrderController@create');
    Route::post('/store/','PurchaseOrderController@store');

    Route::post('/getItemPenawaran','PurchaseOrderController@getDataDetailItemPenawaran');

    Route::post("/approve",'PurchaseOrderController@approvePO');
    Route::get("/request_approve_detail",'PurchaseOrderController@request_approvePO_detail');
    Route::get("/undo_request_approve_detail",'PurchaseOrderController@undo_request_approvePO_detail');

    Route::post("/approveall",'PurchaseOrderController@approvePOall');
    Route::post("/undo_approve",'PurchaseOrderController@undo_approvePO');

    Route::post("/request_approve",'PurchaseOrderController@request_approvePO');
    Route::post("/undo_request_approve",'PurchaseOrderController@undo_request_approvePO');
    Route::get("/getPO",'PurchaseOrderController@getPO');

    Route::get('/cetakpdf/{id}',  'PurchaseOrderController@makePDF');

    
});

<?php

Route::group(['middleware' => 'web', 'prefix' => 'tenderpurchaserequest', 'namespace' => 'Modules\TenderPurchaseRequest\Http\Controllers'], function()
{
    Route::get('/', 'TenderPurchaseRequestController@index');
    Route::get('/add', 'TenderPurchaseRequestController@create');
    Route::post('/add-tpr','TenderPurchaseRequestController@store');

    Route::get('/getPengelompokanJumlah/{data?}','TenderPurchaseRequestController@getSatuan');
    
    Route::post('/getSupplierPenawaran','TenderPurchaseRequestController@getSupplierPenawaran');
    
    Route::post('/getItemSupplierPenawaran','TenderPurchaseRequestController@getItemSupplierPenawaran');

    Route::get('/detail','TenderPurchaseRequestController@detail');
    Route::get('/add-rekanan','TenderPurchaseRequestController@rekanan');
    Route::get('/ubah-volume','TenderPurchaseRequestController@ubahVolume');
    Route::get('/tambah-penawaran','TenderPurchaseRequestController@tambahPenawaran');
    Route::get('/pengelompokan','TenderPurchaseRequestController@pengelompokan');
    Route::get('/pengelompokanAdd','TenderPurchaseRequestController@pengelompokanAdd');
    Route::post('/add-pengelompokan','TenderPurchaseRequestController@pengelompokanStore');
    Route::get('/pengelompokanDetail','TenderPurchaseRequestController@pengelompokanDetail');
    Route::get('/add-pemenang/','TenderPurchaseRequestController@add_pemenang');
    Route::get('/approve-pemenang/','TenderPurchaseRequestController@approve_pemenang');
    Route::get('/approve-tender/','TenderPurchaseRequestController@approve_tender');
    Route::get('/approve-pengelompokan/','TenderPurchaseRequestController@approve_pengelompokan');
    Route::get('/add-penawaran/','TenderPurchaseRequestController@addpenawaran');
    Route::get('/kelompokPenawaran/','TenderPurchaseRequestController@kelompokPenawaran');
    Route::get('/kirim-penawaran/','TenderPurchaseRequestController@kirim_penawaran');
    Route::get('/add-item-pembayaran/','TenderPurchaseRequestController@add_item_pembayaran');
    Route::get('/add-nilai-penawaran/','TenderPurchaseRequestController@add_nilai_penawaran');
    Route::post('/storePenawaran/','TenderPurchaseRequestController@storePenawaran');

    Route::post('/getBrands','TenderPurchaseRequestController@getBrands');
    Route::post('/checkFase','TenderPurchaseRequestController@checkFase');

    Route::get('/index_penawaran','TenderPurchaseRequestController@indexPenawaran');
    Route::get('/getDataPenawaran','TenderPurchaseRequestController@getDataPenawaran');
    Route::get('/detailFasePenawaran/{id}','TenderPurchaseRequestController@detailFasePenawaran');
    Route::get('/detailTender','TenderPurchaseRequestController@detailTender');
    
    Route::get('/getDataTawarMenawar','TenderPurchaseRequestController@getDataTawarMenawar');

    Route::post('/approve_penawaran','TenderPurchaseRequestController@approvePenawaran');
    Route::post('/tunjuk_pemenang','TenderPurchaseRequestController@tunjuk_pemenang');
    Route::post('/lanjut_tawar','TenderPurchaseRequestController@lanjutTawar');

    Route::post('/request_approval/','TenderPurchaseRequestController@request_approval');
    Route::post('/request_approval_penawaran','TenderPurchaseRequestController@request_approval_penawaran');

    Route::get('/itemSiapKelompok','TenderPurchaseRequestController@getItemSiapKelompok');

    Route::get('/add_oe_pr','TenderPurchaseRequestController@add_oe_pr');

    Route::post('/store_oe','TenderPurchaseRequestController@store_oe');
    Route::post('/tambah_rekanan_oe','TenderPurchaseRequestController@tambah_rekanan_oe');
    
    Route::get('/indexOE','TenderPurchaseRequestController@indexOE');
    Route::get('/detail_oe','TenderPurchaseRequestController@detail_oe');

    Route::post('/delete_rekanan_oe','TenderPurchaseRequestController@delete_rekanan_oe');

    Route::get('/request_approveOE','TenderPurchaseRequestController@requestapproveOE');
    Route::post('/request_approveOEfromIndex','TenderPurchaseRequestController@requestapproveOEfromIndex');
    Route::get('/approveOE','TenderPurchaseRequestController@approveOE');
    Route::post('/approveOEfromIndex','TenderPurchaseRequestController@approveOEfromIndex');
    Route::post('/undo_request_oe_fromindex','TenderPurchaseRequestController@undo_request_oe_fromindex');

    Route::get('/request_approval_tprg','TenderPurchaseRequestController@requestApprovalPengelompokan');
    Route::get('/approve_tprg','TenderPurchaseRequestController@approve_pengelompokan');
    Route::get('/undo_request','TenderPurchaseRequestController@undo_request_pengelompokan');

    Route::post('/request_apprval_tprg_from_index','TenderPurchaseRequestController@requestApprovalPengelompokanFromIndex');
    Route::post('/request_undo_tprg_from_index','TenderPurchaseRequestController@undo_request_pengelompokan_fromIndex');

    Route::get('/getPRBelumKelompok','TenderPurchaseRequestController@pr_belum_kelompok');
    Route::get('/getPRSudahKelompok','TenderPurchaseRequestController@pr_sudah_kelompok');

    Route::get('/getItemOE','TenderPurchaseRequestController@getItemOE');

    Route::post('/request_approve_tprg_from_index','TenderPurchaseRequestController@ApprovePengelompokanFromIndex');
    Route::post('/request_undoApprove_tprg_from_index','TenderPurchaseRequestController@undo_approve_pengelompokan_fromIndex');

    Route::post('/approveOEfromIndex','TenderPurchaseRequestController@approveOEfromIndex');
    Route::post('/undo_approve_oe_fromindex','TenderPurchaseRequestController@undo_approve_oe_fromindex');

    Route::get('/rekanan_source','TenderPurchaseRequestController@rekananSource');
    Route::post('/update_rekanan','TenderPurchaseRequestController@update_rekanan');

    Route::get('/penetapan/{id}','TenderPurchaseRequestController@penetapan_pembayaran');
    Route::post('/storePenetapan/','TenderPurchaseRequestController@storePenetapan');



});

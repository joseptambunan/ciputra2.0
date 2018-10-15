<?php

Route::group(['middleware' => 'web', 'prefix' => 'access', 'namespace' => 'Modules\Access\Http\Controllers'], function()
{
    Route::get('/', 'AccessController@project');
    Route::get('/budget/detail','AccessController@budget_detail');
    /* Menu Approval */
	Route::get("/privilege","UserPrivilegeController@index");
	Route::post("/privilege/set","UserPrivilegeController@setprivilege");


	Route::get("/project/manager/","UserManagerController@index");
	Route::get("/project/manager/document","UserManagerController@index");
	Route::get("/project/manager/project","UserManagerController@project");
	Route::get("/project/manager/spk","UserManagerController@spks");

	Route::get('/project/','AccessController@project');
	Route::get('/approval_summary','AccessController@approval_summary');
	Route::get('/budget','AccessController@budget');
	Route::get('/budget/detail','AccessController@budget_detail');
	Route::get('/budget/approval','AccessController@budget_approval');
	Route::get('/budget/approval/budget_faskot','AccessController@budget_faskot');
	Route::get('/budget/unit/','AccessController@budget_unit');
	Route::get('/budget/unit/template','AccessController@detail_unit');
	Route::get('/budget/unit/template/detail','AccessController@template_unit');
	Route::get('/budget/devcost/','AccessController@budget_devcost');
	Route::get('/budget/concost/','AccessController@budget_concost');
	Route::get('/budget_tahunan','AccessController@budget_tahunan');
	Route::get('/budget_tahunan/detail','AccessController@budget_tahunan');
	Route::get('/budget_tahunan/approval','AccessController@budget_tahunan_approval');
	
	
	
	Route::get('/workorder','AccessController@workorder');
	Route::get('/workorder/detail','AccessController@workorder_detail');
	Route::get('/workorder/approval','AccessController@workorder_approval');
	Route::get('/workorder/approval','AccessController@workorder_approval');
	Route::get('/approval/itempekerjaan/detail/','AccessController@itemdetail');
	Route::get('/tender/','AccessController@tender');
	Route::get('/tender/detail/','AccessController@tender_detail');
	Route::get('/tender/workorder/','AccessController@tender_workorder_detail');
	Route::get('/tender_penawaran/','AccessController@tender_penawaran');
	Route::get("/tender/rekanan/approve/",'AccessController@rekanan_approve');
	Route::get("/tender/rab","AccessController@tender_rab_detail");
	Route::get("/spk/",'AccessController@spk');
	Route::get("/spk/detail","AccessController@spk_detail");
	Route::get("/spk/approve","AccessController@spk_approve");
	Route::get("/vo/","AccessController@vo");
	Route::get("/vo/detail/","AccessController@vo_detail");
	Route::get("/rab/","AccessController@rab");
	Route::get("/rab/detail","AccessController@rab_detail");
	Route::get("/rab/approval","AccessController@rab_approval");
	Route::post("/tender/menang/","AccessController@tender_menang");
	Route::post("/tender/approved/","AccessController@tender_approved");
	Route::get("/department","AccessController@department");
	Route::post("/approval/all","AccessController@approve_all");
	Route::get("/tender_korespondensi/detail/","AccessController@tender_korespondensi");
	Route::post("/tender_korespondensi/approval/","AccessController@tender_korespondensi_approval");

	Route::get("/report","UserReportController@index");
	Route::get("/report/document","UserReportController@document");
	Route::get("/report/hpp/devcost/summary","UserReportController@reportHppDevcostSummary");
	Route::get("/report/hpp/devcost/detail","UserReportController@reportHppDevcostDetail");
	Route::get("/report/hpp/concost/summary/","UserReportController@reportHppConcostSummary");
	Route::get("/report/hpp/concost/detail/","UserReportController@reportHppConcostDetail");
	Route::get("/report/costreport","UserReportController@reportCostReport");
	Route::get("/report/kontrak/kontraktor","UserReportController@reportKontrakKontraktor");
	Route::get("/report/kontrak/proyek","UserReportController@reportKontrakProyek");
	Route::get("/report/kontrak/pekerjaan","UserReportController@reportKontrakPekerjaan");
	Route::get("user/document/","UserDocumentController@project");

	Route::post("user/report/search/kontraktor","UserReportController@search_kontraktor");
	Route::post("user/report/search/proyek","UserReportController@search_proyek");
	Route::post("user/report/search/proyek/itempekerjaan","UserReportController@search_proyek_pekerjaan");
	Route::post("user/report/search/proyek/spk","UserReportController@search_proyek_pekerjaan_spk");

	Route::get("/tender/detail-penawaran",'AccessController@rekaptender');
	Route::post("/tender/document/save/","AccessController@approvedeoc");
/* Budget Unit Type*/
});

<?php

Route::group(['middleware' => 'web', 'prefix' => 'purchaserequest', 'namespace' => 'Modules\PurchaseRequest\Http\Controllers'], function()
{
    Route::get('/', 'PurchaseRequestController@index');
    Route::get('/add/','PurchaseRequestController@create');
    Route::post('/add-pr/','PurchaseRequestController@store');
    Route::get('/get-satuan/','PurchaseRequestController@get_satuan');
    Route::get('/detail/','PurchaseRequestController@detail');
    Route::get('/approve/','PurchaseRequestController@approve');
    Route::get('/reject/','PurchaseRequestController@reject');
    Route::get('/approve-cancel/','PurchaseRequestController@approve_cancel');
    Route::get('/cetakpdf/{id}',  'PurchaseRequestController@makePDF');
    Route::post('/getSPK','PurchaseRequestController@getSPK');



    Route::get('/getBudgetTahunan/{data?}',function($data){
        //$task = Task::find($data);
        //$project = Modules\Project\Entities\Project::find($request->session()->get('project_id'));
        $department_id=((int)$data);
        $project = (substr($data,strpos($data,'|')+1));
        $PRD =  DB::table("budgets")
                ->join("budget_tahunans","budgets.id","=","budget_tahunans.budget_id")
                ->select('budget_tahunans.id','budget_tahunans.no')
                ->where('budgets.department_id','=',$department_id)
                ->where('budgets.project_id','=',$project)
                ->get();
        return Response::json($PRD);
    });


    Route::post('/changeBrand','PurchaseRequestController@changeBrand');
    Route::post('/request_approval/','PurchaseRequestController@request_approval');
    Route::post('/batalrequest_approval/','PurchaseRequestController@batalrequest_approval');

    Route::post('/filter_item_pekerjaan','PurchaseRequestController@filter_item_pekerjaan');

    Route::post('/update','PurchaseRequestController@update');

    //source editable
    Route::get('/item_pekerjaan_source','PurchaseRequestController@item_pekerjaan_source');
    Route::get('/item_project_source','PurchaseRequestController@item_project_source');
    Route::get('/brand_source','PurchaseRequestController@brand_source');
    Route::get('/satuan_source','PurchaseRequestController@satuan_source');
    Route::get('/supplier_source','PurchaseRequestController@supplier_source');
    Route::post('/changeItemBaseCategory','PurchaseRequestController@changeItemBaseCategory');
    Route::post('/changeCategoryBaseParent','PurchaseRequestController@changeCategoryBaseParent');
    Route::get('/update_rec1','PurchaseRequestController@update_rec1');
    Route::get('/edit/{id}','PurchaseRequestController@edit');

    Route::get('/delete_detail','PurchaseRequestController@delete_detail');

    Route::post('/edit_pr','PurchaseRequestController@edit_pr');
    Route::post('/editPR','PurchaseRequestController@editPR');

    Route::post('/tambah','PurchaseRequestController@tambah');
});

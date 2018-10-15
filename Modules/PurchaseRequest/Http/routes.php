<?php

Route::group(['middleware' => 'web', 'prefix' => 'purchaserequest', 'namespace' => 'Modules\PurchaseRequest\Http\Controllers'], function()
{
    Route::get('/', 'PurchaseRequestController@index');
    Route::get('/add/','PurchaseRequestController@create');
    Route::post('/add-pr/','PurchaseRequestController@store');
    Route::get('/get-satuan/','PurchaseRequestController@get_satuan');
    Route::get('/detail/','PurchaseRequestController@detail');
    Route::get('/approve/','PurchaseRequestController@approve');
    Route::get('/approve-cancel/','PurchaseRequestController@approve_cancel');
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
});

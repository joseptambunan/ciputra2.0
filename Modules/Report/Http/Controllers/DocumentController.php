<?php

namespace Modules\Report\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectKawasan;
use Modules\Budget\Entities\Budget;
use Modules\Budget\Entities\BudgetDetail;
use Modules\Budget\Entities\BudgetTahunan;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function budget(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->id);
        
        return view('report::document.budget',compact("user","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function budget_detail(Request $request)
    {
        $budget = Budget::find($request->id);
        $approval = $budget->approval;
        $user = \Auth::user();
        $project = $budget->project;
        $effisiensi_netto = 0;
        if ( $budget->project->netto > 0 ){
            $effisiensi_netto = $budget->total_devcost / $budget->project->netto;
        }

        $array = array (
            "6" => array("label" => "Disetujui", "class" => "label label-success"),
            "7" => array("label" => "Ditolak", "class" => "label label-danger"),
            "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
        );
           
        return view('report::document.budget_detail',compact("budget","project","user","approval","effisiensi_netto","array"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function budget_devcost(Request $request){
        $budgets = Budget::find($request->id);
        $coa = $budgets->total_parent_item;
        $user = \Auth::user();
        $project = $budgets->project;
        return view("report::document.budget_devcost",compact("project","user","budgets","coa"));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $project = Project::find($request->id);
        $user = \Auth::user();
        $budgets = $project->all_budgets;
        $tahun = array();
        $list = "";
        
        foreach ($budgets as $key => $value) {
            $tmp = explode("-",$value->start_date);
            if ( $tmp[0] != "" ){
                $tahun[$key] = $tmp[0];                
            }
        }
        $tahun = array_values(array_unique($tahun));
        foreach ($tahun as $key => $value) {
            $list .= $value .",";
        }
        $list = trim($list,",");
        return view('report::show',compact("project","user","tahun","list"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('report::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function hpphistory(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();
        return view('report::hpp_histroy',compact("user","project"));
    }

    public function document(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();
        return view('report::document',compact("user","project"));
    }
}

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

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = \Auth::user();
        $project = $user->project_pt_users;

        return view('report::index',compact("user","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('report::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
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

    public function budget(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();
        return view("report::report.report_hpp_summary",compact("user","project"));
    }

    public function budgetdetail(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();
        return view("report::report.report_hpp_detail",compact("user","project"));
    }
}

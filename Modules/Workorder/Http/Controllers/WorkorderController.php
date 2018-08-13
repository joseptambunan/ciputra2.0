<?php

namespace Modules\Workorder\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Workorder\Entities\Workorder;
use Modules\Workorder\Entities\WorkorderBudgetDetail;
use Modules\Workorder\Entities\WorkorderDetail;
use Modules\Department\Entities\Department;
use Modules\Budget\Entities\BudgetTahunan;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $workorder = $project->workorder_details;
        return view('workorder::index',compact("user","project","workorder"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));        
        return view('workorder::create',compact("project","user"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $work_order_no = \App\Helpers\Document::new_number('WO', $request->department_from);
        $work_order = new Workorder;
        $work_order->budget_tahunan_id = $request->session()->get('project_id');
        $work_order->department_from = $request->department_from;
        $work_order->department_to = $request->department_to;
        $work_order->no = $work_order_no;
        $work_order->name = $request->workorder_name;
        $work_order->durasi = $request->workorder_durasi;
        $work_order->satuan_waktu = '0';
        $work_order->date = date("Y-m-d H:i:s");
        $work_order->estimasi_nilaiwo = '0';
        $work_order->description = $request->workorder_description;
        $status = $work_order->save();
        return redirect("/workorder/detail/?id=".$work_order->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $workorder = Workorder::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view('workorder::detail',compact("workorder","project","user"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('workorder::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $work_order = Workorder::find($request->workorder_id);
        $work_order->department_from = $request->department_from;
        $work_order->department_to = $request->department_to;
        $work_order->name = $request->workorder_name;
        $work_order->durasi = $request->workorder_durasi;
        $work_order->estimasi_nilaiwo = $work_order->nilai;
        $work_order->description = $request->workorder_description;
        $status = $work_order->save();
        return redirect("/workorder/detail/?id=".$request->workorder_id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function budgettahunan(Request $request){
        $project = $request->session()->get('project_id');
        $department_id = Department::find($require->department_id);
        $budgets = $department_id->budgets;
        $html = "";
        foreach ($budgets as $key => $value) {
            if ( $value->project_id == $request->session()->get('project_id')){
                foreach ($value->budget_tahunans as $key2 => $value2) {
                    if ( $value2->tahun_anggaran == date('Y')){
                        $html .= "<option value='".$value2->id."'>".$value->no."</option>";
                    }
                }
            }
        }
        return response()->json( ["status" => "0", "html" => $html] );
    }

    public function itempekerjaan(Request $request){
        $budgettahunan = BudgetTahunan::find($request->id);
        $html = "";

        foreach ($budgettahunan->total_parent_item as $key => $value) {
            if ( isset($value['nilai'])){
                //if ( count( \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value['id'])->get() ) > 0 ){
                    $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value['code'])->get()->first();
                    $html .= "<tr style='background-color:grey;color:white;font-weight:bolder;'>";
                    $html .= "<td>".$itempekerjaan->code."</td>";
                    $html .= "<td>".$itempekerjaan->name."</td>";
                    $html .= "<td>".number_format($value['nilai'] * $value['volume'])."</td>";
                    $html .= "<td>&nbsp;</td>";
                    $html .= "<td>&nbsp;</td>";
                    $html .= "<td>&nbsp;</td>";
                    $html .= "</tr>";
                    foreach ($itempekerjaan->child_item as $key2 => $value2) {
                        $html .= "<tr>";
                        $html .= "<td>".$value2->code."</td>";
                        $html .= "<td>".$value2->name."</td>";
                        $html .= "<td><input type='hidden' class='form-control' value='".$value2->id."' name='item_id[".$key2."]'/></td>";
                        $html .= "<td><input type='text' class='form-control' value='".rand(100,1500)."' name='nilai[".$key2."]'/></td>";
                        $html .= "<td><input type='text' class='form-control' value='".rand(1,100)."' name='volume[".$key2."]'/></td>";
                        $html .= "<td><input type='text' class='form-control' value='m2' name='satuan[".$key2."]'/></td>";
                        $html .= "</tr>";
                    }
                //}
                
            }
            
        }
        return response()->json( ["status" => "0", "html" => $html] );
    }

    public function savepekerjaan (Request $request){

        foreach ($request->item_id as $key => $value) {
            if ( $request->volume[$key] != "" && $request->satuan[$key] != "" && $request->nilai[$key] != "" ){
                $workorder = new WorkorderBudgetDetail;
                $workorder->workorder_id = $request->workorder_id;
                $workorder->budget_tahunan_id = $request->budget_tahunan;
                $workorder->itempekerjaan_id = $request->item_id[$key];
                $workorder->tahun_anggaran = date('Y');
                $workorder->volume = str_replace(",", "",$request->volume[$key]);
                $workorder->satuan = $request->satuan[$key];
                $workorder->nilai = str_replace(",", "", $request->nilai[$key]);
                $workorder->save();
            }
        }

        $budgettahunan = BudgetTahunan::find($request->budget_tahunan);
        if ( $budgettahunan->budget->project_kawasan_id == "" ){
            $WorkorderDetail = new WorkorderDetail;
            $WorkorderDetail->workorder_id = $request->workorder_id;
            $WorkorderDetail->asset_id = $budgettahunan->budget->project->id;
            $WorkorderDetail->asset_type = "Modules\Project\Entities\Project";
            $WorkorderDetail->save();
        }
        return redirect("/workorder/detail?id=".$request->workorder_id);
    }

    public function saveunits(Request $request){

        foreach ($request->asset as $key => $value) {
            if ( $request->asset[$key] != "" ){
                $asset_exist = WorkorderDetail::where("asset_id",$request->asset[$key])->where("workorder_id",$request->workorder_unit_id)->where("asset_type","Modules\Project\Entities\Unit")->get();
                if ( count($asset_exist) <= 0 ){
                    $workorder_unit = new WorkorderDetail;
                    $workorder_unit->workorder_id = $request->workorder_unit_id;
                    $workorder_unit->asset_id = $request->asset[$key];
                    $workorder_unit->asset_type = "Modules\Project\Entities\Unit";
                    $workorder_unit->description = 'auto';
                    $workorder_unit->save();
                }
            }
            
        }
        return redirect("/workorder/detail?id=".$request->workorder_unit_id);
    }

    public function deleteunit(Request $request){
        $workorder = WorkorderDetail::find($request->id);
        $status = $workorder->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function approve(Request $request){
        $workorder = Workorder::find($request->id);
        $approval = \App\Helpers\Document::make_approval('Modules\Workorder\Entities\Workorder',$workorder->id);
       
            return response()->json( ["status" => "0"] );
        
    }

    public function choosebudget(Request $request){
        $budget_tahunan = BudgetTahunan::find($request->budget_tahunan);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));    
        $workorder = Workorder::find($request->workoder_par_id);    
        return view("workorder::detail_budget",compact("budget_tahunan","user","project","workorder"));
    }
}

<?php

namespace Modules\Budget\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Budget\Entities\Budget;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectKawasan;
use Modules\Approval\Entities\Approval;
use Modules\Approval\Entities\ApprovalHistory;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Budget\Entities\BudgetDetail;
use Modules\Budget\Entities\BudgetTahunan;
use Modules\Budget\Entities\BudgetTahunanDetail;
use Modules\Budget\Entities\BudgetTahunanPeriode;
use Modules\Budget\Entities\BudgetCarryOver;
use Modules\Budget\Entities\BudgetHistoryHpp;
use Modules\Project\Entities\ProjectPtUser;
use Modules\Department\Entities\Department;
use Modules\Pt\Entities\Pt;
use Modules\Project\Entities\ProjectPt;

class BudgetController extends Controller
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
        $budget = $project->budgets;
        return view("budget::index",compact("user","project","budget"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $project = Project::find($request->id);
        $user= \Auth::user();
        $department = Department::get();
        return view('budget::create_budget_project',compact("project","user","department"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $budget = new Budget;
        $project = Project::find($request->session()->get('project_id'));
        $pt = Pt::find($request->pt_id);

        $number = \App\Helpers\Document::new_number('BDG', $request->department,$project->id).$pt->code;
        $budget->pt_id = $request->pt_id;
        $budget->department_id = $request->department;
        $budget->project_id = $request->project_id;
        if ( $request->iskawasan == "" ){
            $budget->project_kawasan_id = null;
        }else{
            $budget->project_kawasan_id = $request->kawasan;
        }
        $budget->no = $number;
        $budget->start_date = $request->start_date;
        $budget->end_date = $request->end_date;
        $budget->description = $request->description;
        $budget->created_by = \Auth::user()->id;
        $budget->save();

        //$approval = \App\Helpers\Document::make_approval('Modules\Budget\Entities\Budget',$budget->id);
        return redirect("budget/detail/?id=".$budget->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $budget = Budget::find($request->id);
        $user   = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $department = Department::get();
        return view('budget::show',compact("user","budget","project","department"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $budget = Budget::find($request->budget_id);
        $budget->department_id = $request->department;
        $budget->project_id = $request->project_id;
        if ( $request->iskawasan == "" ){
            $budget->project_kawasan_id = null;
        }else{
            $budget->project_kawasan_id = $request->kawasan;
        }
        $budget->start_date = date("Y-m-d H:i:s",strtotime($request->start_date));
        $budget->end_date = date("Y-m-d H:i:s",strtotime($request->end_date));
        $budget->description = $request->description;
        $budget->save();

        
        return redirect("budget/detail/?id=".$budget->id);
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

    public function itempekerjaan(Request $request){
        $budget = Budget::find($request->id);
        $user = \Auth::user();
        $itempekerjaan = Itempekerjaan::where("parent_id",null)->get();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::item",compact("budget","user","itempekerjaan","project"));
    }

    public function itemdetail(Request $request){
        $itempekerjaan = Itempekerjaan::find($request->id);
        $html = "";
        $start = 0;
         $html .= "<tr>";
        $html .= "<td><strong>".$itempekerjaan->code."</strong></td>";
        $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$itempekerjaan->id.")' data-attribute='1' id='btn_".$itempekerjaan->id."'>".$itempekerjaan->name."</td>";
        $html .= "<td>
                    <input type='hidden' class='form-control ' name='item_id[".$start."]' value='".$itempekerjaan->id."'/>
                    <input type='hidden' class='form-control' name='code[".$start."]' value='".$itempekerjaan->code."'/>
                    <input type='text' class='form-control nilai_budget' name='volume_[".$start."]' autocomplete='off'/></td>";
        $html .= "<td>
                    <input type='hidden' class='form-control' name='satuan_[".$start."]' value='".$itempekerjaan->satuan."' autocomplete='off' />
                    <input type='text' class='form-control' value='".$itempekerjaan->item_satuan."' autocomplete='off' disabled />
                    </td>";
        $html .= "<td><input type='text' class='form-control nilai_budget' name='nilai_[".$start."]' value='' autocomplete='off' /></td>";
        $html .= "</tr>";

        $status = "1";
        if ( $status ){
            return response()->json( ["status" => "0", "html" => $html] );
        }else{
            return response()->json( ["status" => "1", "html" => "" ] );
        }
    }

    public function itemsave(Request $request){
        foreach ($request->item_id as $key => $value) {
            if ( $request->volume_[$key] != "" && $request->nilai_[$key] != "" ){

                $budgetDetail = new BudgetDetail;
                $budgetDetail->budget_id = $request->budget_id;
                $budgetDetail->itempekerjaan_id = $request->item_id[$key];
                $budgetDetail->nilai = str_replace(",", "", $request->nilai_[$key]);
                $budgetDetail->volume = str_replace(",", "", $request->volume_[$key]);
                $budgetDetail->satuan = $request->satuan_[$key];
                $budgetDetail->save();
            }
        }
        return redirect("budget/detail/?id=".$request->budget_id);
    }

    public function itemupdate(Request $request){
        if ( $request->id != ""){
            $budgetDetail = BudgetDetail::find($request->id);
        }else{
            $budgetDetail = new BudgetDetail;
            $budgetDetail->budget_id = $request->budget_id;
            $budgetDetail->itempekerjaan_id = $request->itempekerjaan;
        }
        $budgetDetail->nilai = str_replace(",", "",$request->nilai);
        $budgetDetail->volume = str_replace(",", "",$request->volume);
        $status = $budgetDetail->save();
        if ( $status ){
            return response()->json( ["status" => "0"]);
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function deletebudget(Request $request){
        $budgetDetail = BudgetDetail::find($request->id);
        $status = $budgetDetail->delete();
        if ( $status ){
            return response()->json( ["status" => "0"]);
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function approval(Request $request){
        $budget = $request->id;
        $class  = "Budget";
        $approval = \App\Helpers\Document::make_approval('Modules\Budget\Entities\Budget',$budget);
        return response()->json( ["status" => "0"] );
    }

    public function cashlflow(Request $request){
        $budget = Budget::find($request->id);
        $user = \Auth::user();
        $start_date = $budget->start_date->year;
        $end_date = $budget->end_date->year;
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::cashflow",compact("budget","user","start_date","end_date","project"));
    }

    public function addcashflow(Request $request){
        $budget = Budget::find( $request->budget_id);
        $pt = Pt::find($budget->pt_id);
        $project = Project::find($request->session()->get('project_id'));
        $budget_tahunan                 = new BudgetTahunan;
        $budget_tahunan->budget_id      = $request->budget_id;
        $budget_tahunan->no             = \App\Helpers\Document::new_number('BDG-T', $budget->department->id,$project->id).$pt->code;
        $budget_tahunan->tahun_anggaran = $request->tahun_anggaran;
        $budget_tahunan->description    = $request->description;
        $status = $budget_tahunan->save();
        foreach ($budget->details as $key => $value) {
            $budgetDetail = new BudgetTahunanDetail;
            $budgetDetail->budget_tahunan_id = $budget_tahunan->id;
            $budgetDetail->itempekerjaan_id = $value->itempekerjaan_id;
            $budgetDetail->nilai = $value->nilai;
            $budgetDetail->volume = str_replace(",", "",$value->volume);
            $budgetDetail->satuan = str_replace(",", "",$value->satuan);
            $budgetDetail->save();
        }
        return redirect("/budget/cashflow/detail-cashflow?id=".$budget_tahunan->id);
    }

    public function detailcashflow(Request $request){
        $budget_tahunan = BudgetTahunan::find($request->id);
        $budget_parent = $budget_tahunan->budget->parent_id;
        $user = \Auth::user();
        $budget = $budget_tahunan->budget;
        $project = $budget->project;
        $start_date = $budget->start_date->year;
        $end_date = $budget->end_date->year;
        $array_cashflow = array();
        $start = 0;
        $nilai_sum_temp = 0;
        $spk = $project->spks;
        if ( $budget_parent != "" ){

        $budget_parent = Budget::find($budget_parent);
        $budget_devcost = $budget_parent->id;
        }else{
            $budget_devcost = $budget->id;
        }
        foreach ($spk as $key => $value) {
            # code...
            $spk = \Modules\Spk\Entities\Spk::find($value->id);
            $nilai = $spk->nilai;
            if ( ($spk->progresses != "" )) {
                if ( isset($spk->progresses->first()->itempekerjaan)) {
                    $pekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$spk->progresses->first()->itempekerjaan->parent->code)->get()->first();
                    if ( isset($pekerjaan->group_cost)){
                        $budgetdetail = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$pekerjaan->id)->where("budget_id",$budget_devcost)->get();
                        if ( count($budgetdetail) > 0 ){ 
                            $exp = explode("/", $spk->no);  
                            if ( $exp[5] == "17"){     
                                //if ( ($spk->nilai - round($spk->nilai_bap)) > 0 ){
                                    $array_cashflow[$start] = array(
                                        "nospk" => $spk->no,
                                        "nilaispk" => $spk->nilai,
                                        "bap" =>$spk->nilai_bap,
                                        "sisa" => ($spk->nilai - ($spk->nilai_bap)),
                                        "id" => $spk->id,
                                        "coa" => $spk->itempekerjaan->code.".00.00",
                                        "pekerjaan" => $spk->itempekerjaan->name
                                    );
                                $start++; 
                             }           
                        }else{
                            $nilai_sum_temp = $nilai_sum_temp + $spk->nilai;
                            
                        }                     
                    }                                       
                    
                }
                
            }
            
        }

        $carry_over = 0;
        $total_nilaasi = 0;
        if ( $array_cashflow != "" ){
            foreach ($array_cashflow as $key => $value) {
                $carry_over = $value["sisa"] + $carry_over;
                $total_nilaasi = $value["nilaispk"] +  $total_nilaasi;
            }
        }
        return view("budget::detail_cashflow2",compact("budget_tahunan","user","budget","start_date","end_date","array_cashflow","project","carry_over"));
    }

    public function updatecashflow(Request $request){
        $budget_tahunan                 = BudgetTahunan::find($request->budget_tahunan_id);
        $budget_tahunan->tahun_anggaran = $request->tahun_anggaran;
        $budget_tahunan->description    = $request->description;
        $status = $budget_tahunan->save();
        return redirect("/budget/cashflow/detail-cashflow?id=".$request->budget_tahunan_id);
    }

    public function itemcashflow(Request $request){
        $budget = BudgetTahunan::find($request->budget);
        $itempekerjaan = Itempekerjaan::where("code",$request->id)->first();
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $nilai = 0;

        $check = Itempekerjaan::find($itempekerjaan->id);
        $budget_detail = BudgetDetail::where("itempekerjaan_id",$check->id)->where("budget_id",$budget->budget->id)->get();
        if ( count($budget_detail) > 0 ){
            foreach( $budget_detail as $key => $value ){
                $nilai = $nilai + $value->volume * $value->nilai;
            }
        }
        foreach ($check->child_item as $key => $value) {
            $budget_detail = BudgetDetail::where("itempekerjaan_id",$value->id)->where("budget_id",$budget->budget->id)->get();
            if ( count($budget_detail) > 0 ){
                foreach( $budget_detail as $key => $value ){
                    $nilai = $nilai + $value->volume * $value->nilai;
                }
            }
        }

        $nilai_budget_awal = $nilai;
        return view("budget::cashflow_item",compact("budget","itempekerjaan","user","project","nilai_budget_awal"));
    }

    public function revitemcashflow(Request $request){
        $budget = BudgetTahunan::find($request->budget);
        $itempekerjaan = Itempekerjaan::where("code",$request->id)->first();
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::rev_cashflow_item",compact("budget","itempekerjaan","user","project"));
    }

    public function newitemcashflow(Request $request){
        $budget = BudgetTahunan::find($request->id);
        $user = \Auth::user();
        $itempekerjaan = Itempekerjaan::where("parent_id",null)->get();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::newcashflow_item",compact("budget","user","itempekerjaan","project"));
    }

    public function savecashflow(Request $request){
        foreach ($request->item_id as $key => $value) {
            if ( $request->Volume_[$key] != "" ){

                if ( $request->budgetdetail[$key] != "" ){
                    if ( $request->Volume_[$key] != "" && $request->nilai_[$key] != "" ){
                        $budgetDetail = BudgetTahunanDetail::find($request->budgetdetail[$key]);
                        $budgetDetail->nilai = str_replace(",", "",$request->nilai_[$key]);
                        $budgetDetail->volume = str_replace(",", "",$request->Volume_[$key]);
                        $budgetDetail->satuan = $request->satuan_[$key];
                        $budgetDetail->save();
                    }
                }else{
                    if ( $request->Volume_[$key] != "" && $request->nilai_[$key] != "" ){
                        $budgetDetail = new BudgetTahunanDetail;
                        $budgetDetail->budget_tahunan_id = $request->budget_id;
                        $budgetDetail->itempekerjaan_id = $request->item_id[$key];
                        $budgetDetail->nilai = str_replace(",", "",$request->nilai_[$key]);
                        $budgetDetail->volume = str_replace(",", "",$request->Volume_[$key]);
                        $budgetDetail->satuan = $request->satuan_[$key];
                        $budgetDetail->save();
                    }
                }

            }
        }
        return redirect("budget/cashflow/detail-cashflow/?id=".$request->budget_id);
    }

    public function viewcashflow(Request $request){
        $budget = BudgetTahunan::find($request->budget);
        $itempekerjaan = Itempekerjaan::where("code",$request->id)->first();
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::cashflow_view_item",compact("budget","itempekerjaan","user","project"));
    }

    public function updateitemcashflow(Request $request){
        foreach ($request->item_id as $key => $value) {
            $budgetDetail = BudgetTahunanDetail::find($request->item_id[$key]);
            $budgetDetail->nilai = $request->nilai_[$key];
            $budgetDetail->volume = $request->volume_[$key];
            $budgetDetail->satuan = $request->satuan_[$key];
            $budgetDetail->save();
        }
        return redirect("budget/cashflow/detail-cashflow/?id=".$request->budget_id);
    }

    public function savemonthly(Request $request){
        $budgetperiode = new BudgetTahunanPeriode;
        $budgetperiode->budget_id = $request->budget_tahunan_id;
        $budgetperiode->itempekerjaan_id = $request->item_id_monthly;
        $budgetperiode->januari = $request->januari;
        $budgetperiode->februari = $request->februari;
        $budgetperiode->maret = $request->maret;
        $budgetperiode->april = $request->april;
        $budgetperiode->mei = $request->mei;
        $budgetperiode->juni = $request->juni;
        $budgetperiode->juli = $request->juli;
        $budgetperiode->agustus = $request->agustus;
        $budgetperiode->september = $request->september;
        $budgetperiode->oktober = $request->oktober;
        $budgetperiode->november = $request->november;
        $budgetperiode->desember = $request->desember;
        $budgetperiode->save();
        
        return redirect("budget/cashflow/detail-cashflow/?id=".$request->budget_tahunan_id);
    }

    public function updatemonthly(Request $request){
        $budgetperiode = BudgetTahunanPeriode::find($request->id);
        $budgetperiode->januari = $request->jan;
        $budgetperiode->februari = $request->feb;
        $budgetperiode->maret = $request->mar;
        $budgetperiode->april = $request->apr;
        $budgetperiode->mei = $request->mei;
        $budgetperiode->juni = $request->jun;
        $budgetperiode->juli = $request->jul;
        $budgetperiode->agustus = $request->agu;
        $budgetperiode->september = $request->sept;
        $budgetperiode->oktober = $request->okt;
        $budgetperiode->november = $request->nov;
        $budgetperiode->desember = $request->des;
        $status = $budgetperiode->save();
        if ( $status ){
            return response()->json( ["status" => "0"]);
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function deletemonthly(Request $request){
        $budgetperiode = BudgetTahunanPeriode::find($request->id);
        $status = $budgetperiode->delete();
        if ( $status ){
            return response()->json( ["status" => "0"]);
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function approval_cashflow(Request $request){
        $budget = $request->id;
        $class  = "BudgetTahunan";
        $approval = \App\Helpers\Document::make_approval('Modules\Budget\Entities\BudgetTahunan',$budget);
        return response()->json( ["status" => "0"] );
    }

    public function createrobot(Request $request){
        $project = Project::find($request->id);        
        $budget = $project->budget;
        $spk = $project->spks;
        $budget_devcost = "1";
        $budget_concost = "2";

     

        

        foreach ($spk as $key => $value) {
            # code...
            $spk = \Modules\Spk\Entities\Spk::find($value->id);
            $nilai = $spk->nilai;
            if ( ($spk->progresses != "" )) {
                if ( isset($spk->progresses->first()->itempekerjaan)) {
                    $pekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$spk->progresses->first()->itempekerjaan->code.".00")->get()->first();
                    if ( $pekerjaan->group_cost == "1"){
                        $budgetdetail = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$pekerjaan->id)->where("budget_id",$budget_devcost)->get();
                        if ( count($budgetdetail) > 0 ){ 
                            $exp = explode("/", $spk->no);  
                            if ( $exp[5] == "17"){                                              
                                echo $spk->nilai_bap."<>".$spk->id."<>".$nilai."<>".$spk->progresses->first()->itempekerjaan->code.".00"."<>".$pekerjaan->id."<>".($spk->nilai - round($spk->nilai_bap));
                                echo "<br/>";

                           }           
                        }
                    }                    
                    
                }
                
            }
            
        }
    }

    public function revisibudget(Request $request){
        $budget = Budget::find($request->id);
        $project = $budget->project;
        $user = \Auth::user();
        return view("budget::create_revision",compact("budget","project","user"));
    }

    public function saverevisi(Request $request){
        $budget_awal = Budget::find($request->budget_id);
        $budget_awal->deleted_at = date("Y-m-d H:i:s");
        $budget_awal->save();

        $budget = new Budget;
        //$number = \App\Helpers\Document::new_number('BDG-R', $budget_awal->department_id);
        $number = $budget_awal->no."-R".(Budget::where("parent_id",$budget_awal->id)->count() + 1 );
        $budget->pt_id = $budget_awal->pt_id;
        $budget->department_id = $budget_awal->department_id;
        $budget->project_id = $budget_awal->project_id;        
        $budget->project_kawasan_id = $budget_awal->project_kawasan_id;        
        $budget->no = $number;
        $budget->start_date = $budget_awal->start_date;
        $budget->end_date = $budget_awal->end_date;
        $budget->description = $request->description;
        $budget->parent_id = $budget_awal->id;
        $budget->created_by = \Auth::user()->id;
        $budget->save();

        foreach ($budget_awal->details as $key => $value) {
            $budgetDetail = new BudgetDetail;
            $budgetDetail->budget_id = $budget->id;
            $budgetDetail->itempekerjaan_id = $value->itempekerjaan_id;
            $budgetDetail->nilai = $value->nilai;
            $budgetDetail->volume = $value->volume;
            $budgetDetail->satuan = $value->satuan;
            $budgetDetail->save();
        }
        //$approval = \App\Helpers\Document::make_approval('Modules\Budget\Entities\Budget',$budget->id);
        return redirect("budget/detail/?id=".$budget->id);
    }

    public function detailrevisi(Request $request){
        $budget = Budget::find($request->id);
        $parent = Budget::find($budget->parent_id);
        $project = $budget->project;
        $user = \Auth::user();
        return view("budget::revisi",compact("budget","project","user","parent"));
    }

    public function itemrevisi(Request $request){
        $budget = Budget::find($request->id);
        $itempekerjaan_id = Itempekerjaan::where("id",$request->coa)->get()->first()->id;
        $itempekerjaan = Itempekerjaan::find($itempekerjaan_id);
        $project = $budget->project;
        $user = \Auth::user();
        return view("budget::item_revisi",compact("budget","user","project","itempekerjaan"));
    }

    public function saveitemrevisi(Request $request){
        foreach ($request->item_id as $key => $value) {
            if ( $request->Volume_[$key] != ""  ){                    
                if ( $request->budgetdetail[$key] != "" ){
                    $budgetDetail = BudgetDetail::find($request->budgetdetail[$key]);
                    $budgetDetail->nilai = str_replace(",", "",$request->nilai_[$key]);
                    $budgetDetail->volume = str_replace(",", "",$request->Volume_[$key]);
                    $budgetDetail->satuan = $request->satuan_[$key];
                    $budgetDetail->save();
                }else{
                    $budgetDetail = new BudgetDetail;
                    $budgetDetail->budget_id = $request->budget_id;
                    $budgetDetail->itempekerjaan_id = $request->item_id[$key];
                    $budgetDetail->nilai = str_replace(",", "",$request->nilai_[$key]);
                    $budgetDetail->volume = str_replace(",", "",$request->Volume_[$key]);
                    $budgetDetail->satuan = $request->satuan_[$key];
                    $budgetDetail->save();
                }
                
            }
            
        }
        
        return redirect("budget/show-budgetrevisi/?id=".$request->budget_id);
    }

    public function listrevisi(Request $request){
        $budget = Budget::where("parent_id",$request->id)->get();
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::index_revisi",compact("project","user","budget"));
    }

    public function savecaryyover(Request $request){
        foreach ($request->settospk as $key => $value) {
            if ( $request->settospk[$key] != "" ){
                $budgetDetail = new BudgetCarryOver;
                $budgetDetail->budget_tahunan_id = $request->carryover_budget_id;
                $budgetDetail->spk_id = $request->settospk[$key];
                $budgetDetail->save();
            }
        }
         return redirect("budget/cashflow/detail-cashflow/?id=".$request->carryover_budget_id);
    }

    public function deletecarryover(Request $request){
        $budgetDetail = BudgetCarryOver::find($request->id);
        $status = $budgetDetail->delete();
        if ( $status ){
            return response()->json( ["status" => "0"]);
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function createhpp(Request $request){
        echo $request->id;
        $project = Project::find($request->id);
        foreach ($project->budgets as $key => $value) {
            $budget = Budget::find($value->id);
            $BudgetHistoryHpp = new BudgetHistoryHpp;

            $BudgetHistoryHpp->project_id = $request->id;
            $BudgetHistoryHpp->project_kawasan_id = $budget->project_kawasan_id;
            $BudgetHistoryHpp->budget_id = $budget->id;
            if ( $budget->project_kawasan_id == "" ){                
                $BudgetHistoryHpp->luas_netto = "0";
                $BudgetHistoryHpp->luas_brutto = $budget->project_kawasan_id;
            }else{
                $projectkawasan = ProjectKawasan::find($budget->project_kawasan_id);
                $BudgetHistoryHpp->luas_netto = $projectkawasan->lahan_sellable;
                $BudgetHistoryHpp->luas_brutto = $projectkawasan->lahan_luas;
            }
            $BudgetHistoryHpp->save();
        }
    }

    public function additemrevisi(Request $request){
        $budget = Budget::find($request->id);
        $user = \Auth::user();
        $itempekerjaan = Itempekerjaan::where("parent_id",null)->get();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::newitem_revisi",compact("budget","user","itempekerjaan","project"));
    }

    public function savenewitemrevisi(Request $request){

        foreach ($request->item_id as $key => $value) {
            if ( $request->volume_[$key] != ""){
                $budgetDetail = new BudgetDetail;
                $budgetDetail->budget_id = $request->budget_id;
                $budgetDetail->itempekerjaan_id = $request->item_id[$key];
                $budgetDetail->nilai = $request->nilai_[$key];
                $budgetDetail->volume = $request->volume_[$key];
                $budgetDetail->satuan = $request->satuan_[$key];
                $budgetDetail->save();
            }
            
        }
        return redirect("/budget/show-budgetrevisi?id=".$request->budget_id);
    }

    public function savenewitemcashflow(Request $request){

        foreach ($request->item_id as $key => $value) {
            if ( $request->volume_[$key] != ""){
                $budgetDetail = new BudgetTahunanDetail;
                $budgetDetail->budget_tahunan_id = $request->budget_id;
                $budgetDetail->itempekerjaan_id = $request->item_id[$key];
                $budgetDetail->nilai = str_replace(",", "",$request->nilai_[$key]);
                $budgetDetail->volume = $request->volume_[$key];
                $budgetDetail->satuan = $request->satuan_[$key];
                $budgetDetail->save();
            }
            
        }
        return redirect("/budget/cashflow/detail-cashflow?id=".$request->budget_id);
    }

    public function saverevitem(Request $request){
        foreach ($request->item_id as $key => $value) {
            if ( $request->Volume_[$key] != "" ){

                if ( $request->budgetdetail[$key] != "" ){
                    $budgetDetail = BudgetTahunanDetail::find($request->budgetdetail[$key]);
                    $budgetDetail->nilai = str_replace(",", "",$request->nilai_[$key]);
                    $budgetDetail->volume = $request->Volume_[$key];
                    $budgetDetail->satuan = $request->satuan_[$key];
                    $budgetDetail->save();
                }else{
                    $budgetDetail = new BudgetTahunanDetail;
                    $budgetDetail->budget_tahunan_id = $request->budget_id;
                    $budgetDetail->itempekerjaan_id = $request->item_id[$key];
                    $budgetDetail->nilai = str_replace(",", "",$request->nilai_[$key]);
                    $budgetDetail->volume = $request->Volume_[$key];
                    $budgetDetail->satuan = $request->satuan_[$key];
                    $budgetDetail->save();
                }

            }
        }

        $document = BudgetTahunan::find($request->budget_id);
        $apprival = $document->approval->id;
        $approval = Approval::find($apprival);
        if ( $approval != ""){
            $approval->approval_action_id = "1";
            $approval->save();

            if ( count($approval->histories) > 0 ){
                foreach ($approval->histories as $key => $value) {
                    $histories = ApprovalHistory::find($value->id);
                    $histories->approval_action_id = "1";
                    $histories->save();
                }
            }else{
                $approval_references = \Modules\Approval\Entities\ApprovalReference::where('document_type', 'BudgetTahunan')
                                    ->where('project_id', session('project_id') )
                                    //->where('pt_id', $pt_id )
                                    ->where('min_value', '<=', $approval->total_nilai)
                                    //->where('max_value', '>=', $approval->total_nilai)
                                    ->orderBy('no_urut','ASC')
                                    ->get();
                foreach ($approval_references as $key => $each)  {
                    /* Departmen ID = 11 is Direksi */
                    //$department_id = \App\User::find($each->user_id)->details->first()->mappingperusahaan->department_id;
                    $user_level = \App\User::find($each->user_id)->details->first()->user_level;
                    if ( /*$department_id == $department_from || */$user_level <= 4 ){
                        $document->approval_histories()->create([
                        'no_urut' => $each->no_urut,
                        'user_id' => $each->user_id,
                        'approval_action_id' => 1, // open
                        'approval_id' => $approval->id
                         ]);
                    }     
                }
            }
        }else{
            $budget = $request->id;
            $class  = "BudgetTahunan";
            $approval = \App\Helpers\Document::make_approval('Modules\Budget\Entities\BudgetTahunan',$budget);
        }

       
        return redirect("budget/cashflow/detail-cashflow/?id=".$request->budget_id);
    }

    public function edititem(Request $request){
        $itempekerjaan = Itempekerjaan::find($request->item);
        $budget = Budget::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::item_global",compact("user","project","budget","itempekerjaan"));
    }

    public function saveitem(Request $request){
        foreach ($request->item_id as $key => $value) {
            if ( $request->Volume_[$key] != "" ){

                if ( $request->budgetdetail[$key] != "" ){
                    $budgetDetail = BudgetDetail::find($request->budgetdetail[$key]);
                    $budgetDetail->nilai = str_replace(",", "",$request->nilai_[$key]);
                    $budgetDetail->volume = $request->Volume_[$key];
                    $budgetDetail->satuan = $request->satuan_[$key];
                    $budgetDetail->save();
                }else{
                    $budgetDetail = new BudgetDetail;
                    $budgetDetail->budget_id = $request->budget_id;
                    $budgetDetail->itempekerjaan_id = $request->item_id[$key];
                    $budgetDetail->nilai = str_replace(",", "",$request->nilai_[$key]);
                    $budgetDetail->volume = $request->Volume_[$key];
                    $budgetDetail->satuan = $request->satuan_[$key];
                    $budgetDetail->save();
                }

            }
        }
        return redirect("budget/detail/?id=".$request->budget_id);
    }

    public function approval_history(Request $request){
        $budget_tahunan = BudgetTahunan::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::approval_history",compact("user","project","budget_tahunan"));
    }

    public function draft(Request $request){
        $budget = Budget::find($request->id);
        $budget_draft = $budget->draft;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::budget_draft",compact("user","project","budget_draft","budget"));
    }

    public function updateapproval(Request $request){
        $approval = Approval::find($request->approval_id);
        $approval->approval_action_id = "1";
        $approval->save();

        $histories = $approval->histories;
        foreach ($histories as $key => $value) {
           $approval_history = ApprovalHistory::find($value->id);
           $approval_history->approval_action_id = "1";
           $approval_history->save();
        }
        return response()->json( ["status" => "0"]);
    }

    public function approvalhistory(Request $request){
        $budget = Budget::find($request->id);
        $approval = $budget->approval;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::approval_history_global",compact("budget","approval","user","project"));
    }

    public function reapproval(Request $request){


        $budget = Budget::find($request->id);
        $approval = \App\Approval::find($budget->approval->id);
        $document = $approval->document;

        $project = Project::find($request->session()->get('project_id'));
        $approval_references = \Modules\Approval\Entities\ApprovalReference::where('document_type', "Budget")
            ->where('project_id', $project->id )
            //->where('pt_id', $pt_id )
            ->where('min_value', '<=', $budget->nilai)
            //->where('max_value', '>=', $approval->total_nilai)
            ->orderBy('no_urut','ASC')
            ->get();

        foreach ($approval_references as $key => $each) {
            # code...
            $user = \Modules\User\Entities\User::find($each->user_id);
            if ( $budget->approval->histories != "" ){
                $cek = $budget->approval->histories->where("user_id",$each->user_id);
                if ( count($cek) <= 0 ){
                    $document->approval_histories()->create([
                        'no_urut' => $each->no_urut,
                        'user_id' => $each->user_id,
                        'approval_action_id' => 1, // open
                        'approval_id' => $approval->id,
                        'no_urut' => $each->no_urut
                    ]);
                }
            }else{
                $document->approval_histories()->create([
                    'no_urut' => $each->no_urut,
                    'user_id' => $each->user_id,
                    'approval_action_id' => 1, // open
                    'approval_id' => $approval->id,
                    'no_urut' => $each->no_urut
                ]);
            }
            
        }
        return response()->json( ["status" => "0"]);
    }

}

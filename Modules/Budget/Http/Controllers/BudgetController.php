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
use Modules\Project\Entities\UnitType;
use Modules\Budget\Entities\BudgetType;
use Modules\Budget\Entities\BudgetCarryOverCashflow;
use Modules\Budget\Entities\BudgetTahunanUnit;
use Modules\Budget\Entities\BudgetTahunanUnitPeriode;
use Modules\Budget\Entities\BudgetTahunanUnitPeriodeDetail;

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

        /*$budget_type = BudgetType::get();
        foreach ($budget_type as $key => $value) {
            if ( $value->itempekerjaan_id == 1 ){
                foreach ($value->details as $key2 => $value2) {
                    $budgetDetail = new BudgetDetail;
                    $budgetDetail->budget_id = $budget->id;
                    $budgetDetail->itempekerjaan_id = $value2->itempekerjaan->id;
                    $budgetDetail->nilai = str_replace(",", "", $value2->itempekerjaan->nilai_master_satuan);
                    $budgetDetail->volume = 0;
                    $budgetDetail->satuan = $value2->itempekerjaan->details->satuan;
                    $budgetDetail->save();
                }
            }
        }*/

        $itempekerjaan = Itempekerjaan::get();
        foreach ($itempekerjaan as $key => $value) {
            if ( $value->parent_id == null ){

                if ( $request->iskawasan == "" ){
                    if ( $value->code == "240" ){
                        foreach ($value->child_item as $key2 => $value2) {
                            $budgetDetail = new BudgetDetail;
                            $budgetDetail->budget_id = $budget->id;
                            $budgetDetail->itempekerjaan_id = $value2->id;
                            $budgetDetail->nilai = str_replace(",", "", $value2->nilai_master_satuan);
                            $budgetDetail->volume = 0;
                            if ( $value2->details != "" ){
                                $budgetDetail->satuan = $value2->details->satuan;
                            }else{
                                $budgetDetail->satuan = 'ls';
                            }
                            $budgetDetail->save();
                        }
                    }
                }else{
                    if ( $value->code != "240" ){
                        if ( $value->group_cost == 1 ){
                            $budgetDetail = new BudgetDetail;
                            $budgetDetail->budget_id = $budget->id;
                            $budgetDetail->itempekerjaan_id = $value->id;
                            $budgetDetail->nilai = str_replace(",", "", $value->nilai_master_satuan);
                            $budgetDetail->volume = 0;
                            if ( $value->details != "" ){
                                $budgetDetail->satuan = $value->details->satuan;
                            }else{
                                $budgetDetail->satuan = 'ls';
                            }
                            $budgetDetail->save();
                        } elseif ( $value->id == 292 ){
                            $budgetDetail = new BudgetDetail;
                            $budgetDetail->budget_id = $budget->id;
                            $budgetDetail->itempekerjaan_id = $value->id;
                            $budgetDetail->nilai = str_replace(",", "", $value->nilai_master_satuan);
                            $budgetDetail->volume = 0;
                            if ( $value->details != "" ){
                                $budgetDetail->satuan = $value->details->satuan;
                            }else{
                                $budgetDetail->satuan = 'ls';
                            }
                            $budgetDetail->save();
                        }
                    }                    
                }
            }
        }


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
        $array = array (
            "6" => array("label" => "Disetujui", "class" => "label label-success"),
            "7" => array("label" => "Ditolak", "class" => "label label-danger"),
            "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
        );
        return view('budget::show',compact("user","budget","project","department","array"));
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
        $budget->start_date = date("Y-m-d H:i:s.u",strtotime($request->start_date));
        $budget->end_date = date("Y-m-d H:i:s.u",strtotime($request->end_date));
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
                    <input type='hidden' class='form-control' name='satuan_[".$start."]' value='".$itempekerjaan->details->satuan."' autocomplete='off' />
                    <input type='text' class='form-control' value='".$itempekerjaan->details->satuan."' autocomplete='off' disabled />
                    </td>";
        $html .= "<td><input type='text' class='form-control nilai_budget' name='nilai_[".$start."]' autocomplete='off' /></td>";
        $html .= "</tr>";

        $status = "1";
        if ( $status ){
            return response()->json( ["status" => "0", "html" => $html] );
        }else{
            return response()->json( ["status" => "1", "html" => "" ] );
        }
    }

    public function itemsave(Request $request){
        $budgetdetail = BudgetDetail::find($request->budget_detail_id);
        $budgetdetail->nilai = str_replace(",", "", $request->nilai);
        $budgetdetail->volume = str_replace(",", "", $request->volume);
        $budgetdetail->description = $request->Keterangan;
        $budgetdetail->save();

        return redirect("budget/referensi/?id=".$budgetdetail->id);
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
        $start = 0;
        foreach ($budget->details as $key => $value) {
            $start = 0;
            if ( $value->itempekerjaan->group_cost == 1 ){
                foreach ($value->itempekerjaan->child_item as $key1 => $value1) {
                    if ( $start == 0 ){
                        $volume = $value->volume;
                        $nilai = $value->nilai;
                    }else{
                        $volume = 0;
                        $nilai = 0;
                    }
                    $budgetDetail = new BudgetTahunanDetail;
                    $budgetDetail->budget_tahunan_id = $budget_tahunan->id;
                    $budgetDetail->itempekerjaan_id = $value1->id;
                    $budgetDetail->nilai = $nilai;
                    $budgetDetail->volume = $volume;
                    if ( $value1->details != "" ){
                        $budgetDetail->satuan = $value1->details->satuan;
                    }else{
                        $budgetDetail->satuan = 'ls';
                    }
                    $budgetDetail->save();
                    $start++;
                }   
            }else{
               
                $budgetDetail = new BudgetTahunanDetail;
                $budgetDetail->budget_tahunan_id = $budget_tahunan->id;
                $budgetDetail->itempekerjaan_id = 293;
                $budgetDetail->nilai = $value->nilai;
                $budgetDetail->volume = $value->volume;
                if ( $value->itempekerjaan->details != "" ){
                    $budgetDetail->satuan = $value->itempekerjaan->details->satuan;
                }else{
                    $budgetDetail->satuan = 'ls';
                }
                $budgetDetail->save();
                $start++;
            }                     
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
        $array_carryover = array();
        if ( $budget_parent != "" ){

        $budget_parent = Budget::find($budget_parent);
        $budget_devcost = $budget_parent->id;
        }else{
            $budget_devcost = $budget->id;
        }


        if ( $budget_tahunan->budget->kawasan != "" ){
            $asset_id = $budget_tahunan->budget->project_kawasan_id;
        }else{
            $asset_id = $budget_tahunan->budget->project_id;
        }
        
        foreach ($spk as $key => $value) {
            # code...
            $spk_2 = \Modules\Spk\Entities\Spk::find($value->id);
            $nilai = $spk_2->nilai;
            if ( ($spk_2->progresses != "" )) {
                if ( isset($spk_2->progresses->first()->itempekerjaan)) {
                    $pekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$spk_2->progresses->first()->itempekerjaan->parent->code)->get()->first();
                    if ( isset($pekerjaan->group_cost)){
                        $budgetdetail = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$pekerjaan->id)->where("budget_id",$budget_devcost)->get();
                        if ( count($budgetdetail) > 0 ){ 
                            $exp = explode("/", $spk_2->no);  
                            if ( count($exp) > 5 ){                                
                                if ( $exp[5] <= date("Y")){     
                                    //if ( ($spk->nilai - round($spk->nilai_bap)) > 0 ){
                                        $array_cashflow[$start] = array(
                                            "nospk" => $spk_2->no,
                                            "nilaispk" => $spk_2->nilai,
                                            "bap" =>$spk_2->nilai_bap,
                                            "sisa" => ($spk_2->nilai - ($spk_2->nilai_bap)),
                                            "id" => $spk_2->id,
                                            "coa" => $spk_2->itempekerjaan->code.".00.00",
                                            "pekerjaan" => $spk_2->itempekerjaan->name
                                        );
                                    $start++; 
                                 }
                            }           
                        }else{
                            $nilai_sum_temp = $nilai_sum_temp + $spk_2->nilai;
                            
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

        foreach ($budget_tahunan->carry_over as $key => $value) {
            $array_carryover[$key] = array(
                "no_spk" => $value->spk->no,
                "pekerjaan" => $value->spk->name,
                "nilai_spk" => $value->nilai,
                "terbayar" => $value->spk->nilai_bap,
                "sisa" => $value->spk->nilai - $value->spk->nilai_bap,
                "januari" => $value->januari,
                "februari" => $value->februari,
                "maret" => $value->maret,
                "april" => $value->april,
                "mei" => $value->mei,
                "juni" => $value->juni,
                "juli" => $value->juli,
                "agustus" => $value->agustus,
                "september" => $value->september,
                "oktober" => $value->oktober,
                "november" => $value->november,
                "desember" => $value->desember
            );
        }

        $nilai_sisa_dev_cost = 0;
        $nilai_sisa_con_cost = 0;
        //$spk = $budget_tahunan->budget->project->spks;
        foreach ($spk as $key => $value) {
            if ( $value->date->format("Y") <= date("Y")){
                if ( $value->itempekerjaan != "" ){
                    if ( $value->itempekerjaan->group_cost == 1 ){
                        if ( $value->details != "" ){
                            foreach ($value->details as $key2 => $value2) {
                                if ( $value2->asset != "" ){
                                    if ( $value2->asset->id == $asset_id ){
                                        if ( $value->baps != "" ){
                                            $bayar = $value->terbayar_verified / 1.1;
                                        }else{
                                            $bayar = 0;
                                        }

                                        $sisa = ( $value->nilai + $value->nilai_vo ) - $bayar;
                                        if ( $sisa > 0 ){
                                            $nilai_sisa_dev_cost = $sisa + $nilai_sisa_dev_cost;  
                                        }                         
                                    }
                                }                            
                            }
                        }
                    }else{
                        if ( $value->tender->rab != "" ){
                            if ( $value->tender->rab->budget_tahunan != "" ){
                                if ( $value->tender->rab->budget_tahunan->budget->project_kawasan_id == $asset_id ){
                                    if ( $value->baps != "" ){
                                        $bayar = $value->baps->sum("nilai_bap_2");
                                    }else{
                                        $bayar = 0;
                                    }

                                    $sisa = $value->nilai - $bayar;
                                    if ( $sisa > 0 ){
                                        $nilai_sisa_con_cost = $sisa + $nilai_sisa_con_cost;  
                                    } 
                                }
                            }elseif( $value->project_kawasan_id == $asset_id){
                                if ( $value->baps != "" ){
                                    $bayar = $value->baps->sum("nilai_bap_2");
                                }else{
                                    $bayar = 0;
                                }

                                $sisa = $value->nilai - $bayar;
                                if ( $sisa > 0 ){
                                    $nilai_sisa_con_cost = $sisa + $nilai_sisa_con_cost;  
                                }   
                            }
                        }
                    }
                }
                   
            }                        
        }

        return view("budget::detail_cashflow2",compact("budget_tahunan","user","budget","start_date","end_date","array_cashflow","project","carry_over","array_carryover","nilai_sisa_dev_cost","nilai_sisa_con_cost"));
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
        
        return response()->json( ["status" => "0"]);
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
        $budget_awal->deleted_at = date("Y-m-d H:i:s.u");
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

        /*foreach ($budget_awal->details as $key => $value) {
            $budgetDetail = new BudgetDetail;
            $budgetDetail->budget_id = $budget->id;
            $budgetDetail->itempekerjaan_id = $value->itempekerjaan_id;
            $budgetDetail->nilai = $value->nilai;
            $budgetDetail->volume = $value->volume;
            $budgetDetail->satuan = $value->satuan;
            $budgetDetail->save();
        }*/
        
        $itempekerjaan = Itempekerjaan::get();
        foreach ($itempekerjaan as $key => $value) {
            if ( $value->parent_id == null ){

                if ( $budget_awal->project_kawasan_id == "" ){
                    if ( $value->code == "240" ){
                        foreach ($value->child_item as $key2 => $value2) {
                            $budgetDetail = new BudgetDetail;
                            $budgetDetail->budget_id = $budget->id;
                            $budgetDetail->itempekerjaan_id = $value2->id;
                            $budgetDetail->nilai = str_replace(",", "", $value2->nilai_master_satuan);
                            $budgetDetail->volume = 0;
                            if ( $value2->details != "" ){
                                $budgetDetail->satuan = $value2->details->satuan;
                            }else{
                                $budgetDetail->satuan = 'ls';
                            }
                            $budgetDetail->save();
                        }
                    }
                }else{
                    if ( $value->code != "240" ){
                        if ( $value->group_cost == 1 ){
                            $budgetDetail = new BudgetDetail;
                            $budgetDetail->budget_id = $budget->id;
                            $budgetDetail->itempekerjaan_id = $value->id;
                            $budgetDetail->nilai = str_replace(",", "", $value->nilai_master_satuan);
                            $budgetDetail->volume = 0;
                            if ( $value->details != "" ){
                                $budgetDetail->satuan = $value->details->satuan;
                            }else{
                                $budgetDetail->satuan = 'ls';
                            }
                            $budgetDetail->save();
                        } elseif ( $value->id == 292 ){
                            $budgetDetail = new BudgetDetail;
                            $budgetDetail->budget_id = $budget->id;
                            $budgetDetail->itempekerjaan_id = $value->id;
                            $budgetDetail->nilai = str_replace(",", "", $value->nilai_master_satuan);
                            $budgetDetail->volume = 0;
                            if ( $value->details != "" ){
                                $budgetDetail->satuan = $value->details->satuan;
                            }else{
                                $budgetDetail->satuan = 'ls';
                            }
                            $budgetDetail->save();
                        }
                    }                    
                }
            }
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

        if ( $request->settospk ){

            foreach ($request->settospk as $key => $value) {
                if ( $request->settospk[$key] != "" ){
                    $budgetDetail = new BudgetCarryOver;
                    $budgetDetail->budget_tahunan_id = $request->budget_id;
                    $budgetDetail->spk_id = $request->settospk[$key];
                    $budgetDetail->save();
                }
            }
        }
         return redirect("budget/cashflow/detail-cashflow/?id=".$request->budget_id);
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

/*        $document = BudgetTahunan::find($request->budget_id);
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
                    $user_level = \App\User::find($each->user_id)->details->first()->user_level;
                    
                        $document->approval_histories()->create([
                        'no_urut' => $each->no_urut,
                        'user_id' => $each->user_id,
                        'approval_action_id' => 1, // open
                        'approval_id' => $approval->id
                         ]);
                         
                }
            }
        }else{
            $budget = $request->id;
            $class  = "BudgetTahunan";
            $approval = \App\Helpers\Document::make_approval('Modules\Budget\Entities\BudgetTahunan',$budget);
        }*/

       
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

    public function referensi(Request $request){
        $budgetdetail = BudgetDetail::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $itempekerjaan = $budgetdetail->itempekerjaan;
        return view("budget::item_referensi",compact("budgetdetail","project","user","itempekerjaan"));
    }

    public function itemrevisisavet(Request $request){
        $budget = Budget::find($request->budget_id);
        foreach ($request->item_id as $key => $value) {
            $itempekerjaan = Itempekerjaan::find($request->item_id[$key]);
            if ( $request->satuan_[$key] != "" ){
                $budgetdetail = new BudgetDetail;
                $budgetdetail->budget_id = $budget->id;
                $budgetdetail->itempekerjaan_id = $request->item_id[$key];
                $budgetdetail->nilai = str_replace(",", "", $request->nilai_[$key]);
                $budgetdetail->volume = str_replace(",", "", $request->volume_[$key]);
                $budgetdetail->satuan = $request->satuan_[$key];
                $budgetdetail->save();                
            }
        }
        return redirect("budget/detail/?id=".$request->budget_id);
    }

    public function itemsavemonthlyco(Request $request){
        $user = \Auth::user();
        $carry_over_cashflow = new BudgetCarryOverCashflow;
        $carry_over_cashflow->budget_carry_over_id = $request->item_id_monthly_co;
        $carry_over_cashflow->created_by = $user->id;
        $carry_over_cashflow->januari = $request->januari_co;
        $carry_over_cashflow->februari = $request->februari_co;
        $carry_over_cashflow->maret = $request->maret_co;
        $carry_over_cashflow->april = $request->april_co;
        $carry_over_cashflow->mei = $request->mei_co;
        $carry_over_cashflow->juni = $request->juni_co;
        $carry_over_cashflow->juli = $request->juli_co;
        $carry_over_cashflow->agustus = $request->agustus_co;
        $carry_over_cashflow->september = $request->september_co;
        $carry_over_cashflow->oktober = $request->oktober_co;
        $carry_over_cashflow->november = $request->november_co;
        $carry_over_cashflow->desember = $request->desember_co;
        $carry_over_cashflow->save();
        return redirect("budget/cashflow/detail-cashflow/?id=".$request->budget_tahunan_id);
    }

    public function cashflowconcost(Request $request){
        $budget_tahunan = BudgetTahunan::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("budget::item_tahunan_concost",compact("user","budget_tahunan","project"));
    }

    public function saveitemconcost(Request $request){
        $user = \Auth::user();
        $budget_tahunan = BudgetTahunan::find($request->budget_tahunan_id);
        foreach ($request->item_id_ as $key => $value) {  
                 
            $budget_tahunan_detail = BudgetTahunanDetail::find($request->item_id_[$key]);
            $budget_tahunan_detail->volume = str_replace(",", "", $request->volume_[$key]);
            $budget_tahunan_detail->save();
        }   

        if ( $budget_tahunan->budget_unit != "" ){
            foreach ($budget_tahunan->budget_unit as $key => $value) {
                $del_budget_unit = BudgetTahunanUnit::find($value->id);
                $del_budget_unit = $del_budget_unit->delete();
            }
        }

        foreach ($request->unit_type_ as $key => $value) {
            $unit_type = UnitType::find($request->unit_type_[$key]);
            if ( $request->harga_satuan[$key] != "" ){
                $budget_tahunan_unit = new BudgetTahunanUnit;
                $budget_tahunan_unit->budget_tahunan_id = $request->budget_tahunan_id;
                $budget_tahunan_unit->harga_satuan = str_replace(",", "", $request->harga_satuan[$key]);
                $budget_tahunan_unit->unit_type_id = $request->unit_type_[$key];
                $budget_tahunan_unit->volume = $request->total_unit_type[$key] * $unit_type->luas_bangunan;
                $budget_tahunan_unit->satuan = 'm2';
                $budget_tahunan_unit->total_unit = $request->total_unit_type[$key];
                $budget_tahunan_unit->created_by = $user->id;
                $budget_tahunan_unit->save();

                $budget_tahunan_unit_detail = new BudgetTahunanUnitPeriode;
                $budget_tahunan_unit_detail->budget_tahunan_unit_id = $budget_tahunan_unit->id;
                $budget_tahunan_unit_detail->created_by = $user->id;
                $budget_tahunan_unit_detail->januari = $request->januari_[$key];
                $budget_tahunan_unit_detail->februari = $request->februari_[$key];
                $budget_tahunan_unit_detail->maret = $request->maret_[$key];
                $budget_tahunan_unit_detail->april = $request->april_[$key];
                $budget_tahunan_unit_detail->mei = $request->mei_[$key];
                $budget_tahunan_unit_detail->juni = $request->juni_[$key];
                $budget_tahunan_unit_detail->juli = $request->juli_[$key];
                $budget_tahunan_unit_detail->agustus = $request->agustus_[$key];
                $budget_tahunan_unit_detail->september = $request->september_[$key];
                $budget_tahunan_unit_detail->oktober = $request->oktober_[$key];
                $budget_tahunan_unit_detail->november = $request->november_[$key];
                $budget_tahunan_unit_detail->desember = $request->desember_[$key];
                $budget_tahunan_unit_detail->save();
            }
        }
        
        if ( $budget_tahunan->budget_unit->count() > 0 ){
            foreach ($request->item_id_ as $key => $value) {  
                 
                $budget_tahunan_detail = BudgetTahunanDetail::find($request->item_id_[$key]);
                $budget_tahunan_detail->volume = str_replace(",", "", $request->volume_[$key]);
                $budget_tahunan_detail->nilai = $budget_tahunan->budget_unit->avg("harga_satuan");
                $budget_tahunan_detail->save();
            } 
        }
        return redirect("budget/cashflow/detail-cashflow/?id=".$budget_tahunan_detail->budget_tahunan_id);
    }


    public function viewcf(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $budget_tahunan = BudgetTahunan::find($request->id);
        return view("budget::item_cf",compact("user","project","budget_tahunan"));
    }

    public function referensicf(Request $request){
        $itempekerjaan = Itempekerjaan::find($request->id);
        $harga = $itempekerjaan->harga;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $budget_tahunan = BudgetTahunan::find($request->budget_tahunan_id);
        return view("budget::item_referensi_cf",compact("user","project","itempekerjaan","harga","budget_tahunan"));
    }

    public function revitemcashflowcons(Request $request){
        $budget_tahunan = BudgetTahunan::find($request->budget);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $volume_master = 0;
        foreach ($budget_tahunan->budget->details as $key => $value) {
            if ( $value->itempekerjaan->group_cost == 2 ){
                $volume_master = $volume_master + $value->volume;
            }
        }

        return view("budget::item_tahunan_concost",compact("user","project","budget_tahunan","volume_master"));
    }

    public function addcarryover(Request $request){
        $array_spk_co = array();
        $budget_tahunan = BudgetTahunan::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $start = 0;

        if ( $budget_tahunan->budget->kawasan == null ){
            $asset_id = $project->id;
        }else{
            $asset_id = $budget_tahunan->budget->kawasan->id; 
        }

        $spk = $budget_tahunan->budget->project->spks;
        foreach ($spk as $key => $value) {

            if ( $value->itempekerjaan != "" ){
                //if ( $value->itempekerjaan->group_cost == 1 ){
                    if ( $value->details != "" ){
                        foreach ($value->details as $key2 => $value2) {
                            if ( $value2->asset != "" ){
                                if ( $value2->asset->id == $asset_id ){
                                    if ( $value->baps != "" ){
                                        $bayar = ( $value->terbayar_verified / 1.1 );
                                    }else{
                                        $bayar = 0;
                                    }

                                    $sisa = ( $value->nilai + $value->nilai_vo) - $bayar;
                                    if ( $sisa > 0 ){
                                        $array_spk_co[$start] = array(
                                            "no_spk" => $value->no,
                                            "id_spk" => $value->id,
                                            "coa" => $value->itempekerjaan->code,
                                            "nama_pekerjaan" => $value->itempekerjaan->name,
                                            "nilai_spk" => $value->nilai + $value->nilai_vo,
                                            "terbayar" => $bayar,
                                            "sisa" => $value->nilai - $bayar,
                                            "nama_spk" => $value->name
                                        );
                                        $start++;
                                    }                            
                                }
                            }
                            
                        }
                    }
                //}            
            }
        }

        return view("budget::item_co",compact("user","project","budget_tahunan","array_spk_co"));
    }

    public function savecashouttype(Request $request){

        $budget_tahunan_periode = BudgetTahunanUnitPeriode::find($request->budget_unit_id);
        $array_bulanan = array(
            'januari' => 1,
            'februari' => 2,
            'maret' => 3,
            'april' => 4,
            'mei' => 5,
            'juni' => 6,
            'juli' => 7,
            'agustus' => 8,
            'september' => 9,
            'oktober' => 10,
            'november' => 11,
            'desember' => 12
        );

        $budget_tahunan_unit_periode_detail = new BudgetTahunanUnitPeriodeDetail;
        $budget_tahunan_unit_periode_detail->budget_tahunan_periode = $request->budget_unit_id;
        $budget_tahunan_unit_periode_detail->month = $array_bulanan[$request->budget_unit_bulan];
        $budget_tahunan_unit_periode_detail->januari = $request->januari_unit;
        $budget_tahunan_unit_periode_detail->februari = $request->februari_unit;
        $budget_tahunan_unit_periode_detail->maret = $request->maret_unit;
        $budget_tahunan_unit_periode_detail->april = $request->april_unit;
        $budget_tahunan_unit_periode_detail->mei = $request->mei_unit;
        $budget_tahunan_unit_periode_detail->juni = $request->juni_unit;
        $budget_tahunan_unit_periode_detail->juli = $request->juli_unit;
        $budget_tahunan_unit_periode_detail->agustus = $request->agustus_unit;
        $budget_tahunan_unit_periode_detail->september = $request->september_unit;
        $budget_tahunan_unit_periode_detail->oktober = $request->oktober_unit;
        $budget_tahunan_unit_periode_detail->november = $request->november_unit;
        $budget_tahunan_unit_periode_detail->desember = $request->desember_unit;
        $budget_tahunan_unit_periode_detail->save();

        return redirect("/budget/cashflow/detail-cashflow?id=".$budget_tahunan_periode->budget_unit->budget_tahunan->id);
    }

    public function itemviewconcost(Request $request){
        $budget_unit = BudgetTahunanUnitPeriode::find($request->id);
        $data['status'] = 1;
        $data['total'] = 0;
        $array_bulan = array(
            'januari' => 1,
            'februari' => 2, 
            'maret' => 3,
            'april' => 4,
            'mei' => 5,
            'juni' => 6,
            'juli' => 7,
            'agustus' => 8,
            'september' => 9,
            'oktober' => 10,
            'november' => 11,
            'desember' => 12
        );


        $array_cashout = array(
            'januari' => 0,
            'februari' => 0,
            'maret' => 0,
            'april' => 0,
            'mei' => 0,
            'juni' => 0,
            'juli' => 0,
            'agustus' => 0,
            'september' => 0,
            'oktober' => 0,
            'november' => 0,
            'desember' => 0
        );

        foreach ($budget_unit->details as $key => $value) {
            if ( $value->month == $array_bulan[$request->bulan] ){
                $array_cashout = array(
                    'januari' => $value->januari,
                    'februari' => $value->februari,
                    'maret' => $value->maret,
                    'april' => $value->april,
                    'mei' => $value->mei,
                    'juni' => $value->juni,
                    'juli' => $value->juli,
                    'agustus' => $value->agustus,
                    'september' => $value->september,
                    'oktober' => $value->oktober,
                    'november' => $value->november,
                    'desember' => $value->desember
                );
                $data['status'] = "0";
                $data['array_cashout'] = $array_cashout;
                $data['total'] = $value->januari + $value->februari + $value->maret + $value->april + $value->mei + $value->juni + $value->juli + $value->agustus + $value->september + $value->oktober + $value->november + $value->desember ;
             }
        }

        echo json_encode($data);
    }

    public function removeco(Request $request ){
        $budget_carry_over = BudgetCarryOver::find($request->id);
        $status = $budget_carry_over->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function removecoco(Request $request){
        $budget_carry_over = BudgetCarryOverCashflow::find($request->id);
        $status = $budget_carry_over->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }
}

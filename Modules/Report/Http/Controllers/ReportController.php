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
use Modules\Budget\Entities\BudgetTahunanPeriode;
use Modules\Spk\Entities\Spk;

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

        $total_kontrak = 0;
        

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

        $arrayBulananCashOut = array(
            "januari" => 0,
            "februari" => 0,
            "maret" => 0,
            "april" => 0,
            "mei" => 0,
            "juni" => 0,
            "juli" => 0,
            "agustus" => 0,
            "september" => 0,
            "oktober" => 0,
            "november" => 0,
            "desember" => 0
        );

        $arrayCarryOverCashOut = array(
            "januari" => 0,
            "februari" => 0,
            "maret" => 0,
            "april" => 0,
            "mei" => 0,
            "juni" => 0,
            "juli" => 0,
            "agustus" => 0,
            "september" => 0,
            "oktober" => 0,
            "november" => 0,
            "desember" => 0
        );

        $arrayRealisasi = array(
            "januari" => 0,
            "februari" => 0,
            "maret" => 0,
            "april" => 0,
            "mei" => 0,
            "juni" => 0,
            "juli" => 0,
            "agustus" => 0,
            "september" => 0,
            "oktober" => 0,
            "november" => 0,
            "desember" => 0
        );

        foreach ($project->budget_tahunans as $key => $value) {
            if ( $value->tahun_anggaran == $list){
                //Budget SPK 
                foreach ($value->details as $key2 => $value2) {
                    $budget_cf = BudgetTahunanPeriode::where("budget_id",$value->id)->where("itempekerjaan_id",$value2->itempekerjaans->id)->get();
                    if ( count($budget_cf) > 0 ){
                        $spk = $value2->volume * $value2->nilai;
                        foreach ($budget_cf as $key3 => $value3) {

                            $arrayBulananCashOut["januari"] =  $arrayBulananCashOut["januari"] + (($value3->januari/100) * $spk);
                            $arrayBulananCashOut["februari"] = $arrayBulananCashOut["februari"] + (($value3->februari/100) * $spk);
                            $arrayBulananCashOut["maret"] = $arrayBulananCashOut["maret"] + (($value3->maret/100) * $spk);
                            $arrayBulananCashOut["april"] = $arrayBulananCashOut["april"] + (($value3->april/100) * $spk);
                            $arrayBulananCashOut["mei"] = $arrayBulananCashOut["mei"] + (($value3->mei/100) * $spk);
                            $arrayBulananCashOut["juni"] = $arrayBulananCashOut["juni"] + (($value3->juni/100) * $spk);
                            $arrayBulananCashOut["juli"] = $arrayBulananCashOut["juli"] + (($value3->juli/100) * $spk);
                            $arrayBulananCashOut["agustus"] = $arrayBulananCashOut["agustus"] + (($value3->agustus/100) * $spk);
                            $arrayBulananCashOut["september"] = $arrayBulananCashOut["september"] + (($value3->september/100) * $spk);
                            $arrayBulananCashOut["oktober"] = $arrayBulananCashOut["oktober"] + (($value3->oktober/100) * $spk);
                            $arrayBulananCashOut["november"] = $arrayBulananCashOut["november"] + (($value3->november/100) * $spk);
                            $arrayBulananCashOut["desember"] = $arrayBulananCashOut["desember"] + (($value3->desember/100) * $spk);
                        }
                    }
                }

                //Budget Carry Over 
                foreach ($value->carry_over as $key3 => $value3) {
                    $sisa = $value3->spk->nilai - $value3->spk->terbayar_verified;
                    foreach ($value3->cash_flows as $key4 => $value4) {
                        $arrayCarryOverCashOut["januari"] =  $arrayCarryOverCashOut["januari"] + (($value4->januari/100) * $sisa);
                        $arrayCarryOverCashOut["februari"] = $arrayCarryOverCashOut["februari"] + (($value4->februari/100) * $sisa);
                        $arrayCarryOverCashOut["maret"] = $arrayCarryOverCashOut["maret"] + (($value4->maret/100) * $sisa);
                        $arrayCarryOverCashOut["april"] = $arrayCarryOverCashOut["april"] + (($value4->april/100) * $sisa);
                        $arrayCarryOverCashOut["mei"] = $arrayCarryOverCashOut["mei"] + (($value4->mei/100) * $sisa);
                        $arrayCarryOverCashOut["juni"] = $arrayCarryOverCashOut["juni"] + (($value4->juni/100) * $sisa);
                        $arrayCarryOverCashOut["juli"] = $arrayCarryOverCashOut["juli"] + (($value4->juli/100) * $sisa);
                        $arrayCarryOverCashOut["agustus"] = $arrayCarryOverCashOut["agustus"] + (($value4->agustus/100) * $sisa);
                        $arrayCarryOverCashOut["september"] = $arrayCarryOverCashOut["september"] + (($value4->september/100) * $sisa);
                        $arrayCarryOverCashOut["oktober"] = $arrayCarryOverCashOut["oktober"] + (($value4->oktober/100) * $sisa);
                        $arrayCarryOverCashOut["november"] = $arrayCarryOverCashOut["november"] + (($value4->november/100) * $sisa);
                        $arrayCarryOverCashOut["desember"] = $arrayCarryOverCashOut["desember"] + (($value4->desember/100) * $sisa);
                    }
                }
            }
        }

        foreach ($project->voucher as $key => $value) {
            if ( $value->pencairan_date != NULL ){
                $month = $value->pencairan_date->format("M");
            }

            if ( $month == "01"){
                $arrayRealisasi["januari"] = $arrayRealisasi["januari"] + $value->nilai;
            }elseif( $month == "02"){
                $arrayRealisasi["februari"] = $arrayRealisasi["februari"] + $value->nilai;
            }elseif( $month == "03"){
                $arrayRealisasi["maret"] = $arrayRealisasi["maret"] + $value->nilai;
            }elseif( $month == "04"){
                $arrayRealisasi["april"] = $arrayRealisasi["april"] + $value->nilai;
            }elseif( $month == "05"){
                $arrayRealisasi["mei"] = $arrayRealisasi["mei"] + $value->nilai;
            }elseif( $month == "06"){
                $arrayRealisasi["juni"] = $arrayRealisasi["juni"] + $value->nilai;
            }elseif( $month == "07"){
                $arrayRealisasi["juli"] = $arrayRealisasi["juli"] + $value->nilai;
            }elseif( $month == "08"){
                $arrayRealisasi["agustus"] = $arrayRealisasi["agustus"] + $value->nilai;
            }elseif( $month == "09"){
                $arrayRealisasi["september"] = $arrayRealisasi["september"] + $value->nilai;
            }elseif( $month == "10"){
                $arrayRealisasi["oktober"] = $arrayRealisasi["oktober"] + $value->nilai;
            }elseif( $month == "11"){
                $arrayRealisasi["november"] = $arrayRealisasi["november"] + $value->nilai;
            }elseif( $month == "12"){
                $arrayRealisasi["desember"] = $arrayRealisasi["desember"] + $value->nilai;
            }
        }
        $variabel_cash_out = "";
        $nilai_cash_out = 0;
        foreach ($arrayBulananCashOut as $key => $value) {
            $variabel_cash_out .= $value.",";
            $nilai_cash_out = $nilai_cash_out + $value;
        }
        $variabel_cash_out = trim($variabel_cash_out,",");

        $variabel_carry_over = "";
        $nilai_carry_over= 0;
        foreach ($arrayCarryOverCashOut as $key => $value) {
            $variabel_carry_over .= $value.",";
            $nilai_carry_over = $nilai_carry_over + $value;
        }
        $variabel_carry_over = trim($variabel_carry_over,",");

        $variabel_realiasasi = "";
        foreach ($arrayRealisasi as $key => $value) {
            $variabel_realiasasi .= $value.",";
        }
        $variabel_realiasasi = trim($variabel_realiasasi,",");

        return view('report::show',compact("project","user","tahun","list","variabel_cash_out","variabel_carry_over","variabel_realiasasi","nilai_cash_out","nilai_carry_over"));
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

    public function cashflow(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();
        return view("report::report.report_budget_tahunan",compact("user","project"));
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
        $spk = $budget_tahunan->budget->project->spks;
        foreach ($spk as $key => $value) {
            if ( $value->date->format("Y") <= date("Y")){
                if ( $value->itempekerjaan->group_cost == 1 ){
                    if ( $value->details != "" ){
                        foreach ($value->details as $key2 => $value2) {
                            if ( $value2->asset->id == $asset_id ){
                                if ( $value->baps != "" ){
                                    $bayar = $value->baps->sum("nilai_bap_2");
                                }else{
                                    $bayar = 0;
                                }

                                $sisa = $value->nilai - $bayar;
                                if ( $sisa > 0 ){
                                    $nilai_sisa_dev_cost = $sisa + $nilai_sisa_dev_cost;  
                                }                         
                            }
                        }
                    }
                }else{
                    if ( $value->tender->rab != "" ){
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
                    }
                }   
            }                        
        }

        return view("report::report.detail_cashflow",compact("budget_tahunan","user","budget","start_date","end_date","array_cashflow","project","carry_over","array_carryover","nilai_sisa_dev_cost","nilai_sisa_con_cost"));
    }

    public function approvalcashflow(Request $request){
        $budget_tahunan = BudgetTahunan::find($request->id);
        $project = $budget_tahunan->budget->project;
        $user = \Auth::user();
        return view("report::report.approval_cashflow",compact("user","project","budget_tahunan"));
    }

    public function costreport(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();

        $cost_report = $project->cost_report;
        $array_costreport = array();

        foreach ($cost_report as $key => $value) {
            $spk = Spk::find($value->spk_id);
            if ( $value->project_kawasan_id == 0 ){
                $kawasan = "Proyek";
            }else{
                $kawasan = $value->kawasan->name;
            }

            $code = explode(".",$value->itempekerjaan_name->code);
            if ( count($code) > 2 ){
                $coa = $code[0];
            }else{
                $coa = $value->itempekerjaan_name->code;
            }

            if ( !(isset($array_costreport[$value->project_kawasan_id] ))) {
                $array_costreport[$value->project_kawasan_id] = array(
                    "kawasan_id" => $value->project_kawasan_id,
                    "kawasan" => $kawasan,
                    "itempekerjaan" => array()
                );

                $array_coa = array(
                    "name" => $value->itempekerjaan_name->name,
                    "code" => $coa,
                    $coa => "",
                    "total_rab" => 0,
                    "total_kontrak" => 0,
                    "total_vo" => 0,
                    "total_spk" => 0,
                    "rata_progress" => 0,
                    "rata_diakui" => 0,
                    "total_terbayar" => 0,
                    "total_saldo_budget" => 0,
                    "total_saldo_terbayar" => 0
                );
                array_push( $array_costreport[$value->project_kawasan_id]["itempekerjaan"], $array_coa);

            }else{
                if ( !(isset($array_costreport[$value->project_kawasan_id]["itempekerjaan"][$coa]))) {
                    $array_coa = array(
                        "name" => $value->itempekerjaan_name->name,
                        "code" => $coa,
                        $coa => "",
                        "total_rab" => 0,
                        "total_kontrak" => 0,
                        "total_vo" => 0,
                        "total_spk" => 0,
                        "rata_progress" => 0,
                        "rata_diakui" => 0,
                        "total_terbayar" => 0,
                        "total_saldo_budget" => 0,
                        "total_saldo_terbayar" => 0
                    );

                    array_push( $array_costreport[$value->project_kawasan_id]["itempekerjaan"], $array_coa);
                }

            }

            if ( $spk->st_1 != "" ){
                $st_1 = $spk->st_1;
            }else{
                $st_1 = "";
            }         

            if ( $spk->st_2 != "" ){
                $st_2 = $spk->st_2;
            }else{
                $st_2 = "";
            } 

            $array_spk[$key] = array(
                "project_id" => $value->project_id,
                "project_kawasan_id" => $kawasan,
                "spk_no" => $spk->no,
                "itempekerjaan" => $value->itempekerjaan,
                "code" => $coa,
                "date" => $spk->date->format("d/M/Y"),
                "acuan" => $spk->tender->no,
                "pekerjaan" => $spk->itempekerjaan->name,
                "rekanan" => $spk->rekanan->group->name,
                "st_1" => $st_1,
                "st_2" => $st_2,
                "rab" => $spk->tender->rab->nilai,
                "nilai" => $spk->nilai,
                "nilai_vo" => $spk->nilai_vo,
                "total" => $spk->nilai + $spk->nilai_vo,
                "lapangan" => $spk->lapangan,
                "diakui" => $spk->spk_real_termyn,
                "terbayar" => $spk->terbayar_verified,
                "saldo" => $spk->tender->rab->nilai - ( $spk->nilai + $spk->nilai_vo),
                "sisa" => ($spk->nilai + $spk->nilai_vo) - $spk->terbayar_verified
            );
        }

        $nilai_rab = 0;
        $nilai_kontrak = 0;
        $nilai_vo = 0;
        $nilai_spk = 0;
        $nilai_progress = 0;
        $nilai_diakui = 0;
        $nilai_dibayar = 0;
        $nilai_saldo_budget = 0;
        $nilai_saldo_sisa = 0; 

        foreach ($array_costreport as $key => $value) {
            foreach ($value["itempekerjaan"] as $key2 => $value2) {
                $start = 0;
                $nilai_rab = 0;
                $nilai_kontrak = 0;
                $nilai_vo = 0;
                $nilai_spk = 0;
                $nilai_progress = 0;
                $nilai_diakui = 0;
                $nilai_dibayar = 0;
                $nilai_saldo_budget = 0;
                $nilai_saldo_sisa = 0; 
                foreach ($array_spk as $key3 => $value3) {
                    if ( $value3["project_kawasan_id"] == $value["kawasan"] ){
                        if ( $value3["code"] == $value2["code"] ){    
                            $start = $start + 1;                    
                            $nilai_rab = $nilai_rab + $value3['rab'];
                            $nilai_kontrak = $nilai_kontrak + $value3['nilai'];
                            $nilai_vo = $nilai_vo + $value3['nilai_vo'];
                            $nilai_spk = $nilai_spk + $value3['total'];
                            $nilai_dibayar = $nilai_dibayar + $value3['terbayar'];
                            $nilai_saldo_budget = $nilai_saldo_budget + $value3['saldo'];
                            $nilai_saldo_sisa = $nilai_saldo_sisa + $value3['sisa'];
                            $nilai_progress = $nilai_progress + $value3['lapangan'];
                            $nilai_diakui = $nilai_diakui + $value3['diakui'];
                        }
                    }
                }
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_rab"] = $nilai_rab;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_kontrak"] = $nilai_kontrak;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_vo"] = $nilai_vo;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_spk"] = $nilai_spk;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["rata_progress"] = $nilai_progress / $start;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["rata_diakui"] = $nilai_diakui / $start;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_terbayar"] = $nilai_dibayar;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_saldo_budget"] = $nilai_saldo_budget;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_saldo_terbayar"] = $nilai_saldo_sisa;
            } 
        }
        return view("report::report.report_cost_report",compact("user","project","budget_tahunan","array_costreport","array_spk"));
    }

    public function kontraktor(Request $request){

    }

    public function reportkawasan(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();

        $cost_report = $project->cost_report;
        $array_costreport = array();

        foreach ($cost_report as $key => $value) {
            $spk = Spk::find($value->spk_id);
            if ( $value->project_kawasan_id == 0 ){
                $kawasan = "Proyek";
            }else{
                $kawasan = $value->kawasan->name;
            }

            $code = explode(".",$value->itempekerjaan_name->code);
            if ( count($code) > 2 ){
                $coa = $code[0];
            }else{
                $coa = $value->itempekerjaan_name->code;
            }

            if ( !(isset($array_costreport[$value->project_kawasan_id] ))) {
                $array_costreport[$value->project_kawasan_id] = array(
                    "kawasan_id" => $value->project_kawasan_id,
                    "kawasan" => $kawasan,
                    "itempekerjaan" => array()
                );

                $array_coa = array(
                    "name" => $value->itempekerjaan_name->name,
                    "code" => $coa,
                    $coa => "",
                    "total_rab" => 0,
                    "total_kontrak" => 0,
                    "total_vo" => 0,
                    "total_spk" => 0,
                    "rata_progress" => 0,
                    "rata_diakui" => 0,
                    "total_terbayar" => 0,
                    "total_saldo_budget" => 0,
                    "total_saldo_terbayar" => 0
                );
                array_push( $array_costreport[$value->project_kawasan_id]["itempekerjaan"], $array_coa);

            }else{
                if ( !(isset($array_costreport[$value->project_kawasan_id]["itempekerjaan"][$coa]))) {
                    $array_coa = array(
                        "name" => $value->itempekerjaan_name->name,
                        "code" => $coa,
                        $coa => "",
                        "total_rab" => 0,
                        "total_kontrak" => 0,
                        "total_vo" => 0,
                        "total_spk" => 0,
                        "rata_progress" => 0,
                        "rata_diakui" => 0,
                        "total_terbayar" => 0,
                        "total_saldo_budget" => 0,
                        "total_saldo_terbayar" => 0
                    );

                    array_push( $array_costreport[$value->project_kawasan_id]["itempekerjaan"], $array_coa);
                }

            }

            if ( $spk->st_1 != "" ){
                $st_1 = $spk->st_1;
            }else{
                $st_1 = "";
            }         

            if ( $spk->st_2 != "" ){
                $st_2 = $spk->st_2;
            }else{
                $st_2 = "";
            } 

            $array_spk[$key] = array(
                "project_id" => $value->project_id,
                "project_kawasan_id" => $kawasan,
                "spk_no" => $spk->no,
                "itempekerjaan" => $value->itempekerjaan,
                "code" => $coa,
                "date" => $spk->date->format("d/M/Y"),
                "acuan" => $spk->tender->no,
                "pekerjaan" => $spk->itempekerjaan->name,
                "rekanan" => $spk->rekanan->group->name,
                "st_1" => $st_1,
                "st_2" => $st_2,
                "rab" => $spk->tender->rab->nilai,
                "nilai" => $spk->nilai,
                "nilai_vo" => $spk->nilai_vo,
                "total" => $spk->nilai + $spk->nilai_vo,
                "lapangan" => $spk->lapangan,
                "diakui" => $spk->spk_real_termyn,
                "terbayar" => $spk->terbayar_verified,
                "saldo" => $spk->tender->rab->nilai - ( $spk->nilai + $spk->nilai_vo),
                "sisa" => ($spk->nilai + $spk->nilai_vo) - $spk->terbayar_verified,
                "termyn" => $spk->termyn->count() - 1
            );
        }

        $nilai_rab = 0;
        $nilai_kontrak = 0;
        $nilai_vo = 0;
        $nilai_spk = 0;
        $nilai_progress = 0;
        $nilai_diakui = 0;
        $nilai_dibayar = 0;
        $nilai_saldo_budget = 0;
        $nilai_saldo_sisa = 0; 

        foreach ($array_costreport as $key => $value) {
            foreach ($value["itempekerjaan"] as $key2 => $value2) {
                $start = 0;
                $nilai_rab = 0;
                $nilai_kontrak = 0;
                $nilai_vo = 0;
                $nilai_spk = 0;
                $nilai_progress = 0;
                $nilai_diakui = 0;
                $nilai_dibayar = 0;
                $nilai_saldo_budget = 0;
                $nilai_saldo_sisa = 0; 
                foreach ($array_spk as $key3 => $value3) {
                    if ( $value3["project_kawasan_id"] == $value["kawasan"] ){
                        if ( $value3["code"] == $value2["code"] ){    
                            $start = $start + 1;                    
                            $nilai_rab = $nilai_rab + $value3['rab'];
                            $nilai_kontrak = $nilai_kontrak + $value3['nilai'];
                            $nilai_vo = $nilai_vo + $value3['nilai_vo'];
                            $nilai_spk = $nilai_spk + $value3['total'];
                            $nilai_dibayar = $nilai_dibayar + $value3['terbayar'];
                            $nilai_saldo_budget = $nilai_saldo_budget + $value3['saldo'];
                            $nilai_saldo_sisa = $nilai_saldo_sisa + $value3['sisa'];
                            $nilai_progress = $nilai_progress + $value3['lapangan'];
                            $nilai_diakui = $nilai_diakui + $value3['diakui'];
                        }
                    }
                }
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_rab"] = $nilai_rab;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_kontrak"] = $nilai_kontrak;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_vo"] = $nilai_vo;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_spk"] = $nilai_spk;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["rata_progress"] = $nilai_progress / $start;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["rata_diakui"] = $nilai_diakui / $start;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_terbayar"] = $nilai_dibayar;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_saldo_budget"] = $nilai_saldo_budget;
                $array_costreport[$value['kawasan_id']]["itempekerjaan"][$key2]["total_saldo_terbayar"] = $nilai_saldo_sisa;
            } 
        }

        return view("report::report.report_kawasan",compact("user","project","array_spk","array_costreport"));
    }

    public function reportpekerjaan(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();
        $cost_report = $project->cost_report;
        $array_pekerjaan = array();

        foreach ($cost_report as $key => $value) {
            $spk = Spk::find($value->spk_id);
            $code = explode(".",$value->itempekerjaan_name->code);
            if ( count($code) > 2 ){
                $coa = $code[0];
            }else{
                $coa = $value->itempekerjaan_name->code;
            }

            if ( $value->project_kawasan_id == 0 ){
                $kawasan = "Proyek";
            }else{
                $kawasan = $value->kawasan->name;
            }

            if ( !(isset($array_pekerjaan[$coa]))){
                $array_pekerjaan[$coa] = array(
                    "name" => $value->itempekerjaan_name->name,
                    "kawasan" => array(),
                    "total_kontrak" => 0,
                    "total_vo" => 0,
                    "total_spk" => 0,
                    "code" => $coa
                );
            }

            if ( !(isset($array_pekerjaan[$coa]["kawasan"][$value->project_kawasan_id]))){
                if ( $value->project_kawasan_id == 0 ){
                    $array_kawasan = array("name" => "Proyek");
                }else{
                    $array_kawasan = array("name" => $value->kawasan->name);
                }
                array_push( $array_pekerjaan[$coa]["kawasan"], $array_kawasan);
            }

            if ( $spk->st_1 != "" ){
                $st_1 = $spk->st_1;
            }else{
                $st_1 = "";
            }         

            if ( $spk->st_2 != "" ){
                $st_2 = $spk->st_2;
            }else{
                $st_2 = "";
            }

            $array_spk[$key] = array(
                "project_id" => $value->project_id,
                "project_kawasan_id" => $kawasan,
                "spk_no" => $spk->no,
                "itempekerjaan" => $value->itempekerjaan,
                "code" => $coa,
                "date" => $spk->date->format("d/M/Y"),
                "acuan" => $spk->tender->no,
                "pekerjaan" => $spk->itempekerjaan->name,
                "rekanan" => $spk->rekanan->group->name,
                "st_1" => $st_1,
                "st_2" => $st_2,
                "rab" => $spk->tender->rab->nilai,
                "nilai" => $spk->nilai,
                "nilai_vo" => $spk->nilai_vo,
                "total" => $spk->nilai + $spk->nilai_vo,
                "lapangan" => $spk->lapangan,
                "diakui" => $spk->spk_real_termyn,
                "terbayar" => $spk->terbayar_verified,
                "saldo" => $spk->tender->rab->nilai - ( $spk->nilai + $spk->nilai_vo),
                "sisa" => ($spk->nilai + $spk->nilai_vo) - $spk->terbayar_verified,
                "termyn" => $spk->termyn->count()
            );
        }


        return view("report::report.report_pekerjaan",compact("user","project","array_pekerjaan","array_spk"));
    }

    public function searchkawasan(Request $request){
        echo "asdas";
    }
}

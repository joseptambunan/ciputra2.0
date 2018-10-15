<?php 

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\User;

use App\Project;

use App\Budget;

use App\ApprovalHistory;

use App\Workorder;

use App\Itempekerjaan;

use App\WorkorderBudgetDetail;

use App\Tender;

use App\Approval;

use App\Spk;

use App\Vo;

use App\ProjectKawasan;

use App\Blok;

use App\Templatepekerjaan;

use App\BudgetTahunan;

use App\BudgetTahunanTemplate;

use App\BudgetTahunanDetailtemplate;

use App\Rab;

use App\Department;

use App\TenderKorespondensi;

use App\TenderMenang;

use App\RekananGroup;

use Illuminate\Support\Facades\DB;



class UserReportController extends Controller

{

	public function __construct()

    {

        $this->middleware('auth');

    }	



    public function index(){

        $project = Project::get();

    	return view("project.report.index",compact("project"));

    }



    public function document(Request $request){

        $project = Project::find($request->id);

        return view("project.report.document",compact("project"));

    }



    public function reportHppDevcostSummary(Request $request){

        $project = Project::find($request->id);

        $nilai_total = array();

        $nilai_total['efisiensi'] = 0;

        $nilai_total['total_luas_netto'] = 0;

        $nilai_total['total_luas_brutto'] = 0;

        $nilai_total['total_budget_dev_Cost']= 0;

        $nilai_total['total_hpp_netto'] = 0;

        $nilai_total['total_hpp_bruto'] = 0;

        $nilai_total['total_terbayar'] = 0;

        $nilai_total['total_hpp_realisasi_netto'] = 0;

        $nilai_total['total_hpp_realisasi_bruto'] = 0;

        $nilai_total['total_kontrak'] = 0;

        $nilai_total['total_hpp_kontrak_netto'] = 0;

        $nilai_total['total_hpp_kontrak_bruto'] = 0;

        $nilai_total['kawasan_terbayar'] = 0;



        foreach ( $project->kawasans as $key => $value )  {

            foreach ( $value->HppDevCostReportSummary as $key2 => $value2 ){

                $nilai_total['total_luas_netto'] = $nilai_total['total_luas_netto'] + $value->lahan_sellable;

                $nilai_total['total_budget_dev_Cost'] = $nilai_total['total_budget_dev_Cost'] + $value2->total_budget;

                $nilai_total['total_kontrak'] = $nilai_total['total_kontrak'] + $value2->total_kontrak;

                $nilai_total['total_terbayar'] = $nilai_total['total_terbayar'] + $value2->total_kontrak_terbayar;

            }

        }

        if ( $nilai_total['total_budget_dev_Cost'] != "0"){

            $nilai_total['total_hpp_netto'] = $nilai_total['total_budget_dev_Cost'] / $nilai_total['total_luas_netto'] ;

            $nilai_total['total_hpp_bruto'] = $nilai_total['total_budget_dev_Cost'] / $project->luas;

        }



        if ( $nilai_total['total_kontrak'] != "0" ){

            $nilai_total['total_hpp_kontrak_netto'] = $nilai_total['total_kontrak'] / $nilai_total['total_luas_netto'] ;

            $nilai_total['total_hpp_kontrak_bruto'] = $nilai_total['total_kontrak'] / $project->luas;

        }



        if ( $nilai_total['total_terbayar'] != "0" ){

            $nilai_total['total_hpp_realisasi_netto'] = $nilai_total['total_terbayar'] / $nilai_total['total_luas_netto'] ;

            $nilai_total['total_hpp_realisasi_bruto'] = $nilai_total['total_terbayar'] / $project->luas;

        }

        

        $nilai_total['efisiensi'] = $nilai_total['total_luas_netto'] / $project->luas;



        return view("project.report.report_hpp_summary",compact("project","nilai_total"));

    }



    public function reportHppDevcostDetail(Request $request){

        $project = Project::find($request->id);

        $Itempekerjaan = Itempekerjaan::where("group_cost",1)->where("parent_id",null)->get();

        return view("project.report.report_hpp_detail",compact("project","Itempekerjaan"));

    }



    public function reportHppConcostSummary(Request $request){



    }



    public function reportKontrakKontraktor(Request $request){

        $project = Project::find($request->id);

        $rekanan = $project->rekanan;

        $itempekerjaan = Itempekerjaan::where("parent_id",null)->get();

        $department = $project->pt_user;

        return view("project.report.kontrakkontraktor",compact("project","rekanan","itempekerjaan","department"));

    }



    public function reportCostReport(Request $request){

        $project = Project::find($request->id);

        return view("project.report.report_cost_report",compact("project"));

    }



    public function reportKontrakProyek(Request $request){

        $project = Project::find($request->id);

        $rekanan = $project->rekanan;

        $itempekerjaan = Itempekerjaan::where("parent_id",null)->get();

        $department = $project->pt_user;

        return view("project.report.report_kontrak_proyek",compact("project","rekanan","itempekerjaan","department"));

    }



    public function reportKontrakPekerjaan(Request $request){

        $project = Project::find($request->id);

        $kawasans = $project->kawasans;

        $itempekerjaan = Itempekerjaan::where("parent_id",null)->get();

        return view("project.report.report_kontrak_pekerjaan",compact("project","kawasans","itempekerjaan"));

    }



    public function search_kontraktor(Request $request){

        $project = Project::find($request->project);

        $nama_rekanan = $request->nama_rekanan;

        $coa_pekerjaan = $request->coa_pekerjaan;

        $other_parameter = $request->other_parameter;

        $parameter_from = $request->parameter_from;

        $parameter_to = $request->parameter_to;

        $department = $request->department;

        $rekanan = $request->rekanan;



        if ( $parameter_from == ""){

            $parameter_from = "0";

        }



        if ( $parameter_to == "" ){

            $parameter_to = "0";

        }



        $spks = $project->spks;

        $dept_clause = "";

        if ( isset($department)){

            foreach ($department as $key1 => $value1) {

                $dept_clause .= $value1.",";

            }

            $dept_clause = "department in (".trim($dept_clause,",").") AND ";

        }

        



        $coa_clause = "";

        if ( isset($coa_pekerjaan)  ){

            foreach ($coa_pekerjaan as $key2 => $value2) {

                $coa_clause .= $value2.",";

            }

            $coa_clause = "itempekerjaan in (".trim($coa_clause,",").") AND ";

        }

        

        

        $other_clause = "";

        if ( isset($other_parameter) ){            

            $other_clause = "$other_parameter BETWEEN $parameter_from AND $parameter_to AND ";

        }



        $clause = trim($dept_clause.$coa_clause.$other_clause," AND ");

        //echo $clause;



        $rekanan_clause = "";

        if ( isset($rekanan)  ){

            foreach ($rekanan as $key3 => $value3) {

                $rekanan_clause .= $value3.",";

            }

            $rekanan_clause = "rekanan in (".trim($rekanan_clause,",").") AND ";

        }



        $clause = trim($dept_clause.$coa_clause.$other_clause.$rekanan_clause," AND ");

        if ( $dept_clause == "" && $coa_clause == "" && $other_clause == "" && $rekanan_clause == "" ){

            $spk_result = "select * from cost_reports order by rekanan";

        }else{

            $spk_result = "select * from cost_reports where $clause order by rekanan";

        }

        



        $results = DB::select($spk_result);

        $arrResult = array();

        $arrRekanan = array();

        $arrHtml = array();

        $start = 0;

        $html_child = array();

        $html = "";

        foreach ($results as $key => $value) {

            $spk = Spk::find($value->spk_id);  

            $html_child[$spk->rekanan_id][$key] = "";

            $html_child[$spk->rekanan_id][$key] .= "<tr style='display:none;' class='rekanan rekanan_id_".$spk->rekanan_id."' data-attribute='".$spk->nilai."'>";

            $html_child[$spk->rekanan_id][$key] .= "<td style='background-color:white;'>".$spk->no."</td>";

            $html_child[$spk->rekanan_id][$key] .= "<td>".$spk->date->format("d/m/y")."</td>";

            $html_child[$spk->rekanan_id][$key] .= "<td>".$spk->description."</td>";

            if ( isset($spk->item_pekerjaan->name )){

                $html_child[$spk->rekanan_id][$key] .= "<td>".$spk->item_pekerjaan->name."</td>" ;

            }else{

                $html_child[$spk->rekanan_id][$key] .= "<td>&nbsp;</td>" ;

            }



            if ( isset($spk->details->first()->asset->name )){

                $html_child[$spk->rekanan_id][$key] .= "<td>".$spk->details->first()->asset->name."</td>";

            }else{

                $html_child[$spk->rekanan_id][$key] .= "<td></td>";

            }



            $html_child[$spk->rekanan_id][$key] .= "<td>".number_format($spk->nilai,2)."</td>";

            $html_child[$spk->rekanan_id][$key] .= "<td>".number_format($spk->nilai_vo,2)."</td>";

            $html_child[$spk->rekanan_id][$key] .= "<td>".number_format($spk->nilai + $spk->nilai_vo,2)."</td>";

            $html_child[$spk->rekanan_id][$key] .= "<td>".number_format($spk->nilai_progress_bap * $spk->nilai,2)."</td>";

            $html_child[$spk->rekanan_id][$key] .= "<td>".number_format($spk->nilai_ppn,2)."</td>";

            $html_child[$spk->rekanan_id][$key] .= "<td>".number_format($spk->nilai - ($spk->nilai_progress_bap * $spk->nilai ),2)."</td>" ;

            $html_child[$spk->rekanan_id][$key] .= "<td>".$spk->st_1."</td>";

            $html_child[$spk->rekanan_id][$key] .= "<td>".$spk->st_2 ."</td>";

            $html_child[$spk->rekanan_id][$key] .= "</tr>";



            if ( array_key_exists($spk->rekanan_id, $arrRekanan)){

                $arrRekanan[$spk->rekanan_id] = array(

                    "id" => $spk->rekanan_id,

                    "nilai_spk" => $spk->nilai + $arrRekanan[$spk->rekanan_id]['nilai_spk'],

                    "nilai_vo" => $spk->nilai_vo + $arrRekanan[$spk->rekanan_id]['nilai_vo'],

                    "total_kontrak" => ( $spk->nilai + $spk->nilai_vo ) + $arrRekanan[$spk->rekanan_id]['total_kontrak'],

                    "total_termyn" => ( $spk->nilai_progress_bap * ( $spk->nilai + $spk->nilai_vo )) + $arrRekanan[$spk->rekanan_id]['total_termyn'],

                    "sisa_kontrak" => ( $spk->nilai - ($spk->nilai_progress_bap * ( $spk->nilai + $spk->nilai_vo ))) + $arrRekanan[$spk->rekanan_id]['sisa_kontrak'],

                    "total_ppn" => $spk->nilai_ppn + $arrRekanan[$spk->rekanan_id]['total_ppn'],

                    "html" => $html_child[$spk->rekanan_id]

                );

            }else{

                $arrRekanan[$spk->rekanan_id] = array(

                    "id" => $spk->rekanan_id,

                    "nilai_spk" => $spk->nilai,

                    "nilai_vo" => $spk->nilai_vo,

                    "total_kontrak" => $spk->nilai + $spk->nilai_vo,

                    "total_termyn" => $spk->nilai_progress_bap * ( $spk->nilai + $spk->nilai_vo ),

                    "sisa_kontrak" => $spk->nilai - ($spk->nilai_progress_bap * ( $spk->nilai + $spk->nilai_vo )),

                    "total_ppn" => $spk->nilai_ppn,

                    "html" => $html_child[$spk->rekanan_id]

                );

            }



        }



        //print_r($arrRekanan);

        foreach ($arrRekanan as $key1 => $value1) {

            $rekanan = \App\RekananGroup::find($arrRekanan[$key1]['id']);

            $html .= "<tr>";

            $html .= "<td style='background-color:grey;color:white;font-weight:bolder;'onclick='showchild(".$arrRekanan[$key1]['id'].")' data-attribute='1' id='btn_".$arrRekanan[$key1]['id']."' >".$rekanan->name."</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>".number_format($arrRekanan[$key1]['nilai_spk'],2)."</td>";

            $html .= "<td>".number_format($arrRekanan[$key1]['nilai_vo'],2)."</td>";

            $html .= "<td>".number_format($arrRekanan[$key1]['total_kontrak'],2)."</td>";

            $html .= "<td>".number_format($arrRekanan[$key1]['total_termyn'],2)."</td>";

            $html .= "<td>".number_format($arrRekanan[$key1]['total_ppn'],2)."</td>";

            $html .= "<td>".number_format($arrRekanan[$key1]['sisa_kontrak'],2)."</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "</tr>";

            foreach ($arrRekanan[$key1]['html'] as $key3 => $value3) {

                $html .= $arrRekanan[$key1]['html'][$key3];

            }

            

        }

        return response()->json( ["html" => $html, "rekanan" => $arrRekanan] );

    }



    public function search_proyek(Request $request){

        $project = Project::find($request->project);

        $nama_rekanan = $request->nama_rekanan;

        $coa_pekerjaan = $request->coa_pekerjaan;

        $other_parameter = $request->other_parameter;

        $parameter_from = $request->parameter_from;

        $parameter_to = $request->parameter_to;

        $department = $request->department;

        $rekanan = $request->rekanan;



        if ( $parameter_from == ""){

            $parameter_from = "0";

        }



        if ( $parameter_to == "" ){

            $parameter_to = "0";

        }



        $spks = $project->spks;

        $dept_clause = "";

        if ( isset($department)){

            foreach ($department as $key1 => $value1) {

                $dept_clause .= $value1.",";

            }

            $dept_clause = "department in (".trim($dept_clause,",").") AND ";

        }

        



        $coa_clause = "";

        if ( isset($coa_pekerjaan)  ){

            foreach ($coa_pekerjaan as $key2 => $value2) {

                $coa_clause .= $value2.",";

            }

            $coa_clause = "itempekerjaan in (".trim($coa_clause,",").") AND ";

        }

        

        

        $other_clause = "";

        if ( isset($other_parameter) ){            

            $other_clause = "$other_parameter BETWEEN $parameter_from AND $parameter_to AND ";

        }



        $clause = trim($dept_clause.$coa_clause.$other_clause," AND ");

        //echo $clause;



        $rekanan_clause = "";

        if ( isset($rekanan)  ){

            foreach ($rekanan as $key3 => $value3) {

                $rekanan_clause .= $value3.",";

            }

            $rekanan_clause = "rekanan in (".trim($rekanan_clause,",").") AND ";

        }



        $clause = trim($dept_clause.$coa_clause.$other_clause.$rekanan_clause," AND ");

        if ( $dept_clause == "" && $coa_clause == "" && $other_clause == "" && $rekanan_clause == "" ){

            $spk_result = "select * from cost_reports order by rekanan";

        }else{

            $spk_result = "select * from cost_reports where $clause order by rekanan";

        }

        



        $results = DB::select($spk_result);

        $arrResult = array();

        $arrRekanan = array();

        $arrHtml = array();

        $html_child = array();

        $html = "";

        $start = 0;

        foreach ($results as $key => $value) {

            $spk = Spk::find($value->spk_id);

            foreach ($spk->details as $key2 => $value2) {

                if ( !(array_key_exists($value2->asset_id, $arrHtml) )) {

                    if ( $value2->asset_type == "App\Project"){                        

                        $arrHtml[$value2->asset_id] = array(

                            "name" => "Fasilitas Kota",

                            "asset_id" => $value2->asset_id,

                            "asset_type" => $value2->asset_type

                        );

                    }else{                        

                        $arrHtml[$value2->asset_id] = array(

                            "name" => $value2->asset->name,

                            "asset_id" => $value2->asset_id,

                            "asset_type" => $value2->asset_type

                        );

                    }

                    $arrPekerjaan[$value2->asset_id] = array();

                }



                if ( array_key_exists("nilai", $arrHtml[$value2->asset_id])){

                    $arrHtml[$value2->asset_id] = array(

                        "name" => "Fasilitas Kota",

                        "asset_id" => $value2->asset_id,

                        "nilai" => $spk->nilai + $arrHtml[$value2->asset_id]['nilai'],

                        "nilai_vo" => $spk->nilai_vo + $arrHtml[$value2->asset_id]['nilai_vo'],

                        "total_kontrak" => ( $spk->nilai_vo + $spk->nilai ) + $arrHtml[$value2->asset_id]['total_kontrak'],

                        "total_termyn" => (( $spk->nilai_vo + $spk->nilai ) * $spk->nilai_progress_bap ) + $arrHtml[$value2->asset_id]['total_termyn'],

                        "sisa_kontrak" => ( $spk->nilai - (( $spk->nilai_vo + $spk->nilai ) * $spk->nilai_progress_bap )) + $arrHtml[$value2->asset_id]['sisa_kontrak'],

                        "asset_type" => $value2->asset_type

                    );

                }else{

                    $arrHtml[$value2->asset_id] = array(

                        "name" => "Fasilitas Kota",

                        "asset_id" => $value2->asset_id,

                        "nilai" => $spk->nilai ,

                        "nilai_vo" => $spk->nilai_vo ,

                        "total_kontrak" => ( $spk->nilai_vo + $spk->nilai ),

                        "total_termyn" => (( $spk->nilai_vo + $spk->nilai ) * $spk->nilai_progress_bap ), 

                        "sisa_kontrak" => ( $spk->nilai - (( $spk->nilai_vo + $spk->nilai ) * $spk->nilai_progress_bap )),

                        "asset_type" => $value2->asset_type

                    );

                }



            }            

        }        

        



        $arrHtml = array_values(array_unique($arrHtml));

        foreach ($arrHtml as $key2 => $value2) {

            $html .= "<tr style='background-color:grey;'>";

            $html .= "<td style='background-color:grey;color:white;font-weight:bolder;width:30%;' onclick='showchild(".$arrHtml[$key2]['asset_id'].")' data-attribute='1' data-asset='".$arrHtml[$key2]['asset_type']."' id='btn_".$arrHtml[$key2]['asset_id']."'>".$arrHtml[$key2]['name']."&nbsp;&nbsp;<ion-icon name='add-circle-outline' id='add_outline_".$arrHtml[$key2]['asset_id']."' size='large'></ion-icon>&nbsp; <ion-icon name='remove-circle-outline' id='rem_outline_".$arrHtml[$key2]['asset_id']."' size='large' style='display:none;'></ion-icon></td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td style='color:white;font-weight:bolder;'>".number_format($arrHtml[$key2]['nilai'],2)."</td>";

            $html .= "<td style='color:white;font-weight:bolder;'>".number_format($arrHtml[$key2]['nilai_vo'],2)."</td>";

            $html .= "<td style='color:white;font-weight:bolder;'>".number_format($arrHtml[$key2]['total_kontrak'],2)."</td>";

            $html .= "<td style='color:white;font-weight:bolder;'>".number_format($arrHtml[$key2]['total_termyn'],2)."</td>";

            $html .= "<td style='color:white;font-weight:bolder;'>".number_format($arrHtml[$key2]['sisa_kontrak'],2)."</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "</tr>";

            $html .= "<tr>";

            $html .= "<td id='work_".$arrHtml[$key2]['asset_id']."' style='width:30%;'></td>";

            $html .= "<td id='tgl_spk_".$arrHtml[$key2]['asset_id']."' style='width:20%;'>&nbsp;</td>";

            $html .= "<td id='acuan_spk_".$arrHtml[$key2]['asset_id']."' style='width:20%;'>&nbsp;</td>";

            $html .= "<td id='pekerjaan_".$arrHtml[$key2]['asset_id']."' style='width:20%;'>&nbsp;</td>";

            $html .= "<td id='rekanan_".$arrHtml[$key2]['asset_id']."' style='width:20%;'>&nbsp;</td>";

            $html .= "<td id='nilai_".$arrHtml[$key2]['asset_id']."' >&nbsp;</td>";

            $html .= "<td id='nilai_vo_".$arrHtml[$key2]['asset_id']."'>&nbsp;</td>";

            $html .= "<td id='total_kontrak_".$arrHtml[$key2]['asset_id']."'>&nbsp;</td>";

            $html .= "<td id='total_termyn_".$arrHtml[$key2]['asset_id']."'>&nbsp;</td>";

            $html .= "<td id='sisa_kontrak_".$arrHtml[$key2]['asset_id']."'>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "<td>&nbsp;</td>";

            $html .= "</tr>";

        }





        return response()->json( ["html" => $html, "clause" => $spk_result ]);

    }



    public function search_proyek_pekerjaan(Request $request){

        $html_pekerjaan = "";

        $html_nilai_spk = "";

        $html_nilai_vo = "";

        $html_total_kontrak = "";

        $html_total_termyn = "";

        $html_sisa_kontrak = "";

        $html_tgl_spk = "";        

        $html_acuan_spk = "";

        $html_pekerjaan_spk = "";

        $html_nama_rekanan = "";

        $querys = $request->clauses;

        $asset_id = $request->id;

        $asset_type = $request->type;

        $arrPekerjaan = array();



        $results = DB::select($querys);

        foreach ($results as $key => $value) {



            $spk = Spk::find($value->spk_id);

            foreach ($spk->details as $key2 => $value2) {

                if ( $value2->asset_id == $asset_id && $value2->asset_type == $asset_type){

                    if ( array_key_exists($spk->itempekerjaan->id, $arrPekerjaan)){

                        $arrPekerjaan[$spk->itempekerjaan->id] = array(

                            "nilai" => $spk->nilai + $arrPekerjaan[$spk->itempekerjaan->id]["nilai"],

                            "item_id" => $spk->itempekerjaan->id + $arrPekerjaan[$spk->itempekerjaan->id]["item_id"],

                            "nilai_vo" => $spk->nilai_vo + $arrPekerjaan[$spk->itempekerjaan->id]["nilai_vo"],

                            "total_kontrak" => $spk->nilai + $spk->nilai_vo + $arrPekerjaan[$spk->itempekerjaan->id]["total_kontrak"],

                            "total_termyn" => ($spk->nilai_progress_bap * $spk->nilai ) + $arrPekerjaan[$spk->itempekerjaan->id]["total_termyn"],

                            "sisa_kontrak" => ( $spk->nilai - ($spk->nilai_progress_bap * $spk->nilai)) + $arrPekerjaan[$spk->itempekerjaan->id]["nilai"],

                            "name" => $spk->itempekerjaan->name

                        );

                    } else{

                        $arrPekerjaan[$spk->itempekerjaan->id] = array(

                            "nilai" => $spk->nilai,

                            "item_id" => $spk->itempekerjaan->id,

                            "nilai_vo" => $spk->nilai_vo,

                            "total_kontrak" => $spk->nilai + $spk->nilai_vo,

                            "total_termyn" => $spk->nilai_progress_bap * $spk->nilai,

                            "sisa_kontrak" => $spk->nilai - ($spk->nilai_progress_bap * $spk->nilai),

                            "name" => $spk->itempekerjaan->name

                        );

                    }                   

                }

            }

        }



        foreach ($arrPekerjaan as $key2 => $value2) {

            $html_pekerjaan .= "<span onclick='spkdetail(".$key2.",".$asset_id.");' data-attribute='1' id='label_".$key2."'>".$arrPekerjaan[$key2]['name']."<ion-icon name='add' id='label_add_".$key2."'></ion-icon><ion-icon name='remove' style='display:none;' id='label_remove_".$key2."'></ion-icon></span><hr><div id='work_".$key2."'></div>";

            $html_nilai_spk .= "<span>".number_format($arrPekerjaan[$key2]['nilai'],2)."</span><hr><div id='nilai_".$key2."'></div>";

            $html_nilai_vo .= "<span>".number_format($arrPekerjaan[$key2]['nilai_vo'],2)."</span><hr><div id='nilai_vo_".$key2."'></div>";

            $html_total_kontrak .= "<span>".number_format($arrPekerjaan[$key2]['total_kontrak'],2)."</span><hr><div id='total_kontrak_".$key2."'></div>";

            $html_total_termyn .= "<span>".number_format($arrPekerjaan[$key2]['total_termyn'],2)."</span><hr><div id='total_termyn_".$key2."'></div>";

            $html_sisa_kontrak .= "<span>".number_format($arrPekerjaan[$key2]['sisa_kontrak'],2)."</span><hr><div id='sisa_kontrak_".$key2."'></div>";

            $html_tgl_spk = "<br><hr/><div id='tgl_spk_".$key2."'></div>";        

            $html_acuan_spk = "<br><hr/><div id='acuan_spk_".$key2."'></div>";

            $html_pekerjaan_spk = "<br><hr/><div id='pekerjaan_".$key2."'></div>";

            $html_nama_rekanan = "<br><hr/><div id='rekanan_".$key2."'></div>";

        }

        return response()->json( [

            "html_pekerjaan" => $html_pekerjaan, 

            "html_nilai_spk" => $html_nilai_spk, 

            "html_nilai_vo" => $html_nilai_vo, 

            "html_total_kontrak" => $html_total_kontrak, 

            "html_total_termyn" => $html_total_termyn, 

            "html_sisa_kontrak" => $html_sisa_kontrak,

            "html_tgl_spk" => $html_tgl_spk,

            "html_acuan_spk" => $html_acuan_spk,

            "html_pekerjaan_spk" => $html_pekerjaan_spk,

            "html_nama_rekanan" => $html_nama_rekanan

        ]);

    }



    public function search_proyek_pekerjaan_spk(Request $request){

        $html_pekerjaan = "";

        $html_nilai_spk = "";

        $html_nilai_vo = "";

        $html_total_kontrak = "";

        $html_total_termyn = "";

        $html_sisa_kontrak = "";

        $html_tgl_spk = "";        

        $html_acuan_spk = "";

        $html_pekerjaan_spk = "";

        $html_nama_rekanan = "";

        $querys = $request->clauses;

        $asset_id = $request->asset_id;

        $asset_type = $request->type;

        $pekerjaan = $request->id;

        $arrPekerjaan = array();



        $results = DB::select($querys);

        foreach ($results as $key => $value) {

            $spk = Spk::find($value->spk_id);

            foreach ($spk->details as $key2 => $value2) {

                if ( $value2->asset_id == $asset_id && $value2->asset_type == $asset_type && $spk->itempekerjaan->id == $pekerjaan){

                    $arrPekerjaan[$spk->id] = array(

                        "spk_no" => $spk->no,

                        "spk_date" => $spk->date,

                        "acuan_spk" => $spk->description,

                        "pekerjaan" => $spk->itempekerjaan->name,

                        "rekanan" => $spk->rekanans->name,

                        "nilai" => $spk->nilai,

                        "nilai_vo" => $spk->nilai_vo,

                        "total_kontrak" => $spk->nilai + $spk->nilai_vo,

                        "total_termyn" => $spk->nilai_progress_bap * $spk->nilai,

                        "sisa_kontrak" => $spk->nilai - ($spk->nilai_progress_bap * $spk->nilai),

                        "st_1" => $spk->st_1,

                        "st_2" => $spk->st_2

                    );              

                }

            }

        }



        foreach ($arrPekerjaan as $key2 => $value2) {

            $html_pekerjaan .= "<i><span class='child_".$pekerjaan."'>".$arrPekerjaan[$key2]['spk_no']."<hr/></span></i>";

            $html_tgl_spk .= "<i><span class='child_".$pekerjaan."'>".$arrPekerjaan[$key2]['spk_date']."<hr/></span></i>";

            $html_acuan_spk .= "<i><span class='child_".$pekerjaan."'>".$arrPekerjaan[$key2]['acuan_spk']."<hr/></span></i>";

            $html_pekerjaan_spk .= "<i><span class='child_".$pekerjaan."'>".$arrPekerjaan[$key2]['pekerjaan']."<hr/></span></i>";

            $html_nama_rekanan .= "<i><span class='child_".$pekerjaan."'>".$arrPekerjaan[$key2]['rekanan']."<hr/></span></i>";

            $html_nilai_spk .= "<i><span class='child_".$pekerjaan."'>".number_format($arrPekerjaan[$key2]['nilai'],2)."<hr/></span></i>";

            $html_nilai_vo .= "<i><span class='child_".$pekerjaan."'>".number_format($arrPekerjaan[$key2]['nilai_vo'],2)."<hr/></span></i>";

            $html_total_kontrak .= "<i><span class='child_".$pekerjaan."'>".number_format($arrPekerjaan[$key2]['total_kontrak'],2)."<hr/></span></i>";

            $html_total_termyn .= "<i><span class='child_".$pekerjaan."'>".number_format($arrPekerjaan[$key2]['total_termyn'],2)."<hr/></span></i>";

            $html_sisa_kontrak .= "<i><span class='child_".$pekerjaan."'>".number_format($arrPekerjaan[$key2]['sisa_kontrak'],2)."<hr/></span></i>";

        }





        return response()->json( [

            "html_pekerjaan" => $html_pekerjaan, 

            "html_nilai_spk" => $html_nilai_spk, 

            "html_nilai_vo" => $html_nilai_vo, 

            "html_total_kontrak" => $html_total_kontrak, 

            "html_total_termyn" => $html_total_termyn, 

            "html_sisa_kontrak" => $html_sisa_kontrak,

            "html_tgl_spk" => $html_tgl_spk,

            "html_acuan_spk" => $html_acuan_spk,

            "html_pekerjaan_spk" => $html_pekerjaan_spk,

            "html_nama_rekanan" => $html_nama_rekanan

        ]);



    }

}



?>
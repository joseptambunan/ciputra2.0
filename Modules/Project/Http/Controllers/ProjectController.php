<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectKawasan;
use Modules\Project\Entities\Blok;
use Modules\Project\Entities\UnitType;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Project\Entities\Templatepekerjaan;
use Modules\Project\Entities\TemplatepekerjaanDetail;
use Modules\Project\Entities\Unit;
use Modules\Globalsetting\Entities\Globalsetting;
use Modules\Budget\Entities\HppUpdate;
use Modules\Budget\Entities\HppUpdateDetail;
use Modules\Project\Entities\UnitArah;
use Modules\Country\Entities\City;
use Modules\Project\Entities\ProjectHistory;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\CategoryDetail;
use Modules\Category\Entities\CategoryProject;
use Modules\Project\Entities\UnitTypeCategory;
use Modules\Project\Entities\UnitTypeCategoryDetail;
use Illuminate\Support\Facades\DB;
use Modules\Project\Entities\ProjectPt;
use Modules\Pt\Entities\Pt;
use Modules\Budget\Entities\BudgetTahunanPeriode;

class ProjectController extends Controller
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
        $project = Project::get();
        return view('project::index',compact("user","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = \Auth::user();
        $project = Project::get();
        $cities = City::get();
        return view('project::create',compact("user","project","cities","cities"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $project = new Project;
        $project->subholding = $request->subholding;
        $project->code = $request->code;
        $project->name = $request->name;
        $project->luas = str_replace(",","",$request->luas);
        $project->address = $request->address;
        $project->zipcode = $request->zipcode;
        $project->phone = $request->phone;
        $project->fax    = $request->fax ;
        $project->email = $request->email;
        $project->description = $request->description;
        $project->city_id = $request->city_id;
        $project->save();

        return redirect("project/detail/?id=".$project->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->id);
        $request->session()->put('project_id', $request->id);
        $level = "" ;
        if ( ($request->session()->get('level'))) {
            $level = "superadmin";
        }

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
            if ( $value->tahun_anggaran == date("Y")){
                //Budget SPK 
                foreach ($value->details as $key2 => $value2) {
                    $budget_cf = BudgetTahunanPeriode::where("budget_id",$value->id)->where("itempekerjaan_id",$value2->itempekerjaan_id)->get();
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
                    if ( $value3->hutang_bayar != "" ){
                        $sisa = $value3->hutang_bayar;
                    }else{
                        $sisa = $value3->spk->nilai - $value3->spk->terbayar_verified;
                    }
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

        $nilai_con_cost = 0;
        foreach ($project->budget_tahunans as $key => $value) {
            if ( $value->tahun_anggaran == date("Y")){
                $nilai_con_cost = $nilai_con_cost + $value->nilai_cash_out_con_cost;
            }
        }
        $nilai_cash_out = $nilai_cash_out + $nilai_con_cost;
        $variabel_cash_out = trim($variabel_cash_out,",");

        $variabel_carry_over = "";
        $nilai_carry_over= 0;
        foreach ($arrayCarryOverCashOut as $key => $value) {
            $variabel_carry_over .= $value.",";
            $nilai_carry_over = $nilai_carry_over + $value;
        }
        //echo $variabel_carry_over."<>".$nilai_carry_over;
        $variabel_carry_over = trim($variabel_carry_over,",");

        $variabel_realiasasi = "";
        foreach ($arrayRealisasi as $key => $value) {
            $variabel_realiasasi .= $value.",";
        }
        return view('project::show',compact("project","user","level","variabel_cash_out","variabel_carry_over","variabel_realiasasi","nilai_cash_out","nilai_carry_over"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $project_detail = Project::find($request->id);
        $user = \Auth::user();
        $project = Project::get();
        $cities = City::get();
        return view('project::edit_project',compact("project","user","project_detail","cities"));
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
    public function deleteKawasan(Request $request)
    {   
        $project_kawasan = ProjectKawasan::find($request->id);
        $status = $project_kawasan->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function kawasan(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view('project::project_kawasan',compact("project","user"));
    }

    public function addKawasan(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $limit = 0;
        foreach ($project->kawasans as $key => $value) {
            $limit = $value->lahan_luas + $limit;
        }

        $limit = $project->luas - $limit;
        return view('project::create_kawasan',compact("project","user","limit"));
    }

    public function saveKawasan(Request $request){
        $authuser = \Auth::user();
        $project_kawasan                         = new ProjectKawasan;
        $project_kawasan->project_id             = $request->project_id;
        $project_kawasan->code                   = strtoupper($request->kode_kawasan);
        $project_kawasan->name                   = strtoupper($request->nama_kawasan);
        $project_kawasan->lahan_status           = $request->lahan_status;
        $project_kawasan->lahan_luas             = str_replace(",","",$request->luas_brutto);
        $project_kawasan->lahan_sellable        = str_replace(",","",$request->luas_netto);
        $project_kawasan->is_kawasan            = $request->is_kawasan;

        if ($request->is_kawasan) 
        {
            $project_kawasan->is_kawasan = TRUE;
        }else{
            $project_kawasan->is_kawasan = FALSE;
        }
        
        $status = $project_kawasan->save();

        //Save to EREM
        /*$project = Project::find($request->project_id);
        $project_id_erem = $project->project_id;

        $project_pt = ProjectPt::where("project_id",$request->project_id)->get();
        if ( count($project_pt) > 0 ){
            $project_pt_id = $project_pt->first()->id;
            $project_pts = ProjectPt::find($project_pt_id);
            $pt = Pt::find($project_pts->pt_id)->pt_id;
        }else{
            $pt = "";
        }

        $users = DB::connection('sqlsrv3')->table('dbo.mh_cluster')->get();
        $ins_erem = DB::connection('sqlsrv3')->insert('insert into [dbo].[mh_cluster] (project_id, pt_id,code,cluster,description,Addon,Addby,Modion,Modiby) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$project_id_erem, $pt,$request->kode_kawasan,$request->nama_kawasan,$request->nama_kawasan,date("Y-m-d H:i:s.000"),7534,date("Y-m-d H:i:s.000"),$authuser->user_id]);
        $get_last = DB::connection('sqlsrv3')->table('dbo.mh_cluster')->where('project_id', $project_id_erem)->get();
        
        $cluster_id = $get_last->last();
        $project_kawasan_upd = ProjectKawasan::find($project_kawasan->id);
        $project_kawasan_upd->cluster_id = $cluster_id->cluster_id;
        $project_kawasan_upd->save();*/
        return redirect("/project/kawasan/");
    }

    public function editKawasan(Request $request){
        $user = \Auth::user();
        $project_kawasan = ProjectKawasan::find($request->id);
        $project = $project_kawasan->project;
        return view('project::edit_kawasan',compact("project_kawasan","user","project"));
    }

    public function updateKawasan(Request $request){
        $project_kawasan = ProjectKawasan::find($request->project_kawasan);
        $project_kawasan->project_id             = $request->project_id;
        $project_kawasan->code                   = $request->kode_kawasan;
        $project_kawasan->name                   = $request->nama_kawasan;
        $project_kawasan->lahan_status           = $request->lahan_status;
        $project_kawasan->lahan_luas             = str_replace(",","",$request->luas_brutto);
        $project_kawasan->lahan_sellable         = str_replace(",","",$request->luas_netto);
        $project_kawasan->is_kawasan             = $request->is_kawasan;
        $project_kawasan->project_type_id        = $request->project_type_id;
        $project_kawasan->save();
        return redirect("/project/kawasan/");
    }

    public function blokKawasan(Request $request){
        $user = \Auth::user();
        $projectkawasan = ProjectKawasan::find($request->id);
        $bloks = $projectkawasan->bloks;
        $project = $projectkawasan->project;
        return view("project::blok_kawasan",compact("projectkawasan","bloks","user","project"));
    }

    public function addblok(Request $request){
        $user = \Auth::user();
        $projectkawasan = ProjectKawasan::find($request->id);
        $project = $projectkawasan;

        
        return view("project::create_blok",compact("user","projectkawasan","project"));
    }

    public function saveblok(Request $request){
        $blok = new Blok;
        $blok->kode = $request->kode;
        $blok->project_id = $request->project_id;
        $blok->project_kawasan_id = $request->projectkawasan;
        $blok->name = $request->name;
        $blok->luas = str_replace(",","",$request->luas);
        $status  = $blok->save();

        //Save to EREM
        /*$authuser = \Auth::user();
        $project = Project::find($request->project_id);
        $project_id_erem = $project->project_id;

        $projectkawasan = ProjectKawasan::find($request->projectkawasan);
        $cluster_id  = $projectkawasan->cluster_id;

        $project_pt = ProjectPt::where("project_id",$request->project_id)->get();
        if ( count($project_pt) > 0 ){
            $project_pt_id = $project_pt->first()->id;
            $project_pts = ProjectPt::find($project_pt_id);
            $pt = Pt::find($project_pts->pt_id)->pt_id;
        }else{
            $pt = "";
        }
        /*$users = DB::connection('sqlsrv3')->table('dbo.m_block')->get();
        $ins_erem = DB::connection('sqlsrv3')->insert('insert into [dbo].[m_block] (project_id, pt_id,cluster_id,code,block,description,Addon,Addby,Modion,Modiby) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$project_id_erem, $pt,$cluster_id,$request->kode,$request->name,$request->description,date("Y-m-d H:i:s.000"),7534,date("Y-m-d H:i:s.000"),$authuser->user_id]);
        $get_last = DB::connection('sqlsrv3')->table('dbo.m_block')->where('cluster_id', $cluster_id)->get();
        $block_id = $get_last->last();

        $blok = Blok::find($blok->id);
        $blok->block_id = $block_id->block_id;
        $blok->save();*/
        return redirect("/project/bloks/?id=".$request->projectkawasan);
    }

    public function editblok(Request $request){
        $blok = Blok::find($request->id);
        $user = \Auth::user();
        $project = $blok->kawasan->project;
        return view("project::edit_blok",compact("user","blok","project"));
    }

    public function updateblok(Request $request){

        $authuser = \Auth::user();
        $blok = Blok::find($request->blok_id);
        $blok->name = $request->name;
        $blok->luas = str_replace(",","",$request->luas);
        $blok->save();

        $cluster_id = $blok->kawasan->cluster_id;
       /* $update_cluster = DB::connection('sqlsrv3')->table('dbo.m_block')->where('block_id', $blok->block_id)->update(['cluster_id' => $cluster_id,'Modiby' => $authuser->user_id, "Modion" => date("Y-m-d H:i:s.000")]);*/
        return redirect("/project/bloks/?id=".$blok->kawasan->id);
    }

    public function deleteblok(Request $request){
        $blok = Blok::find($request->id);
        $status = $blok->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function units(Request $request){
        $blok = Blok::find($request->id);
        $user = \Auth::user();
        $projectkawasan = $blok->kawasan;
        $project = $projectkawasan->project;
        return view("project::unit_kawasan",compact("user","blok","projectkawasan","project"));
    }

    public function addunit(Request $request){
        $user = \Auth::user();
        $blok = Blok::find($request->id);
        $project = $blok->project_kawasan->project;
        $unittype = $project->unittype;
        $units = $blok->units;
        $pt = $project->pts;
        $global_setting = Globalsetting::where("parameter","length_number")->first()->value;
        $start = "";
        for ( $i=0;  $i < ( $global_setting - (strlen(count($units)))) ; $i++ ){
            $start .= "0";
        }
        return view("project::create_unit",compact("user","blok","project","unittype","start"));
    }

    public function unittype(Request $request){
        $project = Project::find($request->session()->get('project_id'));
        $type = $project->unittype;
        $user = \Auth::user();
        return view("project::unit_type",compact("user","type","project"));
    }

    public function addtype(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();
        return view("project::create_type",compact("user","project"));
    }

    public function savetype(Request $request){
        $unit_type = new UnitType;
        $projectkawasan = ProjectKawasan::find($request->kawasan);

        $unit_type->kode = $request->code;
        $unit_type->project_id = $request->project_id;
        $unit_type->name = $request->name;
        $unit_type->luas_bangunan = $request->luas;
        $unit_type->luas_tanah = str_replace(",", "", $request->luas_tanah);
        $unit_type->description = $request->description;
        $unit_type->listrik = str_replace(",", "", $request->elektrik);
        $unit_type->cluster_id = $projectkawasan->id;
        $unit_type->save();

        //Save to EREM
        /*if ( $request->luas > 0 ){
            $productcategory = 1;
        }else{
            $productcategory = 2;
        }

        $authuser = \Auth::user();
/*
        $users = DB::connection('sqlsrv3')->table('dbo.mh_type')->get();
        $ins_erem = DB::connection('sqlsrv3')->insert('insert into [dbo].[mh_type] (productcategory_id,cluster_id,code,name,land_size,building_size,electricity,building_class,floor_size,floor,bedroom,bathroom,Addon,Addby,Modion,Modiby) values (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?)', [
            $productcategory, 
            $projectkawasan->cluster_id,
            $request->code,
            $request->name,
            str_replace(",", "", $request->luas_tanah),
            $request->luas,
            str_replace(",", "", $request->elektrik),
            '',
            $request->luas,
            $request->lantai,
            0,
            0,
            date("Y-m-d H:i:s.000"),
            7534,
            date("Y-m-d H:i:s.000"),
            $authuser->user_id]
        );

        $get_last = DB::connection('sqlsrv3')->table('dbo.mh_type')->get();
        $type_id = $get_last->last();
        $type = UnitType::find($unit_type->id);
        $type->type_id = $type_id->type_id;
        $type->save();
*/

        return redirect("project/templatepekerjaan?id=".$unit_type->id);
    }

    public function deletetype(Request $request){
        $unit_type = UnitType::find($request->id);
        $status = $unit_type->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function updatetype(Request $request){
        $unit_type = UnitType::find($request->id);
        $unit_type->name = $request->name;
        $unit_type->luas_bangunan = $request->luas;
        $unit_type->luas_tanah = $request->luas_tanah;
        $unit_type->listrik = $request->listrik;
        $status = $unit_type->save();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function template(Request $request){
        $project = Project::find($request->session()->get('project_id'));
        $unit_type = UnitType::find($request->id);
       // $template = $unit_type->category;
        $user = \Auth::user();
        $category = Category::get();
        $unit_category = $unit_type->category;
        return view("project::index_template",compact("user","unit_type","project","category","unit_category"));
    }

    public function addtemplate(Request $request){
        $satuan = "";
        $volume = 0;
        $unit_type = UnitType::find($request->unit_type);
        $category_detail = CategoryDetail::find($request->tipe);

        $category_project = new CategoryProject;
        $category_project->category_detail_id = $request->tipe;
        $category_project->project_id = $request->project_id;
        $category_project->unit_type_id = $request->unit_type;
        $category_project->created_by = \Auth::user()->id;
        $category_project->save();

        $unit_category = new UnitTypeCategory;
        $unit_category->unit_type_id = $request->unit_type;
        $unit_category->category_project_id = $category_project->id;
        $unit_category->type = $request->tipe;
        $unit_category->created_by = \Auth::user()->id;
        $unit_category->save();

        $itempekerjaan = Itempekerjaan::get();
        foreach ($itempekerjaan as $key => $value) {
            if ( $value->parent_id == null && $value->group_cost == "2"){
                if ( $value->code == "100" || $value->code == "200" ){
                    $luas = $unit_type->luas_bangunan;
                }else{
                    $luas = 0;
                }

                if ( $value->code == 100 ){ 

                    $unit_category_detail = new UnitTypeCategoryDetail;
                    $unit_category_detail->unit_type_category_id = $unit_category->id;
                    $unit_category_detail->itempekerjaan_id = $value->id;
                    $unit_category_detail->volume = $luas;
                    $unit_category_detail->satuan = 'm2';
                    $unit_category_detail->nilai = 0;
                    $unit_category_detail->created_by = \Auth::user()->id;
                    $unit_category_detail->save();

                    $unit_category_detail = new UnitTypeCategoryDetail;
                    $unit_category_detail->unit_type_category_id = $unit_category->id;
                    $unit_category_detail->itempekerjaan_id = $value->id;
                    $unit_category_detail->volume = $category_detail->percentage ;
                    $unit_category_detail->satuan = '%';
                    $unit_category_detail->nilai = 0;
                    $unit_category_detail->created_by = \Auth::user()->id;
                    $unit_category_detail->save();

                } else if ( $value->code == 200 ){

                    $unit_category_detail = new UnitTypeCategoryDetail;
                    $unit_category_detail->unit_type_category_id = $unit_category->id;
                    $unit_category_detail->itempekerjaan_id = $value->id;
                    $unit_category_detail->volume = $luas;
                    $unit_category_detail->satuan = 'm2';
                    $unit_category_detail->nilai = 0;
                    $unit_category_detail->created_by = \Auth::user()->id;
                    $unit_category_detail->save();
                }

                elseif ( $value->code == 300 ){
                    foreach ($value->child_item as $key2 => $value2) {
                        if ( $value2->code == "300.01" ||  $value2->code == "300.02" || $value2->code == "300.03" || $value2->code == "300.04"){ 
                            if ( str_replace(" ", "", $value2->name) == "BiayaSR(Air,KWHMeter)") {
                                $satuan = "unit";
                                $volume = 1;
                            } elseif ( str_replace(" ", "", $value2->name) == "BiayaSR(Telp,TV,Internet)"){
                                $satuan = "unit";
                                $volume = 1;
                            } else if ( str_replace(" ", "", $value2->name) == "BiayaSR(Listrik)"){
                                $satuan = "va";
                                $volume = $unit_type->listrik;
                            } else if ( str_replace(" ", "", $value2->name) == "BiayaSR(Gas)"){
                                $satuan = "unit";
                                $volume = 1;
                            }   
                            $unit_category_detail = new UnitTypeCategoryDetail;
                            $unit_category_detail->unit_type_category_id = $unit_category->id;
                            $unit_category_detail->itempekerjaan_id = $value2->id;
                            $unit_category_detail->volume = $volume;
                            $unit_category_detail->satuan = $satuan;
                            $unit_category_detail->nilai = 0;
                            $unit_category_detail->created_by = \Auth::user()->id;
                            $unit_category_detail->save();                            
                        }
                    }
                }
            }          

        }

        //Save to EREM
        /*$category = Category::find($request->master_tipe);
        $authuser = \Auth::user();
       /* $update_cluster = DB::connection('sqlsrv3')->table('dbo.mh_type')->where('type_id', $unit_type->type_id)->update(['building_class' => $category->name,'Modiby' => $authuser->user_id, "Modion" => date("Y-m-d H:i:s.000")]);*/
        return redirect("/project/templatepekerjaan/?id=".$request->unit_type);
    }

    public function detailtemplate(Request $request){
        $unit_category = UnitTypeCategory::find($request->id);
        $user = \Auth::user();
        $project = Project::find(($request->session()->get('project_id')));
        return view("project::detail_template",compact("unit_category","user","project"));
    }

    public function updatetemplate(Request $request){

        foreach ($request->id_ as $key => $value) {
            $unit_category_detail = UnitTypeCategoryDetail::find($request->id_[$key]);
            $unit_category_detail->volume = str_replace(",", "", $request->volume_[$key]);
            $unit_category_detail->satuan = $request->satuan_[$key];
            $unit_category_detail->nilai =  str_replace(",","", $request->nilai_[$key]);
            $unit_category_detail->save();
        }
        
        return redirect("/project/templatepekerjaan/?id=".$request->unit_category);
    }

    public function itempekerjaan(Request $request){
        $itempekerjaan = Itempekerjaan::find($request->id);
        $html = "";
        $start = 0;
        foreach ( $itempekerjaan->child_item as $key3 => $value3 ){
            $html .= "<tr>";
            $html .= "<td><strong>".$value3->code."</strong></td>";
            $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value3->id.")' data-attribute='1' id='btn_".$value3->id."'>".$value3->name."</td>";
            $html .= "<td>&nbsp;</td>";
            $html .= "<td>&nbsp;</td>";
            $html .= "</tr>";
            if ( count($value3->child_item) > 0 ){
                foreach ( $value3->child_item as $key4 => $value4 ){
                  if ( count($value4->child_item) > 0 ){
                    foreach ( $value4->child_item as $key5 => $value5 ){
                        $html .= "<tr>";
                        $html .= "<td><strong>".$value5->code."</strong></td>";
                        $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value5->id.")' data-attribute='1' id='btn_".$value5->id."'>".$value5->name."</td>";
                        $html .= "<td><input type='hidden' class='form-control' name='item_id_[".$start."]' value='".$value5->id."'/><input type='text' class='form-control' name='volume_[".$start."]' value='".rand(1,500)."'/></td>";
                        $html .= "<td><input type='text' class='form-control' name='satuan_[".$start."]' value='m2'/></td>";
                        $html .= "</tr>";
                        $start++;
                    }
                  }else{
                    $html .= "<tr>";
                    $html .= "<td><strong>".$value4->code."</strong></td>";
                    $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value4->id.")' data-attribute='1' id='btn_".$value4->id."'>".$value4->name."</td>";
                    $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value4->id."'/><input type='text' class='form-control' name='volume_[".$start."]' value=''/></td>";
                    $html .= "<td><input type='text' class='form-control' name='satuan_[".$start."]' value=''/></td>";
                    $html .= "</tr>";
                    $start++;
                  }
                }
            }
        }
    
        $status = "1";
        if ( $status ){
            return response()->json( ["status" => "0", "html" => $html] );
        }else{
            return response()->json( ["status" => "1", "html" => "" ] );
        }

    }

    public function savetemplatedetail(Request $request){
        //print_r($request->item_id);die;
        foreach ($request->item_id_ as $key => $value) {
            if ( $request->volume_[$key] != "" && $request->satuan_[$key] != "" ){
                $TemplatepekerjaanDetail = new TemplatepekerjaanDetail;
                $TemplatepekerjaanDetail->templatepekerjaan_id = $request->template_id;
                $TemplatepekerjaanDetail->itempekerjaan_id = $request->item_id_[$key];
                $TemplatepekerjaanDetail->volume = $request->volume_[$key];
                $TemplatepekerjaanDetail->satuan = $request->satuan_[$key];
                $TemplatepekerjaanDetail->save();
            }
        }
        return redirect("/project/detail-template/?id=".$request->template_id);
    }

    public function updateproject(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->subholding = $request->subholding;
        $project->code = $request->code;
        $project->name = $request->name;
        $project->luas = str_replace(",","",$request->luas);
        $project->address = $request->address;
        $project->zipcode = $request->zipcode;
        $project->phone = $request->phone;
        $project->fax    = $request->fax ;
        $project->email = $request->email;
        $project->description = $request->description;
        $project->city_id = $request->city_id;
        $project->save();

        return redirect("project/detail-update/?id=".$request->project_id);
    }

    public function saveunit(Request $request){
        $start = "";
        /* Status Unit */
        $array = array(
            "0" => "Planning",
            "1" => "Ready for Stock",
            "2" => "Sudah di WO dan blm SPK",
            "3" => "Sudah di WO dan sdh SPK"
        );

        $blok = Blok::find($request->blok);
        for ($i=1; $i <= $request->quantity ; $i++) 
        { 
            
            $units = $blok->units;
            $global_setting = Globalsetting::where("parameter","length_number")->first()->value;

            $start = "";
            for ( $j=0;  $j < ( $global_setting - (strlen(count($units) + 1) )) ; $j++ ){
                $start .= "0";
            }

            $unit_no = str_replace(" ","",$blok->kode) .'/'. $start.($request->starting_number - 1 +$i);
            $project_units                         = new Unit;
            $project_units->blok_id                = $blok->id;
            $project_units->peruntukan_id          = $request->peruntukan_id;
            $project_units->pt_id                  = $request->pt_id;
            $project_units->name                   = $unit_no;
            $project_units->code                   = $unit_no;
            $project_units->tag_kategori           = $request->tag_kategori;

            $project_units->templatepekerjaan_id   = $request->unit_template;
            $project_units->bangunan_luas          = str_replace(",", "", $request->luas_bangunan);

            $project_units->tanah_luas             = str_replace(",", "", $request->luas_tanah);
            $project_units->unit_arah_id           = $request->unit_arah_id;
            $project_units->unit_type_id           = $request->unit_type;
            $project_units->unit_hadap_id          = $request->unit_hadap;
            if ($request->is_sellable) 
            {
                $project_units->is_sellable = TRUE;
            }else{
                $project_units->is_sellable = FALSE;
            }
            $project_units->status = $request->is_status;
            $status = $project_units->save();

            //Save to EREM    
            /*if ( $request->is_status == 1 ){
                $authuser = \Auth::user();   
                if ( $request->luas_bangunan > 0 ){
                    $productcategory = 1;
                }else{
                    $productcategory = 2;
                }
                $authuser = \Auth::user();
                $project_pt_erem = Project::find($request->project_id)->project_id;
                $projectkawasan = ProjectKawasan::find($request->projectkawasan);
                $pt = Pt::find($request->pt_id);
                $datatype = UnitType::find($request->unit_type);

                if ( $request->is_status == 0 ){
                    $is_readystock = 0;
                }else{
                    $is_readystock = 1;
                }

                //$users = DB::connection('sqlsrv3')->table('dbo.m_unit')->get();
                $ins_erem = DB::connection('sqlsrv3')->insert('insert into [dbo].[m_unit] (project_id,pt_id,cluster_id,unit_number,productcategory_id,type_id,land_size,building_size,floor_size,floor,electricity,block_id,is_readystock,state_admistrative,Addon,Addby,Modion,Modiby) values (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?)', [
                    $project_pt_erem, 
                    $pt->pt_id,
                    $projectkawasan->cluster_id,
                    $unit_no,
                    $productcategory,
                    $datatype->type_id,
                    str_replace(",", "", $request->luas_tanah),
                    str_replace(",", "", $request->luas_bangunan),
                    $request->luas_bangunan,
                    $datatype->lantai,
                    $datatype->electricity,
                    $blok->block_id,
                    $is_readystock,
                    1,
                    date("Y-m-d H:i:s.000"),
                    7534,
                    date("Y-m-d H:i:s.000"),
                    $authuser->user_id]
                );

                $get_last = DB::connection('sqlsrv3')->table('dbo.m_unit')->get();
                $unit_id = $get_last->last();

                $unit = Unit::find($project_units->id);
                $unit->unit_id = $unit_id->unit_id;
                $unit->save();
            }  */ 
        }

        return redirect("project/units/?id=".$request->blok);
    }

    public function getluas(Request $request){
        $type = UnitType::find($request->id);
        $data['luas_tanah'] = $type->luas_tanah;
        $data['luas_bangunan'] = $type->luas_bangunan;
        json_encode($data);
        return response()->json( ["status" => "0", "data" => $data, "luas_tanah" => $type->luas_tanah, "luas_bangunan" => $type->luas_bangunan] );
    }

    public function viewunit(Request $request ){
        $unit = Unit::find($request->id);
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        if ( count($unit->progresses) > 0  ){
            $readonly = "disabled";
        }else{
            $readonly = "";
        }
        return view("project::view_unit",compact("project","user","unit","readonly"));
    }

    public function updateunit(Request $request){
        $unit = Unit::find($request->unit);
        $unit->pt_id = $request->pt_id;
        $unit->unit_arah_id = $request->unit_arah_id;
        $unit->unit_type_id = $request->unit_type;
        $unit->name = $request->unit_nomor;
        $unit->tanah_luas = $request->luas_tanah;
        $unit->bangunan_luas = $request->luas_bangunan;
        $unit->is_sellable = $request->is_sellable;
        $unit->tag_kategori = $request->tag_kategori;
        $unit->status = $request->is_status;
        $unit->save();

        //Save to EREM    
        /*if ( $request->is_status == 1 ){
            $authuser = \Auth::user();   
            if ( $request->luas_bangunan > 0 ){
                $productcategory = 1;
            }else{
                $productcategory = 2;
            }
            $authuser = \Auth::user();
            $project_pt_erem = Project::find($request->project_id)->project_id;
            $projectkawasan = ProjectKawasan::find($request->projectkawasan);
            $pt = Pt::find($request->pt_id);
            $datatype = UnitType::find($request->unit_type);

            if ( $request->is_status == 0 ){
                $is_readystock = 0;
            }else{
                $is_readystock = 1;
            }

            //$users = DB::connection('sqlsrv3')->table('dbo.m_unit')->get();
            $ins_erem = DB::connection('sqlsrv3')->insert('insert into [dbo].[m_unit] (project_id,pt_id,cluster_id,unit_number,productcategory_id,type_id,land_size,building_size,floor_size,floor,electricity,block_id,is_readystock,state_admistrative,Addon,Addby,Modion,Modiby) values (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?)', [
                $project_pt_erem, 
                $pt->pt_id,
                $projectkawasan->cluster_id,
                $unit_no,
                $productcategory,
                $datatype->type_id,
                str_replace(",", "", $request->luas_tanah),
                str_replace(",", "", $request->luas_bangunan),
                $request->luas_bangunan,
                $datatype->lantai,
                $datatype->electricity,
                $blok->block_id,
                $is_readystock,
                1,
                date("Y-m-d H:i:s.000"),
                7534,
                date("Y-m-d H:i:s.000"),
                $authuser->user_id]
            );

            $get_last = DB::connection('sqlsrv3')->table('dbo.m_unit')->get();
            $unit_id = $get_last->last();

            $unit = Unit::find($project_units->id);
            $unit->unit_id = $unit_id->unit_id;
            $unit->save();
        }  */ 
        return redirect("/project/units/?id=".$unit->blok->id);
    }

    public function savehppupdate(Request $request){
        $project = Project::find($request->project_id);
        /*$hpp = $project->hpp_update;
        $hpp = HppUpdate::find($hpp->last()->id);
        $hpp->luas_book = str_replace(",", "", $request->luas_book);
        $hpp->save();*/
        if ( $project->total_nilai_kontrak > 0 ){
            $budget = ( $project->total_budget - $project->total_nilai_kontrak ) + $project->total_nilai_kontrak;
        }else{
            $budget = $project->total_budget;
        }

        if ( $project->netto > 0 ){
            $hpp_akhir = $project->total_budget / $project->netto;
        }else{
            $hpp_akhir = 0;
        }


        $hpp = new HppUpdate;
        $hpp->project_id = $project->id;
        $hpp->nilai_budget = $budget;
        $hpp->luas_book = $request->luas_book;
        $hpp->luas_erem = $request->luas_erem;
        $hpp->netto = $project->netto;
        $hpp->hpp_book = $hpp_akhir;
        $hpp->save();
        $nilai = 0;

        foreach ($project->budgets as $key => $value) {
                
        }

        return redirect("/project/detail?id=".$project->id);
    }

    public function getDevCostTerbayarAttribute(){
        $nilai = 0;
        foreach ($this->spks as $key => $value) {
            $nilai = ( $value->bap * $spk->nilai ) + $nilai;
        }
        return $nilai;
    }

    public function getHutangBayarAttribute(){
        $nilai = 0;
        foreach ($this->spks as $key => $value) {
            $nilai = ( $value->bap * $spk->nilai ) + $nilai;
        }
        return $nilai;
    }

    public function unithadap(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $hadap = $project->hadap;
        return view('project::unit_arah',compact("user","project","hadap"));
    }

    public function savehadap(Request $request){
        $unitarah = new UnitArah;
        $unitarah->name = $request->arah;
        $unitarah->project_id = $request->project_id;
        $unitarah->save();
        return redirect("/project/unit-hadap");
    }

    public function deletehadap(Request $request){
        $unitarah = UnitArah::find($request->id);
        $status = $unitarah->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function dataumum(Request $request) {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));  
        $cities = City::get();  
        return view('project::data_umum',compact("project","user","level","cities"));
    }

    public function updatedataumum(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $project->luas = str_replace(",","",$request->luas);
        $project->address = $request->address;
        $project->zipcode = $request->zipcode;
        $project->phone = $request->phone;
        $project->fax    = $request->fax ;
        $project->email = $request->email;
        $project->description = $request->description;
        $project->city_id = $request->city_id;
        $project->luas_nonpengembangan = str_replace(",","",$request->luas_nonpengembangan);
        $project->save();

        $project_history = new ProjectHistory;
        $project_history->project_id = $request->session()->get('project_id');
        $project_history->luas_dikembangkan = str_replace(",","",$request->luas);
        $project_history->luas_non_pengembangan  = str_replace(",","",$request->luas_nonpengembangan);
        $project_history->created_by = \Auth::user()->id;
        $project_history->pt_id = $request->pt_id;
        $project_history->save();

        return redirect("project/data-umum/");
    }


    public function senderems(Request $request) {
        if ( isset($request->unit_) ){
            foreach ($request->unit_ as $key => $value) {
                $unit = Unit::find($request->unit_[$key]);
                $unit->status = 1;
                $unit->save();
                /*$authuser = \Auth::user();   
                if ( $request->luas_bangunan > 0 ){
                    $productcategory = 1;
                }else{
                    $productcategory = 2;
                }
                $authuser = \Auth::user();
                $project_pt_erem = Project::find($request->project_id)->project_id;
                $projectkawasan = ProjectKawasan::find($request->projectkawasan);
                $pt = Pt::find($request->pt_id);
                $datatype = UnitType::find($request->unit_type);

                if ( $request->is_status == 0 ){
                    $is_readystock = 0;
                }else{
                    $is_readystock = 1;
                }

                //$users = DB::connection('sqlsrv3')->table('dbo.m_unit')->get();
                $ins_erem = DB::connection('sqlsrv3')->insert('insert into [dbo].[m_unit] (project_id,pt_id,cluster_id,unit_number,productcategory_id,type_id,land_size,building_size,floor_size,floor,electricity,block_id,is_readystock,state_admistrative,Addon,Addby,Modion,Modiby) values (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?)', [
                    $project_pt_erem, 
                    $pt->pt_id,
                    $projectkawasan->cluster_id,
                    $unit_no,
                    $productcategory,
                    $datatype->type_id,
                    str_replace(",", "", $request->luas_tanah),
                    str_replace(",", "", $request->luas_bangunan),
                    $request->luas_bangunan,
                    $datatype->lantai,
                    $datatype->electricity,
                    $blok->block_id,
                    $is_readystock,
                    1,
                    date("Y-m-d H:i:s.000"),
                    7534,
                    date("Y-m-d H:i:s.000"),
                    $authuser->user_id]
                );

                $get_last = DB::connection('sqlsrv3')->table('dbo.m_unit')->get();
                $unit_id = $get_last->last();

                $unit = Unit::find($project_units->id);
                $unit->unit_id = $unit_id->unit_id;
                $unit->save();*/                
            }
        }
        return redirect("/project/units/?id=".$request->blok_id);
    }
}

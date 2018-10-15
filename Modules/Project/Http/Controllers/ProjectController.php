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
        if ( $user->group->id == "1"){
            $project = Project::get();
        }else{
            $project = $user->project;
        }
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
        return view('project::show',compact("project","user","level"));
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
        return view('project::create_kawasan',compact("project","user"));
    }

    public function saveKawasan(Request $request){
        $project_kawasan                         = new ProjectKawasan;
        $project_kawasan->project_id             = $request->project_id;
        $project_kawasan->code                   = $request->kode_kawasan;
        $project_kawasan->name                   = $request->nama_kawasan;
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
        return redirect("/project/bloks/?id=".$request->projectkawasan);
    }

    public function editblok(Request $request){
        $blok = Blok::find($request->id);
        $user = \Auth::user();
        $project = $blok->kawasan->project;
        return view("project::edit_blok",compact("user","blok","project"));
    }

    public function updateblok(Request $request){
        $blok = Blok::find($request->blok_id);
        $blok->name = $request->name;
        $blok->luas = str_replace(",","",$request->luas);
        $blok->save();
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
        $unit_type->kode = $request->code;
        $unit_type->project_id = $request->project_id;
        $unit_type->name = $request->name;
        $unit_type->luas_bangunan = $request->luas;
        $unit_type->luas_tanah = str_replace(",", "", $request->luas_tanah);
        $unit_type->description = $request->description;
        $unit_type->listrik = str_replace(",", "", $request->elektrik);
        $unit_type->save();
        return redirect("project/unit-type");
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
        $unit_type = UnitType::find($request->id);
        $template = $unit_type->template;
        $user = \Auth::user();
        return view("project::index_template",compact("user","template","unit_type"));
    }

    public function addtemplate(Request $request){
        $template = new Templatepekerjaan;
        $template->name = $request->nama;
        $template->code = $request->code;
        $template->luasbangunan = $request->lb;
        $template->luas_tanah = $request->lt;
        $template->unit_type_id = $request->unit_type;
        $template->save();
        return redirect("/project/detail-template/?id=".$template->id);
    }

    public function detailtemplate(Request $request){
        $template = Templatepekerjaan::find($request->id);
        $user = \Auth::user();
        $project = Project::find(($request->session()->get('project_id')));
        $itempekerjaan = Itempekerjaan::where("parent_id",null)->get();
        return view("project::detail_template",compact("template","user","project","itempekerjaan"));
    }

    public function updatetemplate(Request $request){
        $template = Templatepekerjaan::find($request->template_id);
        $template->name = $request->nama;
        $template->code = $request->code;
        $template->luasbangunan = $request->lb;
        $template->luas_tanah = $request->lt;
        $template->unit_type_id = $request->unit_type;
        $template->save();
        return redirect("/project/detail-template/?id=".$template->id);
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
        for ($i=1; $i <= $request->quantity ; $i++) 
        { 
            $blok = Blok::find($request->blok);
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

            $status = $project_units->save();
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
        $unit->save();
        return redirect("/project/units/?id=".$unit->blok->id);
    }

    public function savehppupdate(Request $request){
        $project = Project::find($request->project_id);
        /*$hpp = $project->hpp_update;
        $hpp = HppUpdate::find($hpp->last()->id);
        $hpp->luas_book = str_replace(",", "", $request->luas_book);
        $hpp->save();*/
        $hpp = new HppUpdate;
        $hpp->project_id = $project->id;
        $hpp->nilai_budget = $project->total_budget_dev_cost;
        $hpp->luas_book = $request->luas_book;
        $hpp->luas_erem = $request->luas_erem;
        $hpp->netto = $project->netto;
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

}

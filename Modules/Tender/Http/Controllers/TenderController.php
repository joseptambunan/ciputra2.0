<?php

namespace Modules\Tender\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Workorder\Entities\Workorder;
use Modules\Tender\Entities\Tender;
use Modules\Tender\Entities\TenderRekanan;
use Modules\Tender\Entities\TenderPenawaran;
use Modules\Tender\Entities\TenderPenawaranDetail;
use Modules\Tender\Entities\TenderMenang;
use Modules\Tender\Entities\TenderMenangDetail;
use Modules\Rab\Entities\Rab;
use Modules\Rekanan\Entities\Rekanan;
use Modules\Pekerjaan\Entities\Itempekerjaan;

class TenderController extends Controller
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
        $tenders = $project->tenders->get();
        return view('tender::index',compact("user","project","tenders"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $workorder = Workorder::where("budget_tahunan_id",$project->id)->get();
        return view('tender::create',compact("user","project","workorder"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rab = Rab::find($request->tender_rab);
        $department_from = $rab->workorder->department_from;
        $tender = new Tender;
        $tender_no = \App\Helpers\Document::new_number('TENDER', $department_from);
        $tender->rab_id = $request->tender_rab;
        $tender->name = $request->name;
        $tender->no = $tender_no;
        $tender->save();
        return redirect("/tender/detail/?id=".$tender->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $tender = Tender::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $rekanan = Rekanan::get();
        return view('tender::detail',compact("tender","user","project","rekanan"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('tender::edit');
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

    public function saverekanan(Request $request){
        //print_r($request->rekanan);die;
        foreach ($request->rekanan as $key => $value) {
            if ( $request->rekanan[$key] != "" ){
                $tender_rekanan = new TenderRekanan;
                $tender_rekanan->tender_id = $request->tender_id;
                $tender_rekanan->rekanan_id = $request->rekanan[$key];
                $tender_rekanan->save();
            }
            
        }
        return redirect("/tender/detail?id=".$request->tender_id);
    }

    public function removerekanan(Request $request){
        $tenderrekana = TenderRekanan::find($request->id);
        $status = $tenderrekana->delete();
        if ( $status ){
            return response()->json( ["status" => "0"]);
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function approvalrekanan(Request $request){
        $budget = $request->id;
        $class  = "TenderRekanan";
        $approval = \App\Helpers\Document::make_approval('Modules\Tender\Entities\TenderRekanan',$budget);
        return response()->json( ["status" => "0"] );
    }

    public function addpenawaran(Request $request){
        $rekanan = TenderRekanan::find($request->id);
        $rab = $rekanan->tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::detail_rab",compact("rab","itempekerjaan","rekanan","user","project"));
    }

    public function savepenawaran(Request $request){
        $tenderrekaann = TenderRekanan::find($request->tender_rab_id);
        $tender_penawaran = new TenderPenawaran;
        $tender_penawaran->tender_rekanan_id = $request->tender_rab_id;
        $tender_penawaran->no = $request->tender_rab_id;
        $tender_penawaran->date = date("Y-m-d H:i:s");
        $tender_penawaran->created_by = \Auth::user()->id;
        $tender_penawaran->save();
        //print_r($request->input_rab_id_);die;
        foreach ($request->input_rab_id_ as $key => $value) {
            if ( $request->input_rab_nilai_[$key]  != "" ){

                $tenderpenawarandetail = new TenderPenawaranDetail;
                $tenderpenawarandetail->tender_penawaran_id = $tender_penawaran->id;
                $tenderpenawarandetail->rab_pekerjaan_id = $request->input_rab_id_[$key]; 
                $tenderpenawarandetail->keterangan  = $request->input_rab_id_[$key]; 
                $tenderpenawarandetail->nilai = str_replace(",", "",$request->input_rab_nilai_[$key]); 
                $tenderpenawarandetail->volume = str_replace(",","",$request->input_rab_volume_[$key]);
                $tenderpenawarandetail->save();
            }
        }

        return redirect("/tender/detail/?id=".$tenderrekaann->tender->id); 
    }

    public function addstep2(Request $request){
        $tender = Tender::find($request->id);
        $rab = $tender->rab;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        return view("tender::detail_step2",compact("tender","itempekerjaan","user","project"));
    }

    public function savepenawaran2(Request $request){
        $tender = Tender::find($request->tender_id);
        foreach ($tender->rekanans as $key => $value) {
            $tender_penawaran = new TenderPenawaran;
            $tender_penawaran->tender_rekanan_id = $value->id;
            $tender_penawaran->no = $value->id;
            $tender_penawaran->date = date("Y-m-d H:i:s");
            $tender_penawaran->created_by = \Auth::user()->id;
            $tender_penawaran->save();

            foreach ($request->input_rab_id_ as $key2 => $value2) {
                if ( $request->input_rab_volume_[$key2] != "" ){                    
                    $tenderpenawarandetail = new TenderPenawaranDetail;
                    $tenderpenawarandetail->tender_penawaran_id = $tender_penawaran->id;
                    $tenderpenawarandetail->rab_pekerjaan_id = $request->input_rab_id_[$key2]; 
                    $tenderpenawarandetail->keterangan  = $request->input_rab_id_[$key2]; 
                    $tenderpenawarandetail->nilai = "0"; 
                    $tenderpenawarandetail->volume = str_replace(",","",$request->input_rab_volume_[$key2]);
                    $tenderpenawarandetail->save();
                }
            }
        }

        return redirect("/tender/detail/?id=".$request->tender_id); 
        
    }

    public function step2(Request $request){
        $tenderpenawaran = TenderPenawaran::find($request->id);
        $tenderRekanan = $tenderpenawaran->rekanan;
        $rab = $tenderRekanan->tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::detail_penawaran2",compact("rab","itempekerjaan","rekanan","user","project","tenderpenawaran"));
    }

    public function updatepenawaran2(Request $request){

        foreach ($request->input_rab_id_ as $key => $value) {
            $tenderpenawarandetail = TenderPenawaranDetail::find($request->input_rab_id_[$key]);
            $tenderpenawarandetail->nilai = str_replace(",","",$request->input_rab_nilai_[$key]);
            $tenderpenawarandetail->save();
        }
        $TenderPenawaran = TenderPenawaran::find($request->tender_id);
        return redirect("/tender/detail/?id=".$TenderPenawaran->rekanan->tender->id);
    }

    public function savepenawaran3(Request $request){
        $tender = Tender::find($request->tender_id);
        foreach ($tender->rekanans as $key => $value) {
            $tender_penawaran = new TenderPenawaran;
            $tender_penawaran->tender_rekanan_id = $value->id;
            $tender_penawaran->no = $value->id;
            $tender_penawaran->date = date("Y-m-d H:i:s");
            $tender_penawaran->created_by = \Auth::user()->id;
            $tender_penawaran->save();

            foreach ($request->input_rab_id_ as $key2 => $value2) {
                $tenderpenawarandetail = new TenderPenawaranDetail;
                $tenderpenawarandetail->tender_penawaran_id = $tender_penawaran->id;
                $tenderpenawarandetail->rab_pekerjaan_id = $request->input_rab_id_[$key2]; 
                $tenderpenawarandetail->keterangan  = $request->input_rab_id_[$key2]; 
                $tenderpenawarandetail->nilai = "0"; 
                $tenderpenawarandetail->volume = str_replace(",","",$request->input_rab_volume_[$key2]);
                $tenderpenawarandetail->save();
            }
        }

        return redirect("/tender/detail/?id=".$request->tender_id); 
        
    }

    public function addstep3(Request $request){
        $tender = Tender::find($request->id);
        $rab = $tender->rab;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        return view("tender::detail_step3",compact("tender","itempekerjaan","user","project"));
    }

    public function updatepenawaran3(Request $request){
        foreach ($request->input_rab_id_ as $key => $value) {
            if ( $request->input_rab_nilai_[$key] != "" ){                 
                    $tenderpenawarandetail = TenderPenawaranDetail::find($request->input_rab_id_[$key]);
                    $tenderpenawarandetail->nilai = str_replace(",","",$request->input_rab_nilai_[$key]);
                    $tenderpenawarandetail->save();
                }
            }
        
        $tenderPenawaran = TenderPenawaran::find($request->tender_id);
        return redirect("/tender/detail/?id=".$tenderPenawaran->rekanan->tender->id);
    }

    public function step3(Request $request){
        $tenderpenawaran = TenderPenawaran::find($request->id);
        $tenderRekanan = $tenderpenawaran->rekanan;
        $rab = $tenderRekanan->tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::detail_penawaran3",compact("rab","itempekerjaan","rekanan","user","project","tenderpenawaran"));
    }

    public function ispemenang(Request $request){
        $tender_rekanan = TenderRekanan::find($request->id);
        $tender_rekanan->is_pemenang = "1";
        $tender_rekanan->save();

        foreach ($tender_rekanan->tender->rab->units as $key => $value) {
            $tender_menang = new TenderMenang;
            $tender_menang->tender_rekanan_id = $request->id;
            $tender_menang->tender_unit_id = $value->id;
            $tender_menang->asset_type = $value->asset_type;
            $tender_menang->asset_id = $value->asset_id;
            $tender_menang->save();

            foreach ($tender_rekanan->tender->penawarans->last()->details as $key2 => $value2) {
                $tender_menang_details = new TenderMenangDetail;
                $tender_menang_details->tender_menang_id = $tender_menang->id;
                $tender_menang_details->itempekerjaan_id = $value2->itempekerjaan_id;
                $tender_menang_details->nilai = $value2->nilai;
                $tender_menang_details->volume = $value2->volume;
                $tender_menang_details->satuan = $value2->satuan;
                if ( $value->asset_type == "Modules\Project\Entities\Unit"){
                    $unit = Unit::find($value->asset_id);
                    $tender_menang_details->templatepekerjaan_detail_id = $unit->templatepekerjaan_id;
                }else{
                    $tender_menang_details->templatepekerjaan_detail_id = "0";
                }
                $tender_menang_details->save();
            }
        }

        $tender_menang_id = $tender_rekanan->tender->id;
        $class  = "TenderMenang";
        $approval = \App\Helpers\Document::make_approval('Modules\Tender\Entities\TenderMenang',$tender_rekanan->tender->id);


        return response()->json( ["status" => "0"]);
        
    }
}

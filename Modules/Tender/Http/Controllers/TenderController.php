<?php

namespace Modules\Tender\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Workorder\Entities\Workorder;
use Modules\Tender\Entities\Tender;
use Modules\Tender\Entities\TenderUnit;
use Modules\Tender\Entities\TenderRekanan;
use Modules\Tender\Entities\TenderPenawaran;
use Modules\Tender\Entities\TenderPenawaranDetail;
use Modules\Tender\Entities\TenderMenang;
use Modules\Tender\Entities\TenderMenangDetail;
use Modules\Tender\Entities\TenderKorespondensi;
use Modules\Tender\Entities\TenderDocument;
use Modules\Tender\Entities\TenderDocumentApproval;
use Modules\Rab\Entities\Rab;
use Modules\Rekanan\Entities\Rekanan;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Project\Entities\Unit;
use Modules\Globalsetting\Entities\Globalsetting;
use Modules\User\Entities\User;
use Modules\Rekanan\Entities\RekananGroup;

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
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $department_from = $rab->workorder->department_from;
        $project = Project::find($request->session()->get('project_id'));
        $tender = new Tender;
        $tender_no = \App\Helpers\Document::new_number('TENDER', $department_from,$project->id).$rab->budget_tahunan->budget->pt->code;
        $tender->rab_id = $request->tender_rab;
        $tender->name = "Tender-".$itempekerjaan->code."-".$itempekerjaan->name;
        $tender->no = $tender_no;
        $tender->save();
        mkdir("./assets/tender/".$tender->id);
        foreach ($rab->units as $key => $value) {
            $tender_unit = new TenderUnit;
            $tender_unit->tender_id = $tender->id;
            $tender_unit->rab_unit_id = $value->id;
            $tender_unit->created_by = \Auth::user()->id;
            $tender_unit->save();
        }
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
        $rab = $tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $global_setting = Globalsetting::get();
        $data = array();
        foreach ($global_setting as $key => $value) {
            
            if ( $value->parameter == "aanwijzing_date"){
                $data['aanwijzing_date'] = $value->value;
            }

            if ( $value->parameter == "penawaran1_date" ){
                $data['penawaran1_date'] = $value->value;
            }

            if ( $value->parameter == "klarifikasi1_date"){
                $data['klarifikasi1_date'] = $value->value;
            }

            if ( $value->parameter == "penawaran2_date" ){
                $data['penawaran2_date'] = $value->value;
            }

            if ( $value->parameter == "klarifikasi2_date"){
                $data['klarifikasi2_date'] = $value->value;
            }

            if ( $value->parameter == "penawaran3_date" ){
                $data['penawaran3_date'] = $value->value;
            }
        }

        foreach ($tender->rekanans as $key => $value) {
            foreach ($value->korespondensis as $key2 => $value2) {
                if ( $value2->no == "" ){
                    $tenderkorespondensi = TenderKorespondensi::find($value2->id);
                    $tenderkorespondensi->no = \App\Helpers\Document::new_number( (strtoupper($value2->type)), $tender->rab->workorder->department_from, $project->id).$tender->rab->budget_tahunan->budget->pt->code;
                    $tenderkorespondensi->save();
                }
            }
        }

        $dokumen = array( "Gambar" => "Tidak Ada", "BQ" => "Tidak Ada", "Spes" => "Tidak Ada", "Syarat" => "Tidak Ada");
        foreach ($tender->tender_document as $key2 => $value2) {
            if ( $value2->document_name == "Gambar Tender" ){
                $dokumen["Gambar"] = "Ada";
            }else if ( $value2->document_name == "BQ / Bill Item"){
                $dokumen["BQ"] = "Ada";
            }else if ( $value2->document_name == "Spesifikasi Teknis"){
                $dokumen["Spes"] = "Ada";
            }else if ( $value2->document_name == "Syarat=Syarat Khusus yang harus dilengkapi"){
                $dokumen["Syarat"] = "Ada";
            }
        }

        $ttd = array();
        if ( $tender->approval != "" ){            
            $tender_apprroval = $tender->approval->histories;
            $start = 0;
            foreach ($tender_apprroval as $key => $value) {
                foreach ($value->user->jabatan as $key2 => $value2) {
                    if ( $value2['jabatan'] == "General Manager" || $value2['jabatan'] == "Kepala Departemen" || $value2['jabatan'] == "Kepala Divisi"){
                        $ttd[$start] = array("nama" => $value->user->user_name, "jabatan" => $value2["jabatan"] );
                        $start++;
                    }
                }
            }
        }

        $tanggal_sekarang = date("Y-m-d H:i:s");

        return view('tender::detail2',compact("tender","user","project","rekanan","itempekerjaan","data","dokumen","ttd","tanggal_sekarang"));
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
        $tender = Tender::find($request->tender_id);
        $tender->durasi = $request->tender_durasi;
        $tender->name = $request->tender_name;
        $tender->ambil_doc_date = date("Y-m-d H:i:s",strtotime($request->ambil_doc_date));
        $tender->aanwijzing_date = date("Y-m-d H:i:s",strtotime($request->aanwijzing_date));
        $tender->penawaran1_date = date("Y-m-d H:i:s",strtotime($request->penawaran1_date));
        $tender->klarifikasi1_date = date("Y-m-d H:i:s",strtotime($request->klarifikasi1_date));

        $tender->penawaran2_date = date("Y-m-d H:i:s",strtotime($request->penawaran2_date));
        $tender->klarifikasi2_date = date("Y-m-d H:i:s",strtotime($request->klarifikasi2_date));
        $tender->pengumuman_date = date("Y-m-d H:i:s",strtotime($request->pengumuman_date));
        $tender->penawaran3_date = date("Y-m-d H:i:s",strtotime($request->pengumuman_date));
        $tender->recommendation_date = date("Y-m-d H:i:s",strtotime($request->recommendation_date));
        $tender->harga_dokumen = str_replace(",", "", $request->harga_dokumen);
        $tender->sifat_tender = $request->jenis_kontrak;
        $tender->save();
        return redirect("/tender/detail?id=".$tender->id);
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
        if ( $request->rekanan != "" ){
            foreach ($request->rekanan as $key => $value) {
                if ( $request->rekanan[$key] != "" ){
                    $tender_rekanan = new TenderRekanan;
                    $tender_rekanan->tender_id = $request->tender_id;
                    $tender_rekanan->rekanan_id = $request->rekanan[$key];
                    $tender_rekanan->save();
                }           
                
            }
        }
        

        $tanggal_sekarang = date("Y-m-d H:i:s");
        return redirect("/tender/rekanan/referensi?id=".$request->tender_id);
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

        foreach ( $request->rekanan_ as $key => $value){
            if ( $request->rekanan_[$key]){                
                $budget = $request->rekanan_[$key];
                $class  = "TenderRekanan";
                $approval = \App\Helpers\Document::make_approval('Modules\Tender\Entities\TenderRekanan',$budget);
            }
        }

        $tender = $request->tender_id;
        $class  = "Tender";
        $approval = \App\Helpers\Document::make_approval('Modules\Tender\Entities\Tender',$tender);
        
        $tenders = Tender::find($request->tender_id);
        foreach ($request->dokumen as $key => $value) {

            $tender_dokumen = new TenderDocument;
            $tender_dokumen->tender_id = $tenders->id;
            $tender_dokumen->document_name = $request->dokumen[$key];
            $tender_dokumen->created_by = \Auth::user()->id;
            $tender_dokumen->save(); 

            $approval_references = \Modules\Approval\Entities\ApprovalReference::where('document_type', 'Tender')
                                    ->where('project_id', $tenders->project->id )
                                    //->where('pt_id', $pt_id )
                                    ->where('min_value', '<=', '0')
                                    //->where('max_value', '>=', $approval->total_nilai)
                                    ->orderBy('no_urut','ASC')
                                    ->get();
            foreach ($approval_references as $key2 => $each2) 
            {
                $users = User::find($each2->user_id);   
                if ( isset($users->jabatan)) {
                    foreach( $users->jabatan as $key3 => $value3){
                        
                        if ( $value3['jabatan_id'] == "7" ){
                            $tender_dokumen_approval = new TenderDocumentApproval;
                            $tender_dokumen_approval->tender_document_id = $tender_dokumen->id;
                            $tender_dokumen_approval->user_id = $each2->user->id;
                            $tender_dokumen_approval->status = "1";
                            $tender_dokumen_approval->created_by = \Auth::user()->id;
                            $tender_dokumen_approval->level = $value3['jabatan_id'];
                            $tender_dokumen_approval->save(); 
                        }else if (  $value3['jabatan_id'] == "6" || $value3['jabatan_id'] == "5" ){
                            $tender_dokumen_approval = new TenderDocumentApproval;
                            $tender_dokumen_approval->tender_document_id = $tender_dokumen->id;
                            $tender_dokumen_approval->user_id = $each2->user->id;
                            $tender_dokumen_approval->status =  1;
                            $tender_dokumen_approval->created_by = \Auth::user()->id;
                            $tender_dokumen_approval->level = $value3['jabatan_id'];
                            $tender_dokumen_approval->save();
                        }
                    }   
                }                       
            }           
        }

        return redirect("/tender/detail?id=".$request->tender_id);
        //return response()->json( ["status" => "0"] );
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
            if ( $request->input_rab_nilai_[$key]  != "" && $request->input_rab_volume_[$key] != "" ){

                $tenderpenawarandetail = new TenderPenawaranDetail;
                $tenderpenawarandetail->tender_penawaran_id = $tender_penawaran->id;
                $tenderpenawarandetail->rab_pekerjaan_id = $request->input_rab_id_[$key]; 
                $tenderpenawarandetail->keterangan  = $request->input_rab_id_[$key]; 
                $tenderpenawarandetail->nilai = str_replace(",", "",$request->input_rab_nilai_[$key]); 
                $tenderpenawarandetail->volume = str_replace(",","",$request->input_rab_volume_[$key]);
                $tenderpenawarandetail->satuan = str_replace(",","",$request->input_rab_satuan_[$key]);
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
            if ( $value->approval != "" ){
                if ( $value->approval->approval_action_id == "6") {
                    foreach ($value->penawarans as $key2 => $value2) {
                        $old_penawaran = TenderPenawaran::find($value2->id);
                        $old_penawaran->updated_by = \Auth::user()->id;
                        $old_penawaran->save();
                    }

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
                            $tenderpenawarandetail->satuan = str_replace(",","",$request->input_rab_satuan_[$key2]);
                            $tenderpenawarandetail->save();
                        }
                    }
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
        $penawaran_id = "";
        foreach ($tenderRekanan->penawarans as $key => $value) {
            if ( $value->updated_by == null ) {
                $penawaran_id = $value->id;
            }
        }

        return view("tender::detail_penawaran2",compact("rab","itempekerjaan","rekanan","user","project","tenderpenawaran","tenderRekanan","penawaran_id"));
    }

    public function updatepenawaran2(Request $request){
        foreach ($request->input_rab_id_ as $key => $value) {
            if ( $request->input_rab_nilai_[$key] != "" ){
                $tenderpenawarandetail = TenderPenawaranDetail::find($request->input_rab_id_[$key]);
                $tenderpenawarandetail->nilai = str_replace(",","",$request->input_rab_nilai_[$key]);
                $tenderpenawarandetail->save();
            }else{
                echo $request->input_rab_id_[$key];
            }
        }
        $TenderPenawaran = TenderPenawaran::find($request->tender_id);
        if ( $_FILES['fileupload']['tmp_name'] != ""){
            $array_mime = array("application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.ms-excel","application/msword");
            $mime = mime_content_type($_FILES['fileupload']['tmp_name']);
            if ( in_array($mime, $array_mime)){
                $target_file =  /*$_SERVER["DOCUMENT_ROOT"].*/"../assets/tender/".$TenderPenawaran->rekanan->tender->id;
                move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file);
                $TenderPenawaran->file_attachment = $_FILES['fileupload']['name'];
                $TenderPenawaran->save();
            }else{
                print("<script type='text/javascript'>alert('Format file tidak bisa diterima. Silahkan upload sesuai format yang diminta');</script>");
            }
        }
        return redirect("/tender/detail/?id=".$TenderPenawaran->rekanan->tender->id);
    }

    public function savepenawaran3(Request $request){
        $tender = Tender::find($request->tender_id);
        foreach ($tender->rekanans as $key => $value) {
            if ( $value->approval != "" ){
                if ( $value->approval->approval_action_id == "6") {
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
                        $tenderpenawarandetail->satuan = str_replace(",","",$request->input_rab_satuan_[$key2]);
                        $tenderpenawarandetail->save();
                    }
                }
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
        if ( $_FILES['fileupload']['tmp_name'] != ""){
            $array_mime = array("application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.ms-excel","application/msword");
            $mime = mime_content_type($_FILES['fileupload']['tmp_name']);
            if ( in_array($mime, $array_mime)){
                $target_file = /*$_SERVER["DOCUMENT_ROOT"].*/"../public/assets/tender/".$tenderPenawaran->rekanan->tender->id."/".$_FILES['fileupload']['name'];
                move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file);
                $tenderPenawaran->file_attachment = $_FILES['fileupload']['name'];
                $tenderPenawaran->save();
            }else{
                print("<script type='text/javascript'>alert('Format file tidak bisa diterima. Silahkan upload sesuai format yang diminta');</script>");
            }
        }
        return redirect("/tender/detail/?id=".$tenderPenawaran->rekanan->tender->id);
    }

    public function step3(Request $request){
        $tenderpenawaran = TenderPenawaran::find($request->id);
        $tenderRekanan = $tenderpenawaran->rekanan;
        $rab = $tenderRekanan->tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $penawaran_id = "";
        foreach ($tenderRekanan->penawarans as $key => $value) {
            if ( $value->updated_by == null ) {
                $penawaran_id = $value->id;
            }
        }
        return view("tender::detail_penawaran3",compact("rab","itempekerjaan","rekanan","user","project","tenderpenawaran","tenderRekanan","penawaran_id"));
    }

    public function ispemenang(Request $request){
        $tender_rekanan = TenderRekanan::find($request->id);
        $tender_rekanan->is_recomendasi = "1";
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
                $tender_menang_details->itempekerjaan_id = $value2->rab_pekerjaan->itempekerjaan_id;
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
        //$class  = "TenderMenang";
        //$approval = \App\Helpers\Document::make_approval('Modules\Tender\Entities\TenderMenang',$tender_menang->id);


        return response()->json( ["status" => "0"]);
        
    }

    public function rekaptender(Request $request){
        $tender = Tender::find($request->id);
        $step   = $request->step - 1 ;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::tender_rekap",compact("tender","step","project","user"));
    }

    public function editpenawaran(Request $request){        
        $user    = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $tenderpenawaran  = TenderPenawaran::find($request->id);
        return view("tender::edit_penawaran",compact("user","project","tenderpenawaran")); 
    }

    public function saveeditpenawaran(Request $request){
        foreach ($request->id_ as $key => $value) {
            if ( $request->nilai_[$key] != "" && $request->volume_[$key] != "" ){
                $tenderpenawarandetail = TenderPenawaranDetail::find($request->id_[$key]);
                $tenderpenawarandetail->nilai = str_replace(",", "", $request->nilai_[$key]);
                $tenderpenawarandetail->volume = $request->volume_[$key];
                $tenderpenawarandetail->save();
            }
        }

        return redirect("/tender/detail/?id=".$request->tender_id);
    }

    public function download(Request $request){
        $tenderpenawaran = TenderPenawaran::find($request->id);
        $tender          = $tenderpenawaran->rekanan->tender->id;
        $file            =  /*$_SERVER["DOCUMENT_ROOT"].*/"../public/assets/tender/".$tender."/".$tenderpenawaran->file_attachment;
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

    public function approval_history(Request $request){
        $tender = Tender::find($request->id);
        $user   = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::approval_history",compact("tender","user","project"));
    }

    public function updatedocument(Request $request){
        if ( $request->check != "" ){
            foreach ($request->check as $key => $value) {
                if ( $request->check[$key] != "" ){
                    $tender = TenderDocument::find($request->dokumen[$key]);
                    foreach ($tender->document_approval as $key2 => $value2) {   
                        if ( $value2->tender_document_id == $request->dokumen[$key] ){
                            if ( $value2->status == "7" ){
                                $tender_approval = TenderDocumentApproval::find($value2->id);
                                $tender_approval->status = "1";
                                $tender_approval->save();
                            }
                        }              
                    }  
                }
            }
        }
        
        return redirect("/tender/detail/?id=".$request->tender_docs);
    }

    public function referensi(Request $request){
        $tender = Tender::find($request->id);
        $user   = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $rekanan_group = RekananGroup::get();
        $itempekerjaan = $tender->rab->pekerjaans->first()->itempekerjaan->parent;
        if ( $itempekerjaan->parent == null ){
            $itemkerjan = Itempekerjaan::find($itempekerjaan->id);
        }else{
            $itemkerjan = Itempekerjaan::find($itempekerjaan->parent->id);

        }

        $pekerjaan = Itempekerjaan::get();
        return view("tender::tender_referensi",compact("tender","user","project","rekanan_group","itemkerjan","pekerjaan"));
    }

    public function searchreferensi(Request $request){
        $html = "";
        $start = 0;
        $itempekerjaan = Itempekerjaan::find($request->itempekerjaan);
        if ( $request->itempekerjaan == "all"){
            $rekanan_group = RekananGroup::get();
            foreach ($rekanan_group as $key => $value) {
                foreach ($value->rekanans as $key2 => $value2) {
                    $html .= "<tr>";
                    $html .= "<td>".$value2->name."</td>";
                    $html .= "<td>";
                    foreach ($value->spesifikasi as $key3 => $value3) {
                        $html .= "<li>".$value3->itempekerjaan->name."</li>";
                    }
                    $html .= "</td>";
                    $html .= "<td><input type='checkbox' name='rekanan[".$start."]' value='".$value2->id."'></td>";
                    $html .= "</tr>";
                    $start++;
                }         
            }
        }else{
            $itemkerjan = Itempekerjaan::find($itempekerjaan->id);
            $rekanan_group = RekananGroup::get();
            foreach ($rekanan_group as $key => $value) {
                foreach ( $value->spesifikasi as $key3 => $value3 ){
                    if ( $value3->itempekerjaan->id == $itemkerjan->id ){
                        foreach ($value->rekanans as $key4 => $value4) {
                            $html .= "<tr>";
                            $html .= "<td>".$value4->name."</td>";
                            $html .= "<td>";
                            foreach ($value->spesifikasi as $key3 => $value3) {
                                $html .= "<li>".$value3->itempekerjaan->name."</li>";
                            }
                            $html .= "</td>";
                            $html .= "<td><input type='checkbox' name='rekanan[".$start."]' value='".$value4->id."'></td>";
                            $html .= "</tr>";
                            $start++;
                        }    
                    }
                }
                     
            }
        }
        return response()->json( ["status" => "0", "html" => $html]);
    }
}

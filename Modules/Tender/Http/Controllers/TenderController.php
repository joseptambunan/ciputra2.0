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
use Modules\TenderMaster\Entities\TenderMaster;
use Modules\Country\Entities\City;
use Modules\Tender\Entities\TenderAanwijings;
use Modules\Tender\Entities\TenderBeritaAcaras;
use Modules\Spk\Entities\SpkTermyn;
use Modules\Spk\Entities\SpkRetensi;
use Storage;

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
        $tenders = $project->tenders->orderBy("id","desc")->get();
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
        $workorder = Workorder::get();
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
        $itempekerjaan = Itempekerjaan::find($rab->pekerjaans->last()->itempekerjaan->parent->id);
        $department_from = $rab->workorder->department_from;
        $project = Project::find($request->session()->get('project_id'));
        $tender = new Tender;
        $tender_no = \App\Helpers\Document::new_number('TENDER', $department_from,$project->id).$rab->budget_tahunan->budget->pt->code;
        $tender->rab_id = $request->tender_rab;
        $tender->name = "Tender-".$itempekerjaan->code."-".$itempekerjaan->name."-".$rab->name;
        $tender->no = $tender_no;
        $tender->save();

        if (!file_exists("./assets/tender/".$tender->id)) {
            mkdir("./assets/tender/".$tender->id);
        }

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
        $itempekerjaan = Itempekerjaan::find($rab->pekerjaans->last()->itempekerjaan->parent->id);
        $global_setting = Globalsetting::get();
        $data = array();
        $tendermaster = TenderMaster::get();

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
            }else if ( $value2->document_name == "Klasifikasi Teknis"){
                $dokumen["Spes"] = "Ada";
            }else if ( $value2->document_name == "Syarat-Syarat Khusus yang harus dilengkapi"){
                $dokumen["Syarat"] = "Ada";
            }
        }

        $ttd = array();
        if ( $tender->approval != "" ){            
            $tender_apprroval = $tender->approval->histories;
            $start = 0;
            foreach ($tender_apprroval as $key => $value) {
                if ( $value->user != "" ){
                    foreach ($value->user->jabatan as $key2 => $value2) {
                        if ( $value2['jabatan'] == "General Manager" || $value2['jabatan'] == "Kepala Departemen" || $value2['jabatan'] == "Kepala Divisi"){
                            $ttd[$start] = array("nama" => $value->user->user_name, "jabatan" => $value2["jabatan"] );
                            $start++;
                        }
                    }                    
                }
            }
        }

        $tanggal_sekarang = date("Y-m-d H:i:s.u");
        $start_tender = 0 ;
        if ( count($tender->rekanans) > 0 ){
            foreach ($tender->rekanans as $key => $value) {
                if ( $value->approval != "" ){
                    if ( $value->approval->approval_action_id == 6 ){
                        $start_tender = $start_tender + 1;
                    }
                }
            }
        }

        return view('tender::detail2',compact("tender","user","project","rekanan","itempekerjaan","data","dokumen","ttd","tanggal_sekarang","tendermaster","start_tender"));
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
        //echo strtotime($request->ambil_doc_date);die;
        $tender = Tender::find($request->tender_id);
        $tender->durasi = $request->tender_durasi;
        $tender->name = $request->tender_name;
        $tender->ambil_doc_date = date("Y-m-d H:i:s.u",strtotime($request->ambil_doc_date));
        $tender->aanwijzing_date = date("Y-m-d H:i:s.u",strtotime($request->aanwijzing_date));
        $tender->penawaran1_date = date("Y-m-d H:i:s.u",strtotime($request->penawaran1_date));
        $tender->klarifikasi1_date = date("Y-m-d H:i:s.u",strtotime($request->klarifikasi1_date));

        $tender->penawaran2_date = date("Y-m-d H:i:s.u",strtotime($request->penawaran2_date));
        $tender->klarifikasi2_date = date("Y-m-d H:i:s.u",strtotime($request->klarifikasi2_date));
        $tender->pengumuman_date = date("Y-m-d H:i:s.u",strtotime($request->pengumuman_date));
        $tender->penawaran3_date = date("Y-m-d H:i:s.u",strtotime($request->pengumuman_date));
        $tender->recommendation_date = date("Y-m-d H:i:s.u",strtotime($request->recommendation_date));
        $tender->harga_dokumen = str_replace(",", "", $request->harga_dokumen);
        $tender->sifat_tender = $request->jenis_kontrak;
        $tender->kelas_id =$request->tender_type;
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
        $tender = Tender::find($request->tender_id);
        if ( $request->rekanan != "" ){
            foreach ($request->rekanan as $key => $value) {
                if ( $request->rekanan[$key] != "" ){
                    $tender_rekanan = new TenderRekanan;
                    $tender_rekanan->tender_id = $request->tender_id;
                    $tender_rekanan->rekanan_id = $request->rekanan[$key];
                    if ( $tender->harga_dokumen <= 0 ){
                        $tender_rekanan->doc_bayar_status = 1;
                    }
                    $tender_rekanan->save();
                }           
                
            }
        }
        

        $tanggal_sekarang = date("Y-m-d H:i:s.u");
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
        
        $project = Project::find($request->session()->get('project_id'));
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
        if ( $tenders->rab->workorder_budget_detail != "" ){
            if ( count($tenders->rab->workorder_budget_detail->dokumen) > 0  ){
                foreach ( $tenders->rab->workorder_budget_detail->dokumen as $key4 => $value4 ){
                    $tender_dokumen = TenderDocument::find($value4->id);
                    $tender_dokumen->tender_id = $tenders->id;
                    $tender_dokumen->save();

                }
            }else{
                if ( $request->dokumen != "" ){
                    
                    foreach ($request->dokumen as $key => $value) {

                        $tender_dokumen = new TenderDocument;
                        $tender_dokumen->tender_id = $tenders->id;
                        $tender_dokumen->document_name = $request->dokumen[$key];
                        $tender_dokumen->created_by = \Auth::user()->id;
                        $tender_dokumen->save(); 
                    }
                }
            }

            $approval_references = \Modules\Approval\Entities\ApprovalReference::where('document_type', 'Tender')
                                    ->where('project_id', $project->id )
                                    //->where('pt_id', $pt_id )
                                    ->where('min_value', '<=', '0')
                                    //->where('max_value', '>=', $approval->total_nilai)
                                    ->orderBy('no_urut','ASC')
                                    ->get();
            foreach ($approval_references as $key2 => $each2) {
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
            
        }else{

            foreach ($request->dokumen as $key => $value) {

                $tender_dokumen = new TenderDocument;
                $tender_dokumen->tender_id = $tenders->id;
                $tender_dokumen->document_name = $request->dokumen[$key];
                $tender_dokumen->created_by = \Auth::user()->id;
                $tender_dokumen->save(); 

                $approval_references = \Modules\Approval\Entities\ApprovalReference::where('document_type', 'Tender')
                                        ->where('project_id', $project->id )
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
        }

        return redirect("/tender/detail?id=".$request->tender_id);
        //return response()->json( ["status" => "0"] );
    }

    public function addpenawaran(Request $request){
        $rekanan = TenderRekanan::find($request->id);
        $rab = $rekanan->tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->pekerjaans->last()->itempekerjaan->parent->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::detail_rab",compact("rab","itempekerjaan","rekanan","user","project"));
    }

    public function savepenawaran(Request $request){
        $tenderrekaann = TenderRekanan::find($request->tender_rab_id);
        $tender_penawaran = new TenderPenawaran;
        $tender_penawaran->tender_rekanan_id = $request->tender_rab_id;
        $tender_penawaran->no = $request->tender_rab_id;
        $tender_penawaran->date = date("Y-m-d H:i:s.u");
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
        $itempekerjaan = Itempekerjaan::find($rab->pekerjaans->last()->itempekerjaan->parent->id);
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
                    $tender_penawaran->date = date("Y-m-d H:i:s.u");
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
        $itempekerjaan = Itempekerjaan::find($rab->pekerjaans->last()->itempekerjaan->parent->id);
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
                    $tender_penawaran->date = date("Y-m-d H:i:s.u");
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
        $itempekerjaan = Itempekerjaan::find($rab->pekerjaans->last()->itempekerjaan->parent->id);
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
        $itempekerjaan = Itempekerjaan::find($rab->pekerjaans->last()->itempekerjaan->parent->id);
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

        $project_all = Project::get();

        $pekerjaan = Itempekerjaan::get();
        return view("tender::tender_referensi",compact("tender","user","project","rekanan_group","itemkerjan","pekerjaan","project_all"));
    }

    public function searchreferensi(Request $request){
        $html = "";
        $project_name = "";
        $start = 0;
        $list_rekanan = array();

        if ( $request->rekanan_name != "" ){
            $rekanan_group = RekananGroup::where("name","like","%".$request->rekanan_name."%")->get();
            foreach ($rekanan_group as $key => $value) {
                $rekanan_group = RekananGroup::find($value->id);
                foreach ($rekanan_group->supps as $key2 => $value2) {
                    foreach ( $value2->pt->project as $key3 => $value3 ){
                        $project_name .= $value3->project->name .",";
                    }
                }

                foreach ( $rekanan_group->rekanans as $key4 => $value4 ){                    
                    $list_rekanan[$start] = array ( "id" => $value4->id, "name" => $value->name, "project" => $project_name, "rekanan_group_id" => $rekanan_group->id );
                    $start++;
                }
            }
        }

        //return response()->json(["status" => $list_rekanan]);
        if ( $request->itempekerjaan != "all" ){
            $itempekerjaan = Itempekerjaan::find($request->itempekerjaan);

            foreach ($itempekerjaan->rekanan_specification as $key => $value) { 
                if ( $request->rekanan_name == "" ){
                    $spesfikasi = "";                    
                    foreach ($value->rekanan_group->spesifikasi as $key => $value) {
                        $spesfikasi .= $value->itempekerjaan->name.",";
                    }   

                    $project_name = "";
                    foreach ($value->rekanan_group->supps as $key2 => $value2) {
                        foreach ( $value2->pt->project as $key3 => $value3 ){
                            $project_name .= $value3->project->name .",";
                        }
                    }


                    $html .= "<tr>";
                    $html .= "<td>".$value->rekanan_group->name."</td>"; 
                    $html .= "<td>".$spesfikasi."</td>";   
                    $html .= "<td>".$project_name."</td>";   
                    $html .= "<td><input type='checkbox' value='".$value3['id']."' name='rekanan[".$key3."]'/>Set to Tender</td>";               
                }else{
                    foreach ( $list_rekanan as $key3 => $value3){                    
                        if ( $value3['id'] == $value->rekanan_group_id ){      
                            $spesfikasi = "";
                            
                            foreach ($value->rekanan_group->spesifikasi as $key => $value) {
                                $spesfikasi .= $value->itempekerjaan->name.",";
                            }                  
                            
                            $html .= "<tr>";
                            $html .= "<td>".$value3['name']."</td>"; 
                            $html .= "<td>".$spesfikasi."</td>";   
                            $html .= "<td>".$value3['project']."</td>";   
                            $html .= "<td><input type='checkbox' value='".$value3['id']."' name='rekanan[".$key3."]'/>Set to Tender</td>";      
                        }
                    }
                }
            }            
        }else{   
            foreach ( $list_rekanan as $key3 => $value3){  

                $rekanan_group_detail = RekananGroup::find($value3['id']);
                $spesfikasi = "";
                        
                foreach ($rekanan_group_detail->spesifikasi as $key => $value) {
                    $spesfikasi .= $value->itempekerjaan->name.",";
                }                             
                $html .= "<tr>";
                $html .= "<td>".$value3['name']."</td>"; 
                $html .= "<td>".$spesfikasi."</td>"; 
                $html .= "<td>".$value3['project']."</td>";   
                $html .= "<td><input type='checkbox' value='".$value3['id']."' name='rekanan[".$key3."]'/>Set to Tender</td>";  
            }   
        }
        if ( $html == "" ){
            $html .= "<tr>";
            $html .= "<td colspan='4'>Data tidak ditemukan</td>";
            $html .= "</tr>";
        }
       // return response()->json(["status" => $list_rekanan]);
        return response()->json( ["status" => "0", "html" => $html]);
    }

    public function addreferensi(Request $request){
        $user = \Auth::user();
        $tender = Tender::find($request->id);
        $city = City::get();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::referensi_add",compact("user","tender","city","project"));
    }

    public function savereferensi(Request $request){
        $project = Project::find($request->session()->get('project_id'));
        $rekanan_group = new RekananGroup;
        $rekanan_group->pph_percent = $request->pph;
        $rekanan_group->name = $request->name;
        $rekanan_group->npwp_alamat = $request->alamat;
        $rekanan_group->npwp_kota = $request->kota;
        $rekanan_group->cp_name = $request->contact_name;
        $rekanan_group->cp_jabatan = $request->contact_position;
        $rekanan_group->project_id = $project->id;
        $rekanan_group->description = "Disurvey oleh ".$request->survey_name;

        if ( $request->pkp == "" ){
            $rekanan_group->pkp_status = 2;
            $pkp_status = 2;
        }else{
            $rekanan_group->pkp_status = 1;
            $pkp_status = 1;
        }
        $rekanan_group->save();

        $rekanan_group_update = RekananGroup::find($rekanan_group->id);

        if (!file_exists ("./assets/rekanan/".$rekanan_group->id)) {
            mkdir("./assets/rekanan/".$rekanan_group->id);
            chmod("./assets/rekanan/".$rekanan_group->id,0755);
        }

        $target_file = "./assets/rekanan/".$request->rekanan_group_id."/".$_FILES['sertifikat']['name'];
                move_uploaded_file($_FILES["sertifikat"]["tmp_name"], $target_file);

        $target_file_2 = "./assets/rekanan/".$request->rekanan_group_id."/".$_FILES['sertifikat']['name'];
                move_uploaded_file($_FILES["npwp"]["tmp_name"], $target_file);

        $target_file_3 = "./assets/rekanan/".$request->rekanan_group_id."/".$_FILES['sertifikat']['name'];
                move_uploaded_file($_FILES["siup_file"]["tmp_name"], $target_file);

        if ( $_FILES['npwp']['name'] == "" ){
            $rekanan_group_update->npwp_image = "";
        }else{
            $rekanan_group_update->npwp_image = $_FILES['npwp']['name'];
        }

        $rekanan_group_update->save();

        if ( $_FILES['siup_file']['name'] == "" ){
            $siup_file = "";
        }else{
            $siup_file = $_FILES['siup_file']['name'];
        }

        if ( count($rekanan_group->rekanans) <= 0 ){            
            $rekanan_child = new Rekanan;
            $rekanan_child->rekanan_group_id = $rekanan_group->id;
            $rekanan_child->name = $request->name;
            $rekanan_child->surat_alamat = $request->alamat;
            $rekanan_child->surat_kota = $request->kota;
            $rekanan_child->ppn = 10;
            $rekanan_child->survey_status = 1;
            $rekanan_child->survey_date = date("Y-m-d H:i:s",strtotime($request->survey_date));
            $rekanan_child->siup_no = $request->siup_no;
            $rekanan_child->siup_image = $siup_file;
            $rekanan_child->gabung_date = date("Y-m-d H:i:s");
            $rekanan_child->description = "Disurvey oleh ".$request->survey_name;
            $rekanan_child->saksi_name = $request->contact_name;
            $rekanan_child->saksi_jabatan = $request->contact_position;
            $rekanan_child->pkp_status = $pkp_status;
            $rekanan_child->save();

        }elseif ( count($rekanan_group->rekanans) == 1 ){
            foreach ($rekanan_group->rekanans as $key2 => $value2) {
                $rekanan_child = Rekanan::find($value2->id);
                $rekanan_child->name = $request->name;
                $rekanan_child->surat_alamat = $request->alamat;
                $rekanan_child->surat_kota = $request->kota;
                $rekanan_child->ppn = 10;
                $rekanan_child->survey_status = 1;
                $rekanan_child->survey_date = date("Y-m-d H:i:s",strtotime($request->survey_date));
                $rekanan_child->siup_no = $request->siup_no;
                $rekanan_child->siup_image = $siup_file;
                $rekanan_child->gabung_date = date("Y-m-d H:i:s");
                $rekanan_child->description = "Disurvey oleh ".$request->survey_name;
                $rekanan_child->saksi_name = $request->contact_name;
                $rekanan_child->saksi_jabatan = $request->contact_position;
                $rekanan_child->pkp_status = $pkp_status;
                $rekanan_child->save();
            }
        }

        return redirect("/tender/rekanan/referensi?id=".$request->tender_id);
    }

    public function aanwijing(Request $request){
        $tender = Tender::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::aanwijing",compact("user","tender","project"));
    }

    public function saveannwijing(Request $request){
        $tender_aanwijing = new TenderAanwijings;
        $tender_aanwijing->tender_id = $request->tender_id;
        $tender_aanwijing->tanggal = date("Y-m-d");
        $tender_aanwijing->waktu = date("H:i:s.u");
        $tender_aanwijing->tempat = $request->tempat;
        $tender_aanwijing->masa_pelaksanaan  = $request->masa_pelaksaan;
        $tender_aanwijing->masa_penawaran = $request->masa_pemeliharaan;
        $tender_aanwijing->jaminan_penawaran = $request->jaminan_penawaran;
        $tender_aanwijing->jaminan_pelaksanaan = $request->jaminan_pelaksanaan;
        $tender_aanwijing->denda = $request->denda;
        $tender_aanwijing->created_by = \Auth::user()->id;
        $tender_aanwijing->save();

        if ( $request->termyn != "" ){
            foreach ($request->termyn as $key => $value) {
                if ( $request->termyn[$key] != "" ){
                    $spk_termyn = new SpkTermyn;
                    $spk_termyn->tender_id = $request->tender_id;
                    $spk_termyn->termin = $request->termyn[$key];
                    $spk_termyn->progress = 0;
                    $spk_termyn->save();
                }
            }
        }

        if ( $request->percent != "" ){
            foreach ($request->percent as $key => $value) {
                if ( $request->percent[$key] != "" ){
                    $spk_retensi = new SpkRetensi;
                    $spk_retensi->tender_id = $request->tender_id;
                    $spk_retensi->percent = $request->percent[$key] / 100;
                    $spk_retensi->hari = $request->waktu[$key];
                    $spk_retensi->save();
                }
            }
        }

        return redirect("/tender/aanwijing/detail?id=".$tender_aanwijing->id);
    }

    public function showaanwijing(Request $request){
        $aanwijing = TenderAanwijings::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::show_aanwijing",compact("user","project","aanwijing"));
    }

    public function updateaanwijing(Request $request){
        $tender_aanwijing = TenderAanwijings::find($request->aanwijing);
        $tender_aanwijing->tender_id = $request->tender_id;
        $tender_aanwijing->tanggal = date("Y-m-d");
        $tender_aanwijing->waktu = date("H:i:s.u");
        $tender_aanwijing->tempat = $request->tempat;
        $tender_aanwijing->masa_pelaksanaan  = $request->masa_pelaksaan;
        $tender_aanwijing->masa_penawaran = $request->masa_pemeliharaan;
        $tender_aanwijing->jaminan_penawaran = $request->jaminan_penawaran;
        $tender_aanwijing->jaminan_pelaksanaan = $request->jaminan_pelaksanaan;
        $tender_aanwijing->denda = $request->denda;
        $tender_aanwijing->created_by = \Auth::user()->id;
        $tender_aanwijing->save();

        return redirect("/tender/aanwijing/detail?id=".$tender_aanwijing->id);
    }

    public function berita_acara(Request $request){
        $tender = Tender::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $step = $request->step;
        return view("tender::berita_acara",compact("tender","user","project","step"));
    }

    public function saveberita_acara(Request $request){
        $tender_berita_acara = new TenderBeritaAcaras;
        $tender_berita_acara->tender_id = $request->tender_id;
        $tender_berita_acara->resume = $request->title;
        $tender_berita_acara->step = $request->step;
        $tender_berita_acara->content = $request->editor1;
        $tender_berita_acara->save();
        return redirect("tender/berita_acara/show?id=".$tender_berita_acara->id);

    }

    public function showberita_acara(Request $request){
        $berita_acara = TenderBeritaAcaras::find($request->id);      
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("tender::show_berita_acara",compact("user","project","berita_acara"));
    }

    public function updberita_acara(Request $request){
        $tender_berita_acara = TenderBeritaAcaras::find($request->berita_acara);
        $tender_berita_acara->resume = $request->title;
        $tender_berita_acara->content = $request->editor1;
        $tender_berita_acara->save();

        return redirect("tender/berita_acara/show?id=".$tender_berita_acara->id);
    }

}

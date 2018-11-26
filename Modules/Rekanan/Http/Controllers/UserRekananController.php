<?php

namespace Modules\Rekanan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Rekanan\Entities\RekananGroup;
use Modules\Country\Entities\City;
use Modules\Rekanan\Entities\Rekanan;
use Modules\Globalsetting\Entities\Globalsetting;
use Modules\Tender\Entities\Tender;
use Modules\Tender\Entities\TenderDetail;
use Modules\Tender\Entities\TenderRekanan;
use Modules\Tender\Entities\TenderPenawaran;
use Modules\Tender\Entities\TenderPenawaranDetail;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Project\Entities\Project;

class UserRekananController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        $rekanan = $rekanan_group->rekanans->where("parent_id",null);
        return view('rekanan::user.index',compact("rekanan_group","rekanan"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('rekanan::create');
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
    public function show()
    {
        return view('rekanan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('rekanan::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $rekanangroup = RekananGroup::find($request->rekanan_group_id);
        $rekanangroup->npwp_alamat = $request->alamat;
        $rekanangroup->cp_name = $request->cp_name;
        $rekanangroup->cp_jabatan = $request->cp_jabatan;
        $rekanangroup->saksi_name = $request->saksi_name;
        $rekanangroup->saksi_jabatan = $request->saksi_jabatan;
        $rekanangroup->save();

        $target_file = "./assets/rekanan/".$request->rekanan_group_id."/".$_FILES['siup_img']['name'];
        move_uploaded_file($_FILES["siup_img"]["tmp_name"], $target_file);
        $rekanan = Rekanan::find($request->rekanan_id);
        $rekanan->surat_kota = $rekanangroup->npwp_kota;
        $rekanan->surat_alamat = $request->alamat;
        $rekanan->email = $request->email;
        $rekanan->surat_kodepos = $request->kodepos;
        $rekanan->email = $request->email;
        $rekanan->telp = $request->telpon; 
        $rekanan->fax = $request->fax;
        $rekanan->siup_no = $request->siup;
        
        if ( $_FILES['siup_img']['name'] == "" ){
            $rekanan->siup_image = $rekanan->siup_image;
        }else{
            $rekanan->siup_image = $_FILES['siup_img']['name'];
        }

        $rekanan->cp_name = $request->cp_name;
        $rekanan->cp_jabatan = $request->cp_jabatan;
        $rekanan->saksi_name = $request->saksi_name;
        $rekanan->saksi_jabatan = $request->saksi_jabatan;
        $rekanan->save();
        return redirect("/rekanan/user");
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function fail()
    {
        return view("auth/fail");
    }

    public function contact(Request $request){
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        return view("rekanan::user.contact",compact("rekanan_group"));
    }

    public function storecontact(Request $request){
        $rekanan_group = RekananGroup::find($request->rekanan_group_id);
        $rekanan_group->cp_name = $request->cp_name;
        $rekanan_group->cp_jabatan = $request->cp_jabatan;
        $rekanan_group->saksi_name = $request->saksi_name;
        $rekanan_group->saksi_jabatan = $request->saksi_jabatan;
        $rekanan_group->save();

        return redirect("/rekanan/user/contact");
    }

    public function cabang(Request $request){
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        $city = City::get();
        return view("rekanan::user.cabang",compact("rekanan_group","city"));
    }

    public function savecabang(Request $request){
        $ppn = 0;
        $global_ppn = Globalsetting::where("parameter","ppn")->get();
        
        if ( count($global_ppn) > 0 ){
            $ppn = $global_ppn->first()->value;
        }

        $rekanan_group = RekananGroup::find($request->rekanan_group_id);
        if ( $rekanan_group->pkp_status == "2"){
            $coa_ppn = 10;
        }
        $rekanan = new Rekanan;
        $rekanan->kelas_id = 1;
        $rekanan->rekanan_group_id = $request->rekanan_group_id;
        $rekanan->surat_kota = $request->kota;
        $rekanan->name = $request->name;
        $rekanan->surat_alamat = $request->alamat;
        $rekanan->surat_kodepos = $request->kodepost;
        $rekanan->email = $request->email;
        $rekanan->telp = $request->telepon;
        $rekanan->fax = $request->fax;
        $rekanan->cp_name = $request->cp_name;
        $rekanan->cp_jabatan = $request->cp_jabatan;
        $rekanan->saksi_name = $request->saksi_name;
        $rekanan->saksi_jabatan = $request->saksi_jabatan;
        $rekanan->ppn = $ppn;
        $rekanan->pkp_status = $rekanan_group->coa_ppn;
        $rekanan->save();
        return redirect("rekanan/user/cabang");

    }

    public function pricelist(Request $request){
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        return view("rekanan::user.price_list",compact("rekanan_group"));
    }

    public function tender(Request $request){
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        return view("rekanan::user.tender",compact("rekanan_group"));
    }

    public function tender_detail(Request $request){
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        $tender_rekanan = TenderRekanan::find($request->id);
        $tender = $tender_rekanan->tender;
        $tanggal_sekarang = date("Y-m-d H:i:s");
        return view("rekanan::user.tender_detail",compact("rekanan_group","tender","tanggal_sekarang","tender_rekanan"));
    }

    public function addpenawaran(Request $request){
        $rekanan = TenderRekanan::find($request->id);
        $rab = $rekanan->tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        return view("rekanan::user.detail_rab",compact("rab","itempekerjaan","rekanan","user","project","rekanan_group"));
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

        return redirect("/rekanan/user/tender/detail/?id=".$tenderrekaann->tender->id); 
    }

    public function step2(Request $request){
        $tenderpenawaran = TenderPenawaran::find($request->id);
        $tenderRekanan = $tenderpenawaran->rekanan;
        $rab = $tenderRekanan->tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $penawaran_id = "";
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        foreach ($tenderRekanan->penawarans as $key => $value) {
            if ( $value->updated_by == null ) {
                $penawaran_id = $value->id;
            }
        }

        return view("rekanan::user.detail_penawaran2",compact("rab","itempekerjaan","rekanan","user","project","tenderpenawaran","tenderRekanan","penawaran_id","rekanan_group"));
    }

    public function step3(Request $request){
        $tenderpenawaran = TenderPenawaran::find($request->id);
        $tenderRekanan = $tenderpenawaran->rekanan;
        $rab = $tenderRekanan->tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $penawaran_id = "";
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        foreach ($tenderRekanan->penawarans as $key => $value) {
            if ( $value->updated_by == null ) {
                $penawaran_id = $value->id;
            }
        }

        return view("rekanan::user.detail_penawaran3",compact("rab","itempekerjaan","rekanan","user","project","tenderpenawaran","tenderRekanan","penawaran_id","rekanan_group"));
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
        return redirect("/rekanan/user/tender/detail/?id=".$TenderPenawaran->rekanan->id);
    }

    public function addstep3(Request $request){
        $tender = Tender::find($request->id);
        $rab = $tender->rab;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        return view("rekanan::user.detail_step3",compact("tender","itempekerjaan","user","project","rekanan_group"));
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
        return redirect("/rekanan/user/tender/detail/?id=".$tenderPenawaran->rekanan->id);
    }

    public function viewstep1(Request $request){
        
    }

    public function step1(Request $request){
        $tenderpenawaran = TenderPenawaran::find($request->id);
        $tenderRekanan = $tenderpenawaran->rekanan;
        $rab = $tenderRekanan->tender->rab;
        $itempekerjaan = Itempekerjaan::find($rab->parent_id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $penawaran_id = "";
        $rekanan_group = RekananGroup::find($request->session()->get('rekanan_id'));
        foreach ($tenderRekanan->penawarans as $key => $value) {
            if ( $value->updated_by == null ) {
                $penawaran_id = $value->id;
            }
        }

        return view("rekanan::user.detail_penawaran1",compact("rab","itempekerjaan","rekanan","user","project","tenderpenawaran","tenderRekanan","penawaran_id","rekanan_group"));
    }

    public function updatepenawaran1(Request $request){
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
        return redirect("/rekanan/user/tender/detail/?id=".$TenderPenawaran->rekanan->id);
    }
}

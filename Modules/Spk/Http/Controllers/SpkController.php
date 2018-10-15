<?php

namespace Modules\Spk\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Tender\Entities\TenderMenang;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Project\Entities\Project;
use Modules\Spk\Entities\Spk;
use Modules\Spk\Entities\SpkvoUnit;
use Modules\Spk\Entities\SpkDetail;
use Modules\Spk\Entities\SpkTermyn;
use Modules\Spk\Entities\SpkTermynDetail;
use Modules\Spk\Entities\SpkPengembalian;
use Modules\Spk\Entities\SpkRetensi;
use Modules\Spk\Entities\SpkType;
use Modules\Project\Entities\UnitProgress;
use Modules\Spk\Entities\Suratinstruksi;
use Modules\Spk\Entities\Vo;
use Modules\Spk\Entities\Bap;
use Modules\Spk\Entities\BapDetail;
use Modules\Spk\Entities\BapDetailItempekerjaan;
use Modules\Spk\Entities\BapPph;
use Modules\Rekanan\Entities\Rekening;
use Modules\Tender\Entities\Tender;
use Modules\Spk\Entities\SuratInstruksiItem;
use Modules\Spk\Entities\SuratInstruksiUnit;
use Modules\Tender\Entities\TenderUnit;
use Modules\Rab\Entities\RabUnit;
use Modules\User\Entities\User;

class SpkController extends Controller
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
        return view('spk::index',compact("user","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {   

        $tender = Tender::find($request->id);
        if ($tender->rab->flow === 0) 
        {
            $no =  \App\Helpers\Document::new_number('IL', $tender->rab->workorder->department_from);
            $is_instruksilangsung = TRUE;
        }else{
            $no = \App\Helpers\Document::new_number('SPK', $tender->rab->workorder->department_from);
            $is_instruksilangsung = FALSE;
        }

        $itempekerjaan = Itempekerjaan::find($tender->rab->parent_id);

        $spk = new Spk;
        $spk->project_id = $tender->project->id;
        $spk->no = $no.$tender->rab->budget_tahunan->budget->pt->code;
        $spk->rekanan_id = $tender->menangs->first()->tender_rekanan->rekanan->id;
        $spk->tender_rekanan_id = $tender->menangs->first()->tender_rekanan->id;
        $spk->name = $itempekerjaan->name;
        $spk->is_instruksilangsung = $is_instruksilangsung;
        $spk->start_date = date("Y-m-d H:i:s");
        $spk->created_by = \Auth::user()->id;
        $spk->coa_pph_default_id =  $tender->menangs->first()->tender_rekanan->rekanan->group->pph_percent;
        $spk->save();

        /* Save Unit */
        foreach ($tender->units as $key => $value) {
            $spkdetail = new SpkDetail;
            $spkdetail->spk_id = $spk->id;
            $spkdetail->asset_id = $value->rab_unit->asset_id;
            $spkdetail->asset_type = $value->rab_unit->asset_type;
            $spkdetail->created_by = \Auth::user()->id;
            $spkdetail->save();


            $tender_menang = $tender->menangs->first();
            foreach ($tender_menang->tender_rekanan->penawarans->last()->details as $key2 => $value2) {
            $unit_progress = \Modules\Project\Entities\UnitProgress::where('unit_id', $value->asset_id )->where('unit_type', $value->asset_type )->where('itempekerjaan_id', $value2->itempekerjaan_id )->first();
            if ( $unit_progress == NULL ){
                $unit_progress = new UnitProgress;
                $unit_progress->project_id = $tender->project->id;
                $unit_progress->unit_id = $value->id;
                $unit_progress->unit_type = $value->rab_unit->asset_type;
                $unit_progress->itempekerjaan_id = $value2->rab_pekerjaan->itempekerjaan_id;
                $unit_progress->urutitem = $key2+1;
                $unit_progress->termin = $key2+1;
                $unit_progress->is_pembangunan = TRUE;
                $unit_progress->progresslapangan_percent = 0;
                $unit_progress->progressbap_percent = 0;
                $unit_progress->nilai = $value2->nilai;
                $unit_progress->volume = $value2->volume;
                $unit_progress->satuan = $value2->satuan;
                $unit_progress->save();

                    $SpkvoUnit = new SpkvoUnit;
                    $SpkvoUnit->head_id = $spk->id;
                    $SpkvoUnit->spk_detail_id = $spkdetail->id;
                    $SpkvoUnit->head_type = "Modules\Spk\Entities\Spk";
                    $SpkvoUnit->unit_progress_id = $unit_progress->id;
                    $SpkvoUnit->nilai = $value2->nilai;
                    $SpkvoUnit->volume = $value2->volume;
                    $SpkvoUnit->satuan = $value2->satuan;
                    $SpkvoUnit->ppn = $value2->rab_pekerjaan->itempekerjaan->ppn;
                    $SpkvoUnit->save();  
                }
            }
        }

        /* Save Pekerjaan */
        foreach ($tender->menangs as $key6 => $value6) {
            $tender_menang = TenderMenang::find($value6->id);
            $project = $tender->project;
            foreach ($value6->tender_rekanan->first()->penawarans->last()->details as $key2 => $value2) {
                # code...
                
                              
            }            
        }

        /* Save Progress */
        $termyn = array();
        $item_progress = $spk->progresses->last()->itempekerjaan->item_progress;
        if ( count($item_progress) > 0 ){
            foreach ($item_progress as $key => $value) {
                $termyn[$key] = "0";
            }
            
            if ( count($spk->list_pekerjaan) > 0 ){
                foreach ($spk->list_pekerjaan as $key => $value) {
                    foreach ($value['termyn'] as $key2 => $value2) {
                        $termyn[$key2] = $termyn[$key2] + round( ( $value2 * $value['bobot_coa'] ) / 100 , 2);
                    }
                }
            }

            $spk_termyn = new SpkTermyn;
            $spk_termyn->spk_id = $spk->id;
            $spk_termyn->termin = 0; 
            $spk_termyn->progress = 0 ;        
            $spk_termyn->status = 1 ;        
            $spk_termyn->save();

            foreach ($termyn as $key => $value) {
                $spk_termyn = new SpkTermyn;
                $spk_termyn->spk_id = $spk->id;
                $spk_termyn->termin = $key + 1 ; 
                $spk_termyn->progress = $termyn[$key] ;
                $spk_termyn->status = 0 ;
                $spk_termyn->save();
            }
        }
        return redirect("/spk/detail?id=".$spk->id);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $tender_menang = TenderMenang::find($request->id);
        $detail = $tender_menang->details;
        
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $spk = Spk::find($request->id);
        $spktype = SpkType::get();
        $progress = $spk->progresses->first()->itempekerjaan->item_progress;
        $termyn = array();
        $ttd_pertama = "";
        $ttd_kedua = "";
        $tmp_ttd_pertama = array();
        $start = 0;
        foreach ($progress as $key => $value) {
            $termyn[$key] = 0 ;
        }

        if ( $spk->approval != "" ){
            $ttd_pertama = $spk->approval->histories->min("no_urut");
            foreach ($spk->approval->histories as $key => $value) {
                $user = User::find($value->user_id);
                $max = $user->approval_reference;
                foreach ($user->approval_reference as $key2 => $value2) {
                    if ( $value2->max_value <= $spk->nilai && $value2->project_id == $spk->project->id && $value2->document_type == "Spk"){
                        $tmp_ttd_pertama[$value2->user_id] = array( "level" => $value2->no_urut, "user_name" => ucwords($value2->user->user_name), "user_jabatan" => ucwords($value2->user->jabatan[0]["jabatan"]) );
                        $start++;
                    }
                }
            }
            $ttd_pertama = min($tmp_ttd_pertama);
        }


        return view('spk::create',compact("itempekerjaan","tender_menang","project","user","spk","spktype","termyn","ttd_pertama","tmp_ttd_pertama"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function editdate(Request $request)
    {
        $spk = Spk::find($request->spk_id);
        //$spk->start_date = date_format(date_create($request->start_date),"Y-m-d");
        $spk->finish_date = date_format(date_create($request->end_date),"Y-m-d");
        $spk->st_1 = date_format(date_create($request->end_date),"Y-m-d");
        $spk->coa_pph_default_id = $request->coa_pph;
        $spk->save();
        return redirect("/spk/detail?id=".$request->spk_id);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $spk = Spk::find($request->spk_id);
        $spk->start_date = $request->start_date;
        $spk->finish_date = $request->end_date;
        $spk->st_1 = $request->end_date;
        $spk->save();
        return redirect("/spk/detail?id=".$spk->id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function editpayment(Request $request){
        $spk = Spk::find($request->spk_id);
        if ( $request->denda_a != "" ){            
            $spk->denda_a = str_replace(",","",$request->denda_a);
        }

        if ( $request->denda_b != "" ){
            $spk->denda_b = str_replace(",","",$request->denda_b);
        }
        $spk->matauang = $request->matauang;
        $spk->nilai_tukar = $request->nilai_tukar;
        $spk->jenis_kontrak = $request->jenis_kontrak;
        $spk->memo_cara_bayar = $request->memo_cara_bayar;
        $spk->memo_lingkup_kerja = $request->memo_lingkup_kerja;
        $spk->carapembayaran = $request->carapembayaran;
        $spk->garansi_nilai = $request->garansi_nilai;
        $spk->coa_pph_default_id = $request->coa_pph;
        $spk->save();
        return redirect("/spk/detail?id=".$request->spk_id);
    }

    public function termyn (Request $request){

        /*foreach ($request->termyn as $key => $value) {
            $spk_termyn = new SpkTermyn;
            $spk_termyn->spk_id = $request->spk_termin_id;
            $spk_termyn->termin = $key + 1 ;
            $spk_termyn->progress = $request->termyn[$key];
            if ( $key == 0 ){
                $spk_termyn->status = 1 ;
            }
            $spk_termyn->save();
        }*/
        $termyn = array();
        $spk = Spk::find($request->spk_termin_id);
        $item_progress = $spk->progresses->last()->itempekerjaan->item_progress;
        foreach ($item_progress as $key => $value) {
            $termyn[$key] = "0";
        }
        
        $progress = $spk->progresses;
        foreach ($progress as $key => $value) {
            foreach ($value->itempekerjaan->item_progress as $key2 => $value2) {
                if ( $value2->percentage == null ){
                    $termyn[$key2] = $termyn[$key2] + 0;
                }else{
                    $termyn[$key2] = $termyn[$key2] + $value2->percentage;
                }
            }
        }
        foreach ($termyn as $key3 => $value3) {
            $termyn[$key3] = $termyn[$key3] / $spk->details->count();
            $spk_termyn = new SpkTermyn;
            $spk_termyn->spk_id = $request->spk_termin_id;
            $spk_termyn->termin = $key3; 
            $spk_termyn->progress = $termyn[$key3] ;
            if ( $key3 == 0 ){
                $spk_termyn->status = 1 ;
            }
            $spk_termyn->save();
        }
        
        return redirect("/spk/detail?id=".$request->spk_termin_id);
    }

    public function approval(Request $request){
        $budget = $request->id;
        $class  = "Spk";
        $approval = \App\Helpers\Document::make_approval('Modules\Spk\Entities\Spk',$budget);
        return response()->json( ["status" => "0"] );
    }

    public function termyndetail(Request $request){

        $spk = Spk::find($request->spk_termin_id);
        foreach ($spk->termyn as $key => $value) {
            $spk_termyn = new SpkTermynDetail;
            $spk_termyn->spk_termyn_id = $value->id;
            $spk_termyn->item_pekerjaan_id = $request->item_id ;
            $spk_termyn->percentage = $request->termyn[$key];
            $spk_termyn->termyn = $key + 1 ;
            $spk_termyn->created_by = \Auth::user()->id;
            $spk_termyn->save();
        }
        return redirect("/spk/detail?id=".$spk->id);
    }

    public function updatetermyn(Request $request){
        return response()->json( ["status" => "0"]);
    }

    public function addbap(Request $request){
        $spk = Spk::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        if ( $spk->baps->count() == "0" ){
            $nilai_sebelumnya = 0;
        }else{
            $nilai_sebelumnya = $spk->baps->last()->nilai_bap_3 ;
        }
        
        if ( $spk->rekanan->ppn != null ){
            $ppn = $spk->rekanan->ppn / 100;
        }else{
            $ppn  = 0;
        }

        return view("spk::create_bap",compact("project","user","spk","nilai_sebelumnya","ppn"));
    }

    public function savebap(Request $request){
        $spk = Spk::find($request->spk_bap);

        $bap_no = $spk->no . '/BAP/' . str_pad( ($spk->baps()->count() + 1) , 2, "0", STR_PAD_LEFT);        
        $progress_bayar = $spk->nilai_bap_sekarang / ($spk->nilai) ;
        $total = $spk->bap + $progress_bayar;


        $bap = new Bap;
        $bap->spk_id = $spk->id;
        $bap->date = date("Y-m-d");
        $bap->termin = $request->spk_bap_termin;
        $bap->no = $bap_no;
        $bap->nilai_administrasi = $request->admin;
        $bap->nilai_denda = $request->denda;
        $bap->nilai_selisih = $request->selisih;
        $bap->nilai_dp = $spk->nilai_pengembalian;
        $bap->nilai_bap_1 = $request->nilai_bap_1;
        $bap->nilai_bap_2 = $request->nilai_bap_2;
        $bap->nilai_bap_3 = $request->nilai_bap_3;
        $bap->percentage = $request->percentage;
        $bap->percentage_lapangan = $request->percentage_lapangan;
        $bap->percentage_sebelumnyas = $request->percentage_sebelumnya;
        $bap->nilai_bap_dibayar = $request->nilai_bap_dibayar;
        $bap->nilai_retensi = $request->nilai_retensi;
        $bap->nilai_talangan = $request->talangan;
        $bap->status_voucher = 0;
        $bap->nilai_vo = $request->bap_vo;
        $bap->created_by = \Auth::user()->id;
        $bap->save();

        foreach ($spk->details as $key3 => $value3) {
            $detail                    = new BapDetail;
            $detail->bap_id            = $bap->id;
            $detail->asset_id          = $value3->asset_id;
            $detail->asset_type        = $value3->asset_type;
            $status = $detail->save();

            foreach ($value3->details as $key4 => $value4) {
                $bap_detail_itempekerjaan                       = new BapDetailItempekerjaan;
                $bap_detail_itempekerjaan->bap_detail_id        = $detail->id;
                $bap_detail_itempekerjaan->itempekerjaan_id     = $value4->unit_progress->itempekerjaan_id;
                $bap_detail_itempekerjaan->spkvo_unit_id        = $value4->unit_progress->spkvo_unit->id;
                $bap_detail_itempekerjaan->terbayar_percent     = $total * 100 ;
                $bap_detail_itempekerjaan->lapangan_percent     = $value4->unit_progress->progresslapangan_percent  / 100;
                $bap_detail_itempekerjaan->save();
            }
        }
        
        foreach ($spk->progresses as $key => $value) {
            $unit = UnitProgress::find($value->id);
            $unit->progressbap_percent = $total * 100 ;
            $unit->save();
        }
        

        $nilai = 0;
        $total_termun = 0;
        $start = 0;
        $total_progress = $spk->progresses->sum('progresslapangan_percent') ;
        $lapangan = $spk->lapangan;

        foreach ($spk->termyn as $key => $value) {

            $total_termun = $total_termun + $value->progress;
            if ( $total_termun == $lapangan ){
                //return $total_termun;
            }

            elseif ( $total_termun <= $lapangan){
                $start = $key ;
                $spk_termyn = SpkTermyn::find($value->id);
                $spk_termyn->status = "3";
                $spk_termyn->save();            
            }
        }
        
        if ( $total_progress >= 100 ){
            foreach ( $spk->dp_pengembalians as $key2 => $value2 ) {                       
                $spkpengembalian = SpkPengembalian::find($value2->id);
                $spkpengembalian->status = "1";
                $spkpengembalian->save();      
            }
        }else{

            /*if ( $this->spk_real_termyn > ){
                
            }*/
            foreach ( $spk->dp_pengembalians->take($spk->baps->count())->where("status",0) as $key2 => $value2 ) {                       
               $spkpengembalian = SpkPengembalian::find($value2->id);
               $spkpengembalian->status = "1";
               $spkpengembalian->save();      
            }
        }

        
        //die;
        return redirect("/spk/detail?id=".$request->spk_bap);
    }

    public function detailbap(Request $request){
        $bap = Bap::find($request->id);
        $spk = $bap->spk;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
         if ( $spk->rekanan->ppn != null ){
            $ppn = $spk->rekanan->ppn / 100;
        }else{
            $ppn  = 0;
        }
        return view("spk::detail_bap",compact("project","user","spk","bap","ppn"));
    }

    public function addvoucher(Request $request){
        $bap = Bap::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("spk::create_voucher",compact("project","user","bap"));
    }

    public function updatedp(Request $request){
        $spk = Spk::find($request->spk_id);
        $spk->dp_percent = $request->dp_percent;
        $spk->spk_type_id = $request->dp_type;
        $spk->save();
        return redirect("/spk/detail?id=".$spk->id);
    }

    public function savedptermin(Request $request){
        $nilai = 0;
        foreach ($request->termyn as $key => $value) {
            if ( $request->termyn[$key] != "" ){                
                $spkpengembaliandp = new SpkPengembalian;
                $spkpengembaliandp->spk_id = $request->spk_id_dp;
                $spkpengembaliandp->termin = $key + 1;
                $spkpengembaliandp->percent = $request->termyn[$key] - $nilai ;
                $spkpengembaliandp->save();
                $nilai = $request->termyn[$key] ;
            }
        }

        return redirect("/spk/detail?id=".$request->spk_id_dp);
        
    }

    public function saveretensis(Request $request){
        $retensi = new SpkRetensi;
        $retensi->spk_id = $request->spk_id;
        $retensi->percent = $request->retensi / 100;
        $retensi->hari = $request->hari;
        $retensi->is_progress = 1;
        $retensi->save();

        
        $spk = Spk::find($request->spk_id);        
        $spk->st_2 = date('Y-m-d', strtotime('+'.$request->hari.' day', strtotime($spk->st_1)));
        $spk->save();

        if ( count($spk->retensis) > 1 ){
            $spk = Spk::find($request->spk_id);
            $spk->st_3 = date('Y-m-d', strtotime('+'.$request->hari.' day', strtotime($spk->st_1)));
            $spk->save();
        }

        return redirect("/spk/detail?id=".$request->spk_id);
    }

    public function saveprogress(Request $request){
        $spk_progress = Spk::find($request->spk_id);
        $spk_progress->pic_id = $request->min_progress_dp;
        $spk_progress->save();
        return redirect("/spk/detail?id=".$request->spk_id);
    }

    public function deleteretensi(Request $request){
        $spk_retensi = SpkRetensi::find($request->id);
        $spk_retensi->delete();
        return response()->json( ["status" => "0"] );
    }

    public function approval_history(Request $request){
        $spk = Spk::find($request->id);
        $approval = $spk->approval;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("spk::approval_history",compact("project","user","spk","approval"));
    }

    public function createsik(Request $request){
        $spk = Spk::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("spk::create_sik",compact("user","project","spk"));
    }

    public function storesik(Request $request){        
        $spk = Spk::find($request->spk_id);
        $number = \App\Helpers\Document::new_number('SIK', $spk->tender->rab->workorder->department_from).$spk->tender->rab->budget_tahunan->budget->pt->code;
        $suratinstruksi = new Suratinstruksi;
        $suratinstruksi->spk_id = $request->spk_id;
        $suratinstruksi->no = $number;
        $suratinstruksi->date = date("Y-m-d H:i:s");
        $suratinstruksi->perihal = $request->perihal;
        $suratinstruksi->content = $request->content;
        $suratinstruksi->type = "sil";
        $suratinstruksi->save();

        
        return redirect("spk/sik-show?id=".$suratinstruksi->id);
    }

    public function showsik(Request $request){
        $suratinstruksi = Suratinstruksi::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $arrayparam = array("+" => array("label" => "Pekerjaan Tambah", "class" => "label label-success"), "-" => array("label" => "Pekerjaan Kurang", "class" => "label label-danger"));
        return view("spk::show_sik",compact("user","project_id","suratinstruksi","user","project","arrayparam"));
    }

    public function createvo(Request $request){
        $suratinstruksi = Suratinstruksi::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("spk::add_vo",compact("user","project","suratinstruksi"));
    }

    public function storevo(Request $request){
        $sik = Suratinstruksi::find($request->sik_id);
        $vo_count = $sik->spk->vos()->count();
        
        foreach ($request->vo_unit_ as $key => $value) {
            $spkvo_units                        = new SpkvoUnit;
            $spkvo_units->spk_detail_id         = $request->vo_unit_[$key];
            $spkvo_units->head_id               = $variation_order->id;
            $spkvo_units->head_type             = 'Modules\Spk\Entities\Vo';
            $spkvo_units->templatepekerjaan_id  = "";
            $spkvo_units->unit_progress_id      = "";
            $spkvo_units->save();
        }
    }

    public function detailunitvo(Request $request){
        $spkdetail    = SpkDetail::find($request->id);
        $unitprogress = $spkdetail->details_with_vo;
        $html         = "";
        $html         .= "<tr>";
        $html         .= "<td colspan='4'>Unit : <strong>".$spkdetail->asset->name."</strong><input type='hidden' value='".$spkdetail->id."' name='spk_detail_id'/></td>";
        $html         .= "</tr>";
        foreach ($unitprogress as $key => $value) {
            $rab     = \Modules\Rab\Entities\RabPekerjaan::where("itempekerjaan_id",$value->unit_progress->itempekerjaan_id)->get();
            $html    .= "<tr>";
            $html    .= "<td>".$value->unit_progress->itempekerjaan->name."</td>";
            $html    .= "<td>
                            <input type='hidden' value='".($value->unit_progress->id)."' name='unit_progress_id[".$key."]' class='form-control'/>
                            <input type='text' value='".number_format($value->unit_progress->volume)."' name='unit_progress[".$key."]' class='form-control' required/>
                        </td>";
            $html    .= "<td>".$rab->first()->satuan."</td>";
            $html    .= "<td><input type='text' value='".number_format($value->unit_progress->nilai)."' name='unit_progress_nilai[".$key."]' class='form-control' required/></td>";
            $html    .= "</tr>";
        }

        return response()->json( ["status" => "0", "html" => $html] );
    }

    public function savevo(Request $request){
        $spk_detail = SpkDetail::find($request->spk_detail);
        $sik = Suratinstruksi::find($request->suratinstruksi);
        $vo_count = $sik->vos->count();

        $SuratInstruksiUnit = new SuratInstruksiUnit;
        $SuratInstruksiUnit->suratinstruksi_id = $request->suratinstruksi;
        $SuratInstruksiUnit->unit_id = $request->spk_detail;
        $SuratInstruksiUnit->created_by = \Auth::user()->id;
        $SuratInstruksiUnit->save();

        $variation_order                            = new Vo;
        $variation_order->suratinstruksi_id         = $request->suratinstruksi;
        $variation_order->suratinstruksi_unit_id    = $SuratInstruksiUnit->id;
        $variation_order->no                        = $sik->spk->no .'/VO/'. str_pad( $vo_count + 1 ,2,"0",STR_PAD_LEFT).$sik->spk->tender->rab->budget_tahunan->budget->pt->code;
        $variation_order->date                      = date("Y-m-d H:i:s");
        $variation_order->urutan                    = null;
        $variation_order->description               = $request->description;
        $variation_order->save();

        foreach ($request->unit_progress_id as $key => $value) {
            if ( $request->volume_[$key] != "" && $request->nilai_[$key] != "" ){       
                $progress = UnitProgress::find($request->unit_progress_id[$key]);

                $newunitprogress = new UnitProgress;
                $newunitprogress->project_id = $spk_detail->spk->project_id;
                $newunitprogress->unit_id = $progress->unit_id;
                $newunitprogress->unit_type = $progress->unit_type;
                $newunitprogress->itempekerjaan_id = $request->itempekerjaan[$key];
                $newunitprogress->group_tahapan_id = $key;
                $newunitprogress->group_item_id = $key;
                $newunitprogress->urutitem = $progress->urutitem;
                $newunitprogress->termin = $progress->termin;
                $newunitprogress->nilai = str_replace(",", "", $request->nilai_[$key]);
                $newunitprogress->volume = str_replace(",", "",$request->volume_[$key]);
                $newunitprogress->satuan = $progress->satuan;
                $newunitprogress->durasi = $progress->durasi;
                $newunitprogress->is_pembangunan = $progress->is_pembangunan;
                $newunitprogress->progresslapangan_percent = 0;
                $newunitprogress->progressbap_percent = 0;
                $newunitprogress->mulai_jadwal_date = date("Y-m-d H:i:s");
                $newunitprogress->selesai_jadwal_date = null;
                $newunitprogress->save();

                $SpkvoUnit = new SpkvoUnit;
                $SpkvoUnit->head_id = $variation_order->id;
                $SpkvoUnit->spk_detail_id = $spk_detail->id;
                $SpkvoUnit->head_type = "Modules\Spk\Entities\Vo";
                $SpkvoUnit->unit_progress_id = $newunitprogress->id;
                $SpkvoUnit->volume = str_replace(",", "", $request->volume_[$key]);
                $SpkvoUnit->nilai = str_replace(",", "", $request->nilai_[$key]);
                $SpkvoUnit->satuan = $request->satuan_[$key];
                $SpkvoUnit->ppn = null;
                $SpkvoUnit->save();  

                $SuratInstruksiItem = new SuratInstruksiItem;
                $SuratInstruksiItem->surat_instruksi_unit_id = $SuratInstruksiUnit->id;
                $SuratInstruksiItem->itempekerjaan_id = $request->itempekerjaan[$key];
                $SuratInstruksiItem->unit_progress_id = $newunitprogress->id;
                $SuratInstruksiItem->created_by = \Auth::user()->id;
                $SuratInstruksiItem->save();

            }
        }
        

        return redirect("spk/sik-unit?id=".$spk_detail->id."&sik=".$sik->id);
    }

    public function setprogress(Request $request){

        /* Save Progress */
        $termyn = array();
        $spk = Spk::find($request->id);
        $item_progress = $spk->progresses->first()->itempekerjaan->item_progress;
        if ( count($item_progress) > 0 ){
            foreach ($item_progress as $key => $value) {
                $termyn[$key] = "0";
            }
            
            if ( count($spk->list_pekerjaan) > 0 ){
                foreach ($spk->list_pekerjaan as $key => $value) {
                    foreach ($value['termyn'] as $key2 => $value2) {
                        $termyn[$key2] = $termyn[$key2] + round( ( $value2 * $value['bobot_coa'] ) / 100 , 2);
                    }
                }
            }

            $spk_termyn = new SpkTermyn;
            $spk_termyn->spk_id = $spk->id;
            $spk_termyn->termin = 0; 
            $spk_termyn->progress = 0 ;        
            $spk_termyn->status = 1 ;        
            $spk_termyn->save();

            foreach ($termyn as $key => $value) {
                $spk_termyn = new SpkTermyn;
                $spk_termyn->spk_id = $spk->id;
                $spk_termyn->termin = $key + 1 ; 
                $spk_termyn->progress = $termyn[$key] ;
                $spk_termyn->status = 0 ;
                $spk_termyn->save();
            }
        }
    }

    public function sikunit(Request $request){
        $spkDetail = SpkDetail::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $suratinstruksi = Suratinstruksi::find($request->sik);
        return view("spk::detail_sik_unit",compact("user","project","spkDetail","suratinstruksi"));
    }

    public function deletevo(Request $request){
        $spkvo_unit_id = SpkvoUnit::find($request->id);
        $unitprogress_id = $spkvo_unit_id->unit_progress;
        $unitprogress = UnitProgress::find($unitprogress_id->id);
        $spkvo_unit_id->delete();
        $unitprogress->delete();
        return response()->json( ["status" => "0"] );
    }
}

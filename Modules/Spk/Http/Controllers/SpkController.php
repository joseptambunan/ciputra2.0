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
use Modules\Project\Entities\UnitProgress;
use Modules\Spk\Entities\SuratInstruksi;
use Modules\Spk\Entities\Vo;
use Modules\Spk\Entities\Bap;
use Modules\Spk\Entities\BapDetail;
use Modules\Spk\Entities\BapDetailItempekerjaan;
use Modules\Spk\Entities\BapPph;

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
        $tender_menang = TenderMenang::find($request->id);
        $project = $tender_menang->tender_rekanan->tender->project;
        $itempekerjaan = Itempekerjaan::find($tender_menang->tender_rekanan->tender->rab->parent_id);
        if ($tender_menang->tender_rekanan->tender->rab->flow === 0) 
        {
            $no =  \App\Helpers\Document::new_number('IL', $tender_menang->tender_rekanan->tender->rab->workorder->department_from);
            $is_instruksilangsung = TRUE;
        }else{
            $no = \App\Helpers\Document::new_number('SPK', $tender_menang->tender_rekanan->tender->rab->workorder->department_from);
            $is_instruksilangsung = FALSE;
        }

        $spk = new Spk;
        $spk->project_id = $tender_menang->tender_rekanan->tender->project->id;
        $spk->no = $no;
        $spk->rekanan_id = $tender_menang->tender_rekanan->rekanan->id;
        $spk->tender_rekanan_id = $tender_menang->tender_rekanan->id;
        $spk->name = $itempekerjaan->name;
        $spk->is_instruksilangsung = $is_instruksilangsung;
        $spk->created_by = \Auth::user()->id;
        $spk->save();

        foreach ($tender_menang->tender->units as $key => $value) {
            $spkdetail = new SpkDetail;
            $spkdetail->spk_id = $spk->id;
            $spkdetail->asset_id = $value->rab_unit->asset_id;
            $spkdetail->asset_type = $value->rab_unit->asset_type;
            $spkdetail->created_by = \Auth::user()->id;
            $spkdetail->save();

            foreach ($tender_menang->details as $key2 => $value2) {
            # code...
                $unit_progress = \Modules\Project\Entities\UnitProgress::where('unit_id', $value->asset_id )->where('unit_type', $value->asset_type )->where('itempekerjaan_id', $value2->itempekerjaan_id )->first();
                if ( $unit_progress == NULL ){
                    $unit_progress = new UnitProgress;
                    $unit_progress->project_id = $project->id;
                    $unit_progress->unit_id = $value->id;
                    $unit_progress->unit_type = $value->rab_unit->asset_type;
                    $unit_progress->itempekerjaan_id = $value->itempekerjaan_id;
                    $unit_progress->urutitem = $key2+1;
                    $unit_progress->termin = $key2+1;
                    $unit_progress->is_pembangunan = TRUE;
                    $unit_progress->progresslapangan_percent = 0;
                    $unit_progress->progressbap_percent = 0;
                    $unit_progress->nilai = $value2->nilai;
                    $unit_progress->volume = $value2->volume;
                    $unit_progress->save();
                }

                $SpkvoUnit = new SpkvoUnit;
                $SpkvoUnit->head_id = $spk->id;
                $SpkvoUnit->spk_detail_id = $spkdetail->id;
                $SpkvoUnit->head_type = "Modules\Spk\Entities\Spk";
                $SpkvoUnit->unit_progress_id = $unit_progress->id;
                $SpkvoUnit->nilai = $value2->nilai;
                $SpkvoUnit->volume = $value2->volume;
                $SpkvoUnit->ppn = $value2->itempekerjaan->ppn;
                $SpkvoUnit->save();
                
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
        return view('spk::create',compact("itempekerjaan","tender_menang","project","user","spk"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function editdate(Request $request)
    {
        $spk = Spk::find($request->spk_id);
        $spk->start_date = date_format(date_create($request->start_date),"Y-m-d");
        $spk->finish_date = date_format(date_create($request->end_date),"Y-m-d");
        $spk->st_1 = date_format(date_create($request->st_1),"Y-m-d");
        $spk->st_2 = date_format(date_create($request->st_2),"Y-m-d");
        $spk->st_3 = date_format(date_create($request->st_3),"Y-m-d");
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
        $spk->dp_percent = $request->dp_percent;
        $spk->denda_a = str_replace(",","",$request->denda_a);
        $spk->denda_b = str_replace(",","",$request->denda_b);
        $spk->matauang = $request->matauang;
        $spk->nilai_tukar = $request->nilai_tukar;
        $spk->jenis_kontrak = $request->jenis_kontrak;
        $spk->memo_cara_bayar = $request->memo_cara_bayar;
        $spk->memo_lingkup_kerja = $request->memo_lingkup_kerja;
        $spk->carapembayaran = $request->carapembayaran;
        $spk->garansi_nilai = $request->garansi_nilai;
        $spk->save();
        return redirect("/spk/detail?id=".$request->spk_id);
    }

    public function termyn (Request $request){

        foreach ($request->termyn as $key => $value) {
            $spk_termyn = new SpkTermyn;
            $spk_termyn->spk_id = $request->spk_termin_id;
            $spk_termyn->termin = $key + 1 ;
            $spk_termyn->progress = $request->termyn[$key];
            if ( $key == 0 ){
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
        return view("spk::create_bap",compact("project","user","spk"));
    }

    public function savebap(Request $request){
        $spk = Spk::find($request->spk_bap);
        $bap_no = $spk->no . '/BAP/' . str_pad( ($spk->baps()->count() + 1) , 2, "0", STR_PAD_LEFT);
        $bap = new Bap;
        $bap->spk_id = $spk->id;
        $bap->date = date("Y-m-d");
        $bap->termin = $request->spk_bap_termin;
        $bap->no = $bap_no;
        $bap->nilai_administrasi = $request->admin;
        $bap->nilai_denda = $request->denda;
        $bap->nilai_selisih = $request->selisih;
        $bap->created_by = \Auth::user()->id;
        //$bap->save();
        echo $request->piutang;

        if ( $request->percent != ""){
            foreach ($spk->tender_rekanan->menangs->first()->details as $key2 => $value2) {
                # code...
                $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::find($value2->itempekerjaan_id);
                $bapPPh = new BapPph;
                $bapPPh->bap_id = $bap->id;
                $bapPPh->coa_id = $itempekerjaan->id;
                $bapPPh->percent = $request->percent[$key2] /100;
                $bapPPh->description = $itempekerjaan->name;
                $bapPPh->save();
            }
        }

        foreach ($spk->details as $key3 => $value3) {
            $detail                    = new BapDetail;
            $detail->bap_id            = $bap->id;
            $detail->asset_id          = $value3->asset_id;
            $detail->asset_type        = $value3->asset_type;
            $status = $detail->save();

            foreach ($spk->tender_rekanan->menangs->first()->details as $key2 => $value2) {
                $bap_detail_itempekerjaan                       = new BapDetailItempekerjaan;
                $bap_detail_itempekerjaan->bap_detail_id        = $detail->id;
                $bap_detail_itempekerjaan->itempekerjaan_id     = $spkvo->unit_progress->itempekerjaan->id;
                $bap_detail_itempekerjaan->spkvo_unit_id        = $spkvo->id;
                $bap_detail_itempekerjaan->terbayar_percent     = ($request->input('terbayar_percent.'.$key2.'.value') / 100);
                $bap_detail_itempekerjaan->lapangan_percent     = ($request->input('lapangan_percent.'.$key2.'.value') / 100);
                $bap_detail_itempekerjaan->save();
            }
        }
    }
}

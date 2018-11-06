<?php

namespace Modules\Voucher\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Voucher\Entities\Voucher;
use Modules\Voucher\Entities\VoucherDetail;
use Modules\Spk\Entities\Bap;
use Modules\Rekanan\Entities\RekananGroup;
use Modules\Spk\Entities\SpkRetensi;

class VoucherController extends Controller
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
        $arraypph = array(
            "0" => array("label" => "21.40.110 ( PPh 21)", "value" => "pph21"),
            "1" => array("label" => "21.40.130 ( PPh 23)", "value" => "pph23"),
            "2" => array("label" => "21.40.140 (PPh Final)", "value" => "pphfinal")
        );
        return view('voucher::index',compact("user","project","arraypph"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $arraypph = array(
            "0" => array("label" => "21.40.110 ( PPh 21)", "value" => "pph21"),
            "1" => array("label" => "21.40.130 ( PPh 23)", "value" => "pph23"),
            "2" => array("label" => "21.40.140 (PPh Final)", "value" => "pphfinal")
        );
        return view('voucher::create',compact("user","project","arraypph"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $voucher = new Voucher;
        $document = \Modules\Spk\Entities\Bap::find($request->bap);
        $voucher_count = Voucher::count();              
    

        if ( $request->tender_rab == "Bap"){     
            $bap = Bap::find($request->bap);
            $explodespk = explode("/",$bap->spk->no);         
            if ( $request->voucher_type == "retensi"){  
                $explode = explode(" ", $bap->spk->rekanan->group->name);
                if ( $request->retensi == "ppn") {
                    $voucher_no = /*$bap->spk->no .*/ "00".str_pad( $voucher_count + 1 ,2,"0",STR_PAD_LEFT).'/VCR/'.$explodespk[2]."/".$explodespk[3]."/".$explodespk[4]."/".$bap->spk->project->code."/".$bap->spk->tender->rab->budget_tahunan->budget->pt->code;
                    $voucher->head_id = $request->bap;
                    $voucher->head_type = $request->tender_rab;
                    $voucher->rekanan_id = $bap->spk->rekanan->group->id;
                    $voucher->department_id = $bap->spk->tender_rekanan->tender->rab->workorder->department_from;
                    $voucher->pt_id = $bap->spk->pt->id;
                    $voucher->project_id = $bap->spk->project_id;
                    $voucher->date = date("Y-m-d");
                    $voucher->no = $voucher_no;
                    $voucher->no_faktur = $request->no_faktur;
                    $voucher->spm_status = $request->spm;
                    $voucher->save();


                    if ( $bap->nilai_bap_dibayar != "0"){                      
                        foreach ($bap->spk->details as $key3 => $value3) {
                            ;
                            $dpp_string =  $explode[0]."-T".$bap->spk->baps->count()."-".$explodespk[0].$explodespk[1].date("Y")."-".$value3->asset->code."-".$bap->spk->itempekerjaan->name ;
                            $dpp_string_new = substr($dpp_string, 0,100);
                            $voucher_detail = new VoucherDetail;
                            $voucher_detail->voucher_id = $voucher->id;
                            $voucher_detail->coa_id = "11.41.".$bap->spk->itempekerjaan->code;            
                            $voucher_detail->nilai = ( $bap->spk->retensis->where("status",null)->first()->percent  ) * ( $bap->spk->nilai + $bap->spk->nilai_vo ) ;
                            $voucher_detail->type = $dpp_string_new;
                            $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                            $voucher_detail->kurs = $bap->spk->nilai_tukar;
                            $voucher_detail->created_by = \Auth::user()->id;
                            $voucher_detail->save();
                        }                
                    }

                    if ( $bap->nilai_bap_dibayar * $bap->spk->rekanan->ppn / 100 != "0"){
                        $ppn_string = "PPN-".$request->no_faktur."-".date("M").date("Y")."-".$dpp_string_new;
                        $substring_ppn = substr($ppn_string, 0,100);
                        $voucher_detail = new VoucherDetail;
                        $voucher_detail->voucher_id = $voucher->id;
                        $voucher_detail->coa_id = $bap->spk->itempekerjaan->coa_ppn ;       
                        $voucher_detail->nilai = ( ( $bap->spk->retensis->where("status",null)->first()->percent  ) * ( $bap->spk->nilai + $bap->spk->nilai_vo ) ) * ( $bap->spk->rekanan->ppn / 100 ) ;
                        $voucher_detail->type = $substring_ppn;
                        $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                        $voucher_detail->kurs = $bap->spk->nilai_tukar;
                        $voucher_detail->created_by = \Auth::user()->id;
                        $voucher_detail->save();
                    }

                    if ( $bap->nilai_bap_dibayar != "0"){                      
                        foreach ($bap->spk->details as $key3 => $value3) {
                            ;
                            $dpp_string =  $explode[0]."-T".$bap->spk->baps->count()."-".$explodespk[0].$explodespk[1].date("Y")."-".$value3->asset->code."-".$bap->spk->itempekerjaan->name ;
                            $dpp_string_new = substr($dpp_string, 0,100);
                            $voucher_detail = new VoucherDetail;
                            $voucher_detail->voucher_id = $voucher->id;
                            $voucher_detail->coa_id = "11.41.".$bap->spk->itempekerjaan->code;            
                            $voucher_detail->nilai = "-".( $bap->spk->retensis->where("status",null)->first()->percent  ) * ( $bap->spk->nilai + $bap->spk->nilai_vo ) ;
                            $voucher_detail->type = $dpp_string_new;
                            $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                            $voucher_detail->kurs = $bap->spk->nilai_tukar;
                            $voucher_detail->created_by = \Auth::user()->id;
                            $voucher_detail->save();
                        }                
                    }      


                }else{

                    $voucher_no = /*$bap->spk->no .*/ "00".str_pad( $voucher_count + 1 ,2,"0",STR_PAD_LEFT).'/VCR/'.$explodespk[2]."/".$explodespk[3]."/".$explodespk[4]."/".$bap->spk->project->code."/".$bap->spk->tender->rab->budget_tahunan->budget->pt->code;
                    $voucher->head_id = $request->bap;
                    $voucher->head_type = $request->tender_rab;
                    $voucher->rekanan_id = $bap->spk->rekanan->group->id;
                    $voucher->department_id = $bap->spk->tender_rekanan->tender->rab->workorder->department_from;
                    $voucher->pt_id = $bap->spk->pt->id;
                    $voucher->project_id = $bap->spk->project_id;
                    $voucher->date = date("Y-m-d");
                    $voucher->no = $voucher_no;
                    $voucher->no_faktur = $request->no_faktur;
                    $voucher->spm_status = $request->spm;
                    $voucher->save();


                    if ( $bap->nilai_bap_dibayar != "0"){ 


                        foreach ($bap->spk->details as $key3 => $value3) {
                            
                            $dpp_string =  $explode[0]."-T".$bap->spk->baps->count()."-".$explodespk[0].$explodespk[1].date("Y")."-".$value3->asset->code."-".$bap->spk->itempekerjaan->name ;
                            $dpp_string_new = substr($dpp_string, 0,100);
                            $voucher_detail = new VoucherDetail;
                            $voucher_detail->voucher_id = $voucher->id;
                            $voucher_detail->coa_id = "11.41.".$bap->spk->itempekerjaan->code;            
                            if ( $bap->spk->rekanan->ppn <= 0 ){

                                $voucher_detail->nilai = ( $bap->spk->retensis->where("status",null)->first()->percent  ) * ( $bap->spk->nilai + $bap->spk->nilai_vo ) ;
                            }else{
                                $voucher_detail->nilai = ( $bap->spk->retensis->where("status",null)->first()->percent  ) * ( $bap->spk->nilai + $bap->spk->nilai_vo ) ;
                            }
                            $voucher_detail->type = $dpp_string_new;
                            $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                            $voucher_detail->kurs = $bap->spk->nilai_tukar;
                            $voucher_detail->created_by = \Auth::user()->id;
                            $voucher_detail->save();

                            $spkretensis = SpkRetensi::find($bap->spk->retensis->first()->id);
                            $spkretensis->status = "1";
                            $spkretensis->save();
                        }

                    }

                    if ( $bap->spk->rekanan->group->pph_percent != "0.0" ){
                        
                        $arraypph = array(
                            "pph21" => array("label" => "PPh 21", "value" => "pph21", "coa" => "21.40.110"),
                            "pph23" => array("label" => "PPh 23", "value" => "pph23", "coa" => "21.40.130"),
                            "pphfinal" => array("label" => "PPh Final", "value" => "pphfinal", "coa" => "21.40.140")
                        );

                        $explode_pph = explode("(",$request->pph);
                        $voucher_detail = new VoucherDetail;
                        $voucher_detail->voucher_id = $voucher->id;
                        $voucher_detail->coa_id =  $arraypph[$request->pph]['coa']; 
                        //if ( $bap->spk->rekanan->ppn / 100 != null ){    
                            $pph = ( $bap->spk->rekanan->group->pph_percent / 100 ) *  ( ( $bap->spk->retensis->where("status",null)->first()->percent  ) * ( $bap->spk->nilai ) )  ;     
                        //} 
                        $voucher_detail->nilai = "-".$pph;
                        $voucher_detail->head_type = "PPh";
                        $voucher_detail->type = $arraypph[$request->pph]['label']."-".$dpp_string_new;
                        $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                        $voucher_detail->kurs = $bap->spk->nilai_tukar;
                        $voucher_detail->created_by = \Auth::user()->id;
                        $voucher_detail->save();
                    }
                }


            }else{

                $voucher_no = /*$bap->spk->no .*/ "00".str_pad( $voucher_count + 1 ,2,"0",STR_PAD_LEFT).'/VCR/'.$explodespk[2]."/".$explodespk[3]."/".$explodespk[4]."/".$bap->spk->project->code."/".$bap->spk->tender->rab->budget_tahunan->budget->pt->code;
                $voucher->head_id = $request->bap;
                $voucher->head_type = $request->tender_rab;
                $voucher->rekanan_id = $bap->spk->rekanan->group->id;
                $voucher->department_id = $bap->spk->tender_rekanan->tender->rab->workorder->department_from;
                $voucher->pt_id = $bap->spk->pt->id;
                $voucher->project_id = $bap->spk->project_id;
                $voucher->date = date("Y-m-d");
                $voucher->no = $voucher_no;
                $voucher->no_faktur = $request->no_faktur;
                $voucher->spm_status = $request->spm;
                $voucher->save();
                
                $explode = explode(" ", $bap->spk->rekanan->group->name);
                

                if ( $bap->nilai_bap_dibayar != "0"){                      
                    foreach ($bap->spk->details as $key3 => $value3) {
                        ;
                        $dpp_string =  $explode[0]."-T".$bap->spk->baps->count()."-".$explodespk[0].$explodespk[1].date("Y")."-".$value3->asset->code."-".$bap->spk->itempekerjaan->name ;
                        $dpp_string_new = substr($dpp_string, 0,100);
                        $voucher_detail = new VoucherDetail;
                        $voucher_detail->voucher_id = $voucher->id;
                        $voucher_detail->coa_id = "11.41.".$bap->spk->itempekerjaan->code;  
                        if ( $bap->spk->rekanan->ppn / 100 != null ){          
                            $voucher_detail->nilai = $bap->nilai_bap_dibayar - ( $bap->nilai_administrasi + $bap->nilai_selisih + $bap->nilai_denda + $bap->nilai_sebelumnya) / 1.1;
                        }else{
                            $voucher_detail->nilai = $bap->nilai_bap_dibayar - ( $bap->nilai_administrasi + $bap->nilai_selisih + $bap->nilai_denda + $bap->nilai_sebelumnya);
                        }
                        $voucher_detail->type = $dpp_string_new;
                        $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                        $voucher_detail->kurs = $bap->spk->nilai_tukar;
                        $voucher_detail->created_by = \Auth::user()->id;
                        $voucher_detail->save();
                    }                
                }

                if ( $bap->nilai_bap_dibayar * $bap->spk->rekanan->ppn / 100 != "0"){
                    $ppn_string = "PPN-".$request->no_faktur."-".date("M").date("Y")."-".$dpp_string_new;
                    $substring_ppn = substr($ppn_string, 0,100);
                    $voucher_detail = new VoucherDetail;
                    $voucher_detail->voucher_id = $voucher->id;
                    $voucher_detail->coa_id = $bap->spk->itempekerjaan->coa_ppn ;       
                    $voucher_detail->nilai = ( $bap->nilai_bap_dibayar - ( $bap->nilai_administrasi + $bap->nilai_selisih + $bap->nilai_denda + $bap->nilai_sebelumnya) / 1.1 ) * $bap->spk->rekanan->ppn / 100;
                    $voucher_detail->type = $substring_ppn;
                    $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                    $voucher_detail->kurs = $bap->spk->nilai_tukar;
                    $voucher_detail->created_by = \Auth::user()->id;
                    $voucher_detail->save();
                }

                if ( $bap->spk->rekanan->group->pph_percent != "0.0" ){
                    $arraypph = array(
                        "pph21" => array("label" => "PPh 21", "value" => "pph21", "coa" => "21.40.110"),
                        "pph23" => array("label" => "PPh 23", "value" => "pph23", "coa" => "21.40.130"),
                        "pphfinal" => array("label" => "PPh Final", "value" => "pphfinal", "coa" => "21.40.140")
                    );

                    $explode_pph = explode("(",$request->pph);
                    $voucher_detail = new VoucherDetail;
                    $voucher_detail->voucher_id = $voucher->id;
                    $voucher_detail->coa_id =  $arraypph[$request->pph]['coa']; 
                    if ( $bap->spk->rekanan->ppn / 100 != null ){    
                        $pph = ( $bap->spk->rekanan->group->pph_percent / 100 ) *  ( $bap->nilai_bap_dibayar / 1.1 )  ;     
                    } else {
                        $pph = ( $bap->spk->rekanan->group->pph_percent / 100 ) *  ( $bap->nilai_bap_dibayar )  ;     
                    }
                    $voucher_detail->nilai = "-".$pph;
                    $voucher_detail->head_type = "PPh";
                    $voucher_detail->type = $arraypph[$request->pph]['label']."-".$dpp_string_new;
                    $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                    $voucher_detail->kurs = $bap->spk->nilai_tukar;
                    $voucher_detail->created_by = \Auth::user()->id;
                    $voucher_detail->save();
                }

                if ( $bap->nilai_administrasi != "0.0" ){
                    $voucher_detail = new VoucherDetail;
                    $voucher_detail->voucher_id = $voucher->id;
                    $voucher_detail->coa_id = null ;       
                    $voucher_detail->nilai = $bap->nilai_administrasi;
                    $voucher_detail->type = "Nilai Administrasi";
                    $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                    $voucher_detail->kurs = $bap->spk->nilai_tukar;
                    $voucher_detail->created_by = \Auth::user()->id;
                    $voucher_detail->save();
                }

                if ( $bap->nilai_denda != "0.0" ){
                    $voucher_detail = new VoucherDetail;
                    $voucher_detail->voucher_id = $voucher->id;
                    $voucher_detail->coa_id =  null;       
                    $voucher_detail->nilai = $bap->nilai_denda;
                    $voucher_detail->type = "Nilai Denda";
                    $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                    $voucher_detail->kurs = $bap->spk->nilai_tukar;
                    $voucher_detail->created_by = \Auth::user()->id;
                    $voucher_detail->save();
                }

                if ( $bap->nilai_selisih != "0.0"){
                    $voucher_detail = new VoucherDetail;
                    $voucher_detail->voucher_id = $voucher->id;
                    $voucher_detail->coa_id = null ;       
                    $voucher_detail->nilai = $bap->nilai_selisih;
                    $voucher_detail->type = "Nilai Selisih";
                    $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                    $voucher_detail->kurs = $bap->spk->nilai_tukar;
                    $voucher_detail->created_by = \Auth::user()->id;
                    $voucher_detail->save();
                }

                if ( $bap->nilai_talangan != "" ){
                    $voucher_detail = new VoucherDetail;
                    $voucher_detail->voucher_id = $voucher->id;
                    $voucher_detail->coa_id =  null;       
                    $voucher_detail->nilai = $bap->nilai_talangan;
                    $voucher_detail->type = "Nilai Talangan";
                    $voucher_detail->mata_uang =  $bap->spk->mata_uang;
                    $voucher_detail->kurs = $bap->spk->nilai_tukar;
                    $voucher_detail->created_by = \Auth::user()->id;
                    $voucher_detail->save();
                }
            }

           
        }
        
        
        
        return redirect("/voucher/show/?id=".$voucher->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $voucher = Voucher::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $arraypph = array(
            "0" => array("label" => "21.40.110 ( PPh 21)", "value" => "pph21"),
            "1" => array("label" => "21.40.130 ( PPh 23)", "value" => "pph23"),
            "2" => array("label" => "21.40.140 (PPh Final)", "value" => "pphfinal")
        );

        return view('voucher::detail',compact("user","project","voucher","arraypph"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function savedetail(Request $request)
    {
        return view('voucher::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $voucher = Voucher::find($request->voucher_id);
        $voucher->rekanan_rekening_id = $request->rekanan_rekening;
        //$voucher->tempo_date = $request->tempo;
        //$voucher->penyerahan_date = $request->diserahkan;
        //$voucher->pencairan_date = $request->pencairan;
        //$voucher->description = $request->description;
        //$voucher->rekanan_rekening_id = $request->rekanan_rekening;
        $voucher->save();


        $arraypph = array(
            "pph21" => array("label" => "PPh 21", "value" => "pph21", "percent" => "2", "coa" => "21.40.110"),
            "pph23" => array("label" => "PPh 23", "value" => "pph23", "percent" => "2", "coa" => "21.40.130"),
            "pphfinal" => array("label" => "PPh Final", "value" => "pphfinal", "percent" => "2", "coa" => "21.40.140")
        );

        
        if ( isset($request->id_detail)){
            $voucher_detail = VoucherDetail::find($request->id_detail);
            $label = explode("-", $voucher_detail->type);        
            if ( $voucher->bap->spk->rekanan->ppn == null ){
                $voucher_detail->nilai = "-".$voucher->bap->nilai_bap_dibayar * ( $request->pph_percent / 100 );
            }else{
                $voucher_detail->nilai = "-".( $voucher->bap->nilai_bap_dibayar / 1.1 ) * ( $request->pph_percent / 100 );
            }

            $voucher_detail->coa_id = $arraypph[$request->pph]['coa'];
            $voucher_detail->type = $arraypph[$request->pph]['label']."-".$label[1]."-".$label[2]."-".$label[3]."-".$label[4]."-".$label[5];
            $voucher_detail->save();
        }
        $rekanangroup = RekananGroup::find($voucher->bap->spk->rekanan->group->id);
        $rekanangroup->pph_percent = $request->pph_percent;
        $rekanangroup->save();
        return redirect("/voucher/show?id=".$voucher->id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function detail_unit(Request $request){
        $voucher = Voucher::find($request->id);
        $user    = \Auth::user();
        $project = $project = Project::find($request->session()->get('project_id'));
        return view("voucher::voucher_unit",compact("voucher","user","project"));
    }

    public function checkbap(Request $request){
        $bap = Bap::find($request->id);
        if ( $bap->nilai_retensi == ( $bap->spk->retensis->sum("percent") * ( $bap->spk->nilai + $bap->spk->nilai_vo )) ){
            $status = "0";
            if ( $bap->spk->rekanan->ppn <= 0 ){
                $ppn = "0";
            }else{
                $ppn = "1";
            }

            $retensi = array();
            foreach ($bap->spk->retensis as $key => $value) {
                if ( $value->status == null ){
                    $retensi[$key] = $value->id;
                }
            }

            $retensi = count($retensi);
        }else{
            $status= "1";
            $retensi = 0;
            $ppn = "0";
        }

        return response()->json( ["status" =>  $status, "ppn" => $ppn, "retensis" => $retensi ] );
    }
}

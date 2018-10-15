<?php

namespace Modules\Kontraktor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Rekanan\Entities\RekananGroup;
use Modules\User\Entities\User;
use Modules\Kontraktor\Entities\Kontraktor;
use Modules\Tender\Entities\Tender;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Tender\Entities\TenderRekanan;
use Modules\Tender\Entities\TenderPenawaran;
use Modules\Tender\Entities\TenderPenawaranDetail;


class KontraktorController extends Controller
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
        $user = User::find(\Auth::user()->id);
        $rekanan = $user->rekanan;
        return view('kontraktor::index',compact("user","rekanan"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $tender = Tender::find($request->id);
        $user = User::find(\Auth::user()->id);
        $itempekerjaan = Itempekerjaan::find(292);
        $rekanans = $tender->rekanans;
        foreach ($rekanans as $key => $value) {
            if ( $value->rekanan->group->id == $user->rekanan->id ){
                $status = $value->is_pemenang;               
                $rekanan = TenderRekanan::find($value->id);
            }
        }

        return view('kontraktor::tender_detail',compact("tender","user","itempekerjaan","status","rekanan"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function tender(Request $request)
    {
        $user = User::find(\Auth::user()->id);
        $tender = $user->rekanan->tender;
        return view("kontraktor::tender",compact("tender","user"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function tenderadd(Request $request)
    {
        $tender_rekanan = TenderRekanan::find($request->id);
        $user = User::find(\Auth::user()->id);
        $tender = $tender_rekanan->tender;
        if ( count($tender_rekanan->penawarans) <= "0" ){
            $penawaran = "1";
        }else{
            $penawaran = count($tender_rekanan->penawarans);
        }
        $itempekerjaan = Itempekerjaan::find($tender->rab->parent_id);
        return view('kontraktor::tender_add',compact("user","tender","tender_rekanan","penawaran","itempekerjaan"));
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

    public function savepenawaran(Request $request){

        $tender_rekanan = TenderRekanan::find($request->tender_rekanan);

        //$tender_penawaran_no = \App\Helpers\Document::new_number('TENDERPENAWARAN', $tender_rekanan->tender->rab->workorder->department_from);
        if ( $request->penawaran == 1 ){
            $penawaran = new TenderPenawaran;
            $penawaran->tender_rekanan_id = $request->tender_rekanan;
            $penawaran->no = null;
            $penawaran->description = $request->description;
            $penawaran->date = date("Y-m-d");
            $penawaran->created_by = \Auth::user()->id;

            if ( $_FILES['file_upload']['tmp_name'] != ""){
                $array_mime = array("application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.ms-excel","application/msword");
                $mime = mime_content_type($_FILES['file_upload']['tmp_name']);
                if ( in_array($mime, $array_mime)){
                    $target_file =  $_SERVER["DOCUMENT_ROOT"]."/assets/tender/".$tender_rekanan->tender->id."/".$_FILES['file_upload']['name'];
                    move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);
                    $penawaran->file_attachment = $_FILES['file_upload']['name'];
                    $penawaran->save();
                }else{
                    print("<script type='text/javascript'>alert('Format file tidak bisa diterima. Silahkan upload sesuai format yang diminta');</script>");
                }
            }else{

                $penawaran->save();
            }
        }else{
            $penawaran_id = $tender_rekanan->penawarans->last()->id;
        }


        foreach ($request->input_rab_id as $key => $value) {
            if ( $request->penawaran == 1 ){
                if ( $request->input_nilai_[$key] != "" ){
                    $nilai = str_replace(",","",$request->input_nilai_[$key]);
                }else{
                    $nilai = 0;
                }
                $tender_penawaran_detail = new TenderPenawaranDetail;
                $tender_penawaran_detail->tender_penawaran_id = $penawaran->id;
                $tender_penawaran_detail->rab_pekerjaan_id = $request->input_rab_id[$key];
                $tender_penawaran_detail->keterangan = $request->input_rab_id[$key];
                $tender_penawaran_detail->nilai = $nilai;
                $tender_penawaran_detail->volume = $request->input_volume[$key];
                $tender_penawaran_detail->save();
            }
        }

        return redirect("/kontraktor/tender/detail?id=".$tender_rekanan->tender->id);
    }

    public function viewpenawaran(Request $request){
        $penawaran = TenderPenawaran::find($request->id);
        $itempekerjaan   = Itempekerjaan::find($penawaran->rekanan->tender->rab->parent_id);
        $user = User::find(\Auth::user()->id);
        $tender = $penawaran->rekanan->tender;
        $tender_rekanan = $penawaran->rekanan;
        return view("kontraktor::penawaran_detail",compact("penawaran","itempekerjaan","user","tender","tender_rekanan"));
    }

    public function updatepenawaran(Request $request){
        foreach ($request->input_id_ as $key => $value) {
            if ( $request->input_nilai_[$key]  == "" ){
                $nilai = 0;
            }else{
                $nilai = str_replace(",", "", $request->input_nilai_[$key]);
            }

            $tender_penawaran_detail = TenderPenawaranDetail::find($request->input_id_[$key]);
            $tender_penawaran_detail->nilai = $nilai;
            $tender_penawaran_detail->save();
        }

        return redirect("/kontraktor/tender/detail?id=".$request->tender_id);
    }

    public function addpenawaran2(Request $request){
        $tender_rekanan = TenderRekanan::find($request->id);
        foreach ($tender_rekanan->penawarans as $key => $value) {
            if ( $key == "1"){
                $tender_detail = $value->details;
            }
        }
    }
}

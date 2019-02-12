<?php

namespace Modules\Pengajuanbiaya\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Pengajuanbiaya\Entities\Pengajuanbiaya;
use Modules\Pengajuanbiaya\Entities\PengajuanbiayaDetail;
use Modules\Project\Entities\Project;
use Modules\Budget\Entities\BudgetTahunan;
use Modules\Pekerjaan\Entities\Itempekerjaan;

class PengajuanbiayaController extends Controller
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
        $pengajuanbiaya = Pengajuanbiaya::orderBy('id', 'DESC')->get();
        $project = Project::find($request->session()->get('project_id'));
        $arraystatus = array(
            1 => array("class" => "label label-warning", "label" => "On Progress"),
            2 => array("class" => "label label-success", "label" => "Finish")
        );
        return view('pengajuanbiaya::index',compact("user","pengajuanbiaya","project","arraystatus"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $itempekerjaan = Itempekerjaan::get();
        return view('pengajuanbiaya::create',compact("user","project","itempekerjaan"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /*
            Status 
            1 : new
            2 : finish
        */
        $user = \Auth::user();
        $budgettahunan = BudgetTahunan::find($request->budget_tahunan);   
        $number = \App\Helpers\Document::new_number('PGB', $budgettahunan->budget->department->id,$budgettahunan->budget->project->id).$budgettahunan->budget->pt->code;

        $pengajuan_biaya = new Pengajuanbiaya;
        $pengajuan_biaya->budget_id = $budgettahunan->id;
        $pengajuan_biaya->no = $number;
        $pengajuan_biaya->date = date("Y-m-d");
        $pengajuan_biaya->status = 1;
        $pengajuan_biaya->description = $request->judul;
        $pengajuan_biaya->created_by = $user->id;
        $pengajuan_biaya->butuh_date = $request->butuh_date;
        $pengajuan_biaya->itempekerjaan_id = $request->itempekerjaan_id;
        $pengajuan_biaya->save();

        return redirect("/pengajuanbiaya/detail?id=".$pengajuan_biaya->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $pengajuanbiaya = Pengajuanbiaya::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $arraystatus = array(
            1 => array("class" => "label label-warning", "label" => "On Progress"),
            2 => array("class" => "label label-success", "label" => "Finish")
        );
        $itempekerjaan = Itempekerjaan::get();
        return view('pengajuanbiaya::detail',compact("user","project","pengajuanbiaya","arraystatus","itempekerjaan"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('pengajuanbiaya::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $pengajuanbiaya = Pengajuanbiaya::find($request->pengajuanbiaya_id);
        $pengajuanbiaya->itempekerjaan_id = $request->itempekerjaan_id;
        $pengajuanbiaya->description = $request->judul;
        $pengajuanbiaya->butuh_date = $request->butuh_date;
        $pengajuanbiaya->itempekerjaan_id = $request->itempekerjaan_id;
        $pengajuanbiaya->save();

        return redirect("/pengajuanbiaya/detail?id=".$request->pengajuanbiaya_id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $pengajuanbiaya_detail = PengajuanbiayaDetail::find($request->id);
        $pengajuanbiaya_detail->delete();
        return response()->json( ["status" => "0"] );
    }

    public function loaditempekerjaan(Request $request){
        $html = "";
        $budgettahunan = BudgetTahunan::find($request->id);
        foreach ($budgettahunan->total_parent_item as $key => $value) {
            if ( $value['volume'] > 0 && $value['nilai'] > 0 && $value['cashout']){
                $html .= "<option value='".$value['id']."'>".$value['code']."-".$value['itempekerjaan']."</option>";
            }
        }

        return response()->json( ["status" => "0", "html" => $html] );
    }

    public function savedetail(Request $request){
        $pengajuanbiaya = Pengajuanbiaya::find($request->pengajuanbiaya_id);

        $pengajuanbiaya_detail = new PengajuanbiayaDetail;
        $pengajuanbiaya_detail->pengajuan_biaya_id = $request->pengajuanbiaya_id;
        $pengajuanbiaya_detail->user_id = \Auth::user()->id;
        $pengajuanbiaya_detail->nilai = str_replace(",", "", $request->harga_satuan);
        $pengajuanbiaya_detail->description = str_replace(",", "", $request->uraian_pekerjaan);
        $pengajuanbiaya_detail->itempekerjaan_id = $pengajuanbiaya->itempekerjaan_id;
        $pengajuanbiaya_detail->save();
        return redirect("/pengajuanbiaya/detail?id=".$request->pengajuanbiaya_id);
    }
}

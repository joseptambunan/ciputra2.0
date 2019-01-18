<?php

namespace Modules\Simulasi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Voucher\Entities\Voucher;
use Modules\Tender\Entities\TenderRekanan;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\Unit;

class SimulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    /*public function __construct()
    {

        $this->middleware('auth');
    }*/

    public function index()
    {
        $user = \Auth::user();
        $voucher = Voucher::get();
        $terbayar = 0;
        $blm = 0;
        foreach ($voucher as $key => $value) {
            if ( $value->project_id == 9 ){                
                if ( $value->pencairan_date == null ){
                    $blm = $blm + $value->nilai;
                }else{
                    $terbayar = $terbayar + $value->nilai;
                }
            }
        }

        return view('simulasi::index',compact("user","voucher","terbayar","blm"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('simulasi::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        foreach ($request->terbayar as $key => $value) {
            if ( $request->terbayar[$key] != "" ){
                if ( $request[$key] != "on"){
                    $voucher = Voucher::find($request->voucher_id[$key]);
                    $voucher->pencairan_date = date("Y-m-d H:i:s.u");
                    $voucher->save();
                }
            }
        }
        return redirect("simulasi");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        $user = \Auth::user();
        $tender_rekanan = TenderRekanan::get();
        return view('simulasi::show',compact("user","tender_rekanan"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('simulasi::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        if ( $request->terbayar != "" ){
            foreach ($request->terbayar as $key => $value) {
                $tender_rekanan = TenderRekanan::find($request->terbayar[$key]);
                $tender_rekanan->doc_bayar_status = 1;
                $tender_rekanan->doc_bayar_date = date("Y-m-d H:i:s.u");
                $tender_rekanan->save();
            }
        }
        return redirect("simulasi/tender");
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function erems(){
        $project = Project::get();
        $user = \Auth::user();
        return view("simulasi::erems",compact("user","project"));
    }

    public function eremsproject(Request $request){
        $project = Project::find($request->id);
         $user = \Auth::user();
        return view("simulasi::erems_project",compact("user","project"));
    }

    public function updateerems(Request $request){
        $project = $request->project_id;

        if ( $request->unit_ != "" ){
            foreach ($request->unit_ as $key => $value) {
                $unit = Unit::find($request->unit_[$key]);
                $unit->status = 5;
                $unit->save();
            }
        }

        return redirect("/simulasi/erems/project/?id=".$project);
    }
}

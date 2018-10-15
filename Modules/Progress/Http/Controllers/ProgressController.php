<?php

namespace Modules\Progress\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\UnitProgress;
use Modules\Spk\Entities\Spk;
use Modules\Spk\Entities\SpkvoUnit;
use Modules\Spk\Entities\SpkDetail;
use Modules\Spk\Entities\SpkTermyn;
use Modules\Spk\Entities\SpkTermynDetail;
use Modules\Project\Entities\UnitProgressDetail;
use Modules\Tender\Entities\TenderUnit;

class ProgressController extends Controller
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
        return view('progress::index',compact("user","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $unitprogress = UnitProgress::where("unit_id",$request->id)->get();
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $unit = TenderUnit::find($request->id);
        $spk = Spk::find($request->spk);
        $arrayEscrow = array(
            "1" => array("label" => "Escrow : Pondasi", "style" => "background-color:grey;color:white;font-weight:bolder"),
            "2" => array("label" => "Escrow : Atap", "style" => "background-color:#d58512;color:white;font-weight:bolder"),
            ""  => array("label" => "", "style" => "")
        );
        return view('progress::create_progress',compact("user","unitprogress","unit","project","spk","arrayEscrow"));
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
    public function show(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $spk = Spk::find($request->id);
        $start_date = date_create($spk->start_date);
        $end_date = date_create($spk->finish_date);
        $interval = date_diff($start_date,$end_date);
        $hari = ( 30 * $interval->m ) + $interval->d;
        $minggu = ceil($hari / 7);
        return view('progress::detail',compact("user","spk","project","minggu"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $spk = Spk::find($request->spk_id);
        foreach ($spk->details as $key => $value) {
            
            foreach ($value->details_with_vo as $key2 => $value2) {
                $percentage = 0;
                $check = \Modules\Project\Entities\UnitProgressDetail::where("unit_progress_id",$value2->unit_progress_id)->get();
                foreach ($check as $key3 => $value3) {
                    $percentage = $value3->progress_percent + $percentage;
                }
                $unit_progress = UnitProgress::find($value2->unit_progress_id);
                $unit_progress->progresslapangan_percent = $percentage;
                $unit_progress->save();
                
            }
        }

        foreach ($spk->termyn as $key => $value) {
            if ( $value->termin == $request->termin ){
                $spktermyn = SpkTermyn::find($value->id);
                $spktermyn->status = "2";
                $spktermyn->save();
            }

            if ( ($request->termin + 1 ) == $value->termin ){
                $spktermyn = SpkTermyn::find($value->id);
                $spktermyn->status = "1";
                $spktermyn->save();
            }
        }
        return response()->json( ["status" => "0"] );
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $spk = Spk::find($request->id);
        $start_date = date_create($spk->start_date);
        $end_date = date_create($spk->finish_date);
        $interval = date_diff($start_date,$end_date);
        $hari = ( 30 * $interval->m ) + $interval->d;
        $minggu = ceil($hari / 7);
        $termin = $spk->termyn ; 
        $termin_ke = "";
        $termin_id = "";
        foreach ($termin as $key => $value) {
            if ( $value->status == "1"){
                $termin_id = $value->id;
                $termin_ke = $value->termin;
            }
        }
        return view('progress::progress',compact("user","project","spk","minggu","termin_id","termin_ke"));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function saveprogress(Request $request){
        foreach ($request->unit_progress_id as $key => $value) {
            # code...
            if ( $request->progress_saat_ini_[$key] != "" ){                
                $UnitProgress = UnitProgress::find($request->unit_progress_id[$key]);
                $UnitProgress->progresslapangan_percent = str_replace(",", "", $request->progress_saat_ini_[$key]) / 100  ;
                $UnitProgress->termin = $request->termin_ke;
                $UnitProgress->save();
            }

            if ( $request->progress_saat_ini_[$key] != "" ){
                $UnitProgressDetail = new UnitProgressDetail;
                $UnitProgressDetail->unit_progress_id = $request->unit_progress_id[$key];
                $UnitProgressDetail->progress_date = date("Y-m-d");
                $UnitProgressDetail->progress_percent = str_replace(",", "", $request->progress_saat_ini_[$key]) / 100 ;
                $UnitProgress->termin = $request->termyn;
                $UnitProgressDetail->save();
            }

            
        }
        return redirect("/progress/create/?id=".$request->unit_id."&spk=".$request->spk_id);      
    }
}

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
    public function create()
    {
        return view('progress::create');
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
        //print_r($request->progress_minggu_);die;
        
        //print_r($request->progress_minggu_);
    
        $spk = Spk::find($request->spk_id);       
        foreach ($spk->details as $key => $value) {
            
            foreach ($value->details_with_vo as $key2 => $value2) {
                $start = 0;
                //if( count($value2->unit_progress->details) < $request->termin_ke ){
                    foreach ($spk->termyn as $key3 => $value3) {
                        if ( $request->progress_minggu_[$value2->unit_progress->itempekerjaan_id][$start] != "" ){
                            $newProgress = new UnitProgressDetail;
                            $newProgress->unit_progress_id = $value2->unit_progress->id;
                            $newProgress->progress_date = date("Y-m-d");
                            $newProgress->progress_percent = $request->progress_minggu_[$value2->unit_progress->itempekerjaan_id][$start];
                            $newProgress->termyn = $request->termin_ke;
                            $newProgress->created_by = \Auth::user()->id;
                            $newProgress->description = $request->description;
                            $newProgress->week = $request->week + 1 ;
                            $newProgress->save();
                        }             
                            
                        $start++;
                    }

                    
                    //$newProgress->save();
                //}
            }
        }
        return redirect("/progress/show/?id=".$request->spk_id);      
    }
}

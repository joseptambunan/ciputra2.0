<?php

namespace Modules\Rab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Rab\Entities\Rab;
use Modules\Rab\Entities\RabDetail;
use Modules\Rab\Entities\RabPekerjaan;
use Modules\Rab\Entities\RabUnit;
use Modules\Workorder\Entities\Workorder;
use Modules\Project\Entities\Project;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Asset\Entities\Asset;

class RabController extends Controller
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
        if ( isset($request->workorder_id)){
            $workorder = Workorder::find($request->workorder_id);
        }else{
            $workorder = $project->workorder;
        }
        
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        return view('rab::index',compact("project","workorder","user"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $workorder = Workorder::find($request->id);
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
         return view('rab::create',compact("project","workorder","user"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $workorder = Workorder::find($request->rab_wo);
        $rab_no = \App\Helpers\Document::new_number('RAB', $workorder->department_from);
        $rab = new Rab;
        $rab->no = $rab_no;
        $rab->workorder_id = $request->rab_wo;
        $rab->name = $request->rab_name;
        $rab->created_by = \Auth::user()->id;
        $rab->save();
        return redirect("/rab/detail?id=".$rab->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $rab = Rab::find($request->id);
        if ( $rab->parent_id != "" ){
            $itempekerjaan = Itempekerjaan::find($rab->parent_id);;
        }else{
            $itempekerjaan = "";
        }
        
        return view('rab::show',compact("user","project","rab","itempekerjaan"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('rab::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $rab = Rab::find($request->id);
        $rab->name = $request->name;
        $rab->save();
        return redirect("/rab/detail?id=".$request->id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function itempekerjaan(Request $request){
        $html = "";
        $start = 0;
        $itempekerjaan = Itempekerjaan::find($request->id);
        
        foreach ( $itempekerjaan->child_item as $key3 => $value3 ){            
            if ( count($value3->child_item) > 0 ){
                $html .= "<tr>";
                $html .= "<td><strong>".$value3->code."</strong></td>";
                $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value3->id.")' data-attribute='1' id='btn_".$value3->id."'>".$value3->name."</td>";
                $html .= "<td>&nbsp;</td>";
                $html .= "<td>&nbsp;</td>";
                $html .= "<td>&nbsp;</td>";
                $html .= "</tr>";
                foreach ( $value3->child_item as $key4 => $value4 ){
                    if ( count($value4->child_item) > 0 ){
                        $html .= "<tr>";
                        $html .= "<td><strong>".$value4->code."</strong></td>";
                        $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value4->id.")' data-attribute='1' id='btn_".$value4->id."'>".$value4->name."</td>";
                        $html .= "<td>&nbsp;</td>";
                        $html .= "<td>&nbsp;</td>";
                        $html .= "<td>&nbsp;</td>";
                        $html .= "</tr>";
                        
                        foreach ($value4->child_item as $key5 => $value5) {
                            $html .= "<tr>";
                            $html .= "<td><strong>".$value5->code."</strong></td>";
                            $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value5->id.")' data-attribute='1' id='btn_".$value5->id."'>".$value5->name."</td>";
                            $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value5->id."'/><input type='text' class='form-control' name='volume_[".$start."]' value=''  onkeyup='summary(".$start.")'/><input type='hidden' class='form-control' name='code[".$start."]' value='".$value5->code."'/></td>";
                            $html .= "<td><input type='text' class='form-control' name='satuan_[".$start."]'value='m2'/></td>";
                            $html .= "<td><input type='text' class='form-control' name='nilai_[".$start."]' value=''  onkeyup='summary(".$start.")'/></td>";
                            $html .= "<td><span id='total_".$start."'></span></td>";
                            $html .= "</tr>";
                            $start++;  
                        }
                    } else {
                        $html .= "<tr>";
                        $html .= "<td><strong>".$value4->code."</strong></td>";
                        $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value4->id.")' data-attribute='1' id='btn_".$value4->id."'>".$value4->name."</td>";
                        $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value4->id."'/><input type='text' class='form-control' name='volume_[".$start."]' id='volume_[".$start."]' value='' onkeyup='summary(".$start.")'/><input type='hidden' class='form-control' name='code[".$start."]' value='".$value4->code."'/></td>";
                        $html .= "<td><input type='text' class='form-control' name='satuan_[".$start."]'value='m2'/></td>";
                        $html .= "<td><input type='text' class='form-control' name='nilai_[".$start."]' id='nilai_[".$start."]' value='' onkeyup='summary(".$start.")'/></td>";
                        $html .= "<td><span id='total_".$start."'></span></td>";
                        $html .= "</tr>";
                        $start++;  
                    }   
                                    
                }
            }else{
                $html .= "<tr>";
                $html .= "<td><strong>".$value3->code."</strong></td>";
                $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value3->id.")' data-attribute='1' id='btn_".$value3->id."'>".$value3->name."</td>";
                $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value3->id."'/><input type='hidden' class='form-control' name='code[".$start."]' value='".$value3->code."'/><input type='text' class='form-control' name='volume_[".$start."]' value=''/></td>";
                $html .= "<td><input type='text' class='form-control' name='satuan_[".$start."]' value='m2'/></td>";
                $html .= "<td><input type='text' class='form-control' name='nilai_[".$start."]' value=''/></td>";
                $html .= "<td><input type='text' class='form-control' name='nilai_[".$start."]' value=''/></td>";
                $html .= "<td><span id='total_{{ $start }}'></span></td>";
                $html .= "</tr>";
                $start++;  
            }
        }
        return response()->json( ["status" => "0", "html" => $html] );
    }

    public function saveunit(Request $request){

        foreach ($request->unit_rab_ as $key => $value) {
            if ($request->unit_rab_[$key] != "" ){
                $rabunits = new RabUnit;
                $rabunits->rab_id = $request->rab_unit_id;
                $rabunits->asset_id = $request->unit_rab_[$key];
                $rabunits->asset_type = $request->unit_rab_type_[$key];
                $rabunits->created_by = \Auth::user()->id;
                $rabunits->save();
            }
            
        }
        return redirect("/rab/detail?id=".$request->rab_unit_id);
    }

    public function deleteunit(Request $request){
        $rabunits = RabUnit::find($request->id);
        $status = $rabunits->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function savepekerjaan(Request $request){
        $rab  = Rab::find($request->rab);
        foreach ($request->item_id as $key => $value) {
            $rabpekerjaan = new RabPekerjaan;
            $rabpekerjaan->rab_unit_id = $rab->id;
            $rabpekerjaan->itempekerjaan_id = $request->item_id[$key];
            $rabpekerjaan->nilai = $request->nilai_[$key];
            $rabpekerjaan->volume = $request->volume_[$key];
            $rabpekerjaan->satuan = $request->satuan_[$key];
            $rabpekerjaan->created_by  = \Auth::user()->id;
            $rabpekerjaan->save();
        }      
        return redirect("/rab/detail?id=".$rab->id);          
    }

    public function updateitem(Request $request){
        $rab = RabPekerjaan::find($request->id);
        $rab->nilai = $request->nilai;
        $rab->volume = $request->volume;
        $rab->satuan = $request->satuan;
        $rab->created_by  = \Auth::user()->id;
        $status = $rab->save();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function approval(Request $request){
        $rab = $request->id;
        $class  = "RAB";
        $approval = \App\Helpers\Document::make_approval('Modules\Rab\Entities\Rab',$rab);
        return response()->json( ["status" => "0"] );
    }
}

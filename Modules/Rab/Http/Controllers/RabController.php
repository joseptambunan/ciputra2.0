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
use Modules\Budget\Entities\BudgetTahunan;
use Modules\Budget\Entities\BudgetTahunanDetail;
use Modules\Workorder\Entities\WorkorderBudgetDetail;
use Modules\Tender\Entities\Tender;
use Modules\Tender\Entities\TenderUnit;

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
        $project = Project::find($request->session()->get('project_id'));
        $rab_no = \App\Helpers\Document::new_number('RAB', $workorder->department_from,$project->id);
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
                            $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value5->id."'/><input type='text' class='form-control' name='volume_[".$start."]' value='0'  onkeyup='summary(".$start.")'/><input type='hidden' class='form-control' name='code[".$start."]' value='".$value5->code."'/></td>";
                            $html .= "<td><input type='text' class='form-control' name='satuan_[".$start."]' value='".$value5->itempekerjaan->details->satuan."'/></td>";
                            $html .= "<td><input type='text' class='form-control nilai_budgets' name='nilai_[".$start."]' value=''  onkeyup='summary(".$start.")'/></td>";
                            $html .= "<td><span id='total_".$start."'></span></td>";
                            $html .= "</tr>";
                            $start++;  
                        }
                    } else {
                        $html .= "<tr>";
                        $html .= "<td><strong>".$value4->code."</strong></td>";
                        $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value4->id.")' data-attribute='1' id='btn_".$value4->id."'>".$value4->name."</td>";
                        $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value4->id."'/><input type='text' class='form-control' name='volume_[".$start."]' id='volume_[".$start."]' value='0' onkeyup='summary(".$start.")'/><input type='hidden' class='form-control' name='code[".$start."]' value='".$value4->code."'/></td>";
                        $html .= "<td><input type='text' class='form-control' name='satuan_[".$start."]' value='".$value4->itempekerjaan->details->satuan."'/></td>";
                        $html .= "<td><input type='text' class='form-control ' name='nilai_[".$start."]' id='nilai_[".$start."]' value='' onkeyup='summary(".$start.")'/></td>";
                        $html .= "<td><span id='total_".$start."'></span></td>";
                        $html .= "</tr>";
                        $start++;  
                    }   
                                    
                }
            }else{
                $html .= "<tr>";
                $html .= "<td><strong>".$value3->code."</strong></td>";
                $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value3->id.")' data-attribute='1' id='btn_".$value3->id."'>".$value3->name."</td>";
                $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value3->id."'/><input type='hidden' class='form-control' name='code[".$start."]' value='".$value3->code."'/><input type='text' class='form-control' name='volume_[".$start."]' value='0'/></td>";
                $html .= "<td><input type='text' class='form-control ' name='satuan_[".$start."]' value='' required/></td>";
                $html .= "<td><input type='text' class='form-control nilai_budgets' name='nilai_[".$start."]' value=''/></td>";
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
        $rabunits->deleted_at = date("Y-m-d H:i:s.u");
        $rabunits->deleted_by = \Auth::user()->id;
        $status = $rabunits->save();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function savepekerjaan(Request $request){
        $budget_tahunan_id = BudgetTahunan::find($request->budget_tahunan_id);
        $rab  = Rab::find($request->rab);
        $no = $rab->no;
        $rab->budget_tahunan_id = $request->budget_tahunan_id;
        $rab->no = $no.$budget_tahunan_id->budget->pt->code;
        $rab->save();

        foreach ($request->item_id as $key => $value) {
            if ( $request->nilai_[$key] != "" && $request->volume_[$key] != "" ){
                $rabpekerjaan = new RabPekerjaan;
                $rabpekerjaan->rab_unit_id = $rab->id;
                $rabpekerjaan->itempekerjaan_id = $request->item_id[$key];
                $rabpekerjaan->nilai = str_replace(",", "", $request->nilai_[$key]);
                $rabpekerjaan->volume = $request->volume_[$key];
                $rabpekerjaan->satuan = $request->satuan_[$key];
                $rabpekerjaan->created_by  = \Auth::user()->id;
                $rabpekerjaan->save();
            }else{
                $rabpekerjaan = new RabPekerjaan;
                $rabpekerjaan->rab_unit_id = $rab->id;
                $rabpekerjaan->itempekerjaan_id = $request->item_id[$key];
                $rabpekerjaan->nilai =0;
                $rabpekerjaan->volume = 0;
                $rabpekerjaan->satuan = $request->satuan_[$key];
                $rabpekerjaan->created_by  = \Auth::user()->id;
                $rabpekerjaan->save();
            }
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
        $class  = "Rab";
        $approval = \App\Helpers\Document::make_approval('Modules\Rab\Entities\Rab',$rab);
        return response()->json( ["status" => "0"] );
    }

    public function childcoa(Request $request){
        $html = "";
        $budget = 0;
        $start = 0;
        $itempekerjaan = Itempekerjaan::find($request->id); 
        $workorder = Workorder::find($request->workorder);
        $budget_tahunan_id = "";
        $budget_tersisa = 0;
        $workorder_detail = WorkorderBudgetDetail::where("itempekerjaan_id",$request->id)->where("workorder_id",$request->workorder)->get();
        if ( count($workorder_detail) > 0 ){
            $budget_tahunan_id = $workorder_detail->first()->budget_tahunan_id;
            $budget = ($workorder_detail->first()->volume * $workorder_detail->first()->nilai);
        }
        $budget_tersisa = $budget - $workorder->rabs->where("budget_tahunan_id",$budget_tahunan_id)->where("parent_id",$request->id)->sum("nilai");

        foreach ( $itempekerjaan->child_item as $key3 => $value3 ){            
            
            /*$html .= "<tr>";
            $html .= 
            $html .= "<option value='".$value3->id."'>".$value3->code."-".$value3->name."</option>";*/
            if ( count($value3->child_item) > 0 ){
                $html .= "<tr>";
                $html .= "<td><strong>".$value3->code."</strong></td>";
                $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value3->id.")' data-attribute='1' id='btn_".$value3->id."'>".$value3->name."</td>";
                $html .= "<td>&nbsp;</td>";
                $html .= "<td>&nbsp;</td>";
                $html .= "<td>&nbsp;</td>";
                $html .= "</tr>";
                
                foreach ($value3->child_item as $key5 => $value5) {
                    if ( count($value5->child_item) > 0 ){

                        foreach ($value5->child_item as $key6 => $value6) {
                            if ( $value6->details != "" ){
                                $satuan = $value6->details->satuan;
                            }else{
                                $satuan = "ls";
                            }

                            $html .= "<tr>";
                            $html .= "<td><strong>".$value6->code."</strong></td>";
                            $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value6->id.")' data-attribute='1' id='btn_".$value6->id."'>".$value6->name."</td>";
                            $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value6->id."'/><input type='text' class='form-control' name='volume_[".$start."]' onkeyup='summary(".$start.")' value='0' autocomplete='off'/><input type='hidden' class='form-control' name='code[".$start."]' value='".$value6->code."' autocomplete='off'/></td>";
                            $html .= "<td><input type='text' class='form-control' name='satuan_[".$start."]' value='".$satuan."' autocomplete='off'/></td>";
                            $html .= "<td><input type='text' class='form-control nilai_budgets' name='nilai_[".$start."]' value=''  onkeyup='summary(".$start.")'/></td>";
                            $html .= "<td><span id='total_".$start."'></span></td>";
                            $html .= "</tr>";
                            $start++;  
                        }


                    }else{
                        if ( $value5->details != "" ){
                            $satuan = $value3->details->satuan;
                        }else{
                            $satuan = "ls";
                        }
                        $html .= "<tr>";
                        $html .= "<td><strong>".$value5->code."</strong></td>";
                        $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value5->id.")' data-attribute='1' id='btn_".$value5->id."'>".$value5->name."</td>";
                        $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value5->id."'/><input type='text' class='form-control' name='volume_[".$start."]' onkeyup='summary(".$start.")' value='0' autocomplete='off'/><input type='hidden' class='form-control' name='code[".$start."]' value='".$value5->code."' autocomplete='off'/></td>";
                        $html .= "<td><input type='text' class='form-control' name='satuan_[".$start."]' value='".$satuan."' autocomplete='off'/></td>";
                        $html .= "<td><input type='text' class='form-control nilai_budgets' name='nilai_[".$start."]' value=''  onkeyup='summary(".$start.")'/></td>";
                        $html .= "<td><span id='total_".$start."'></span></td>";
                        $html .= "</tr>";
                    }
                    
                    $start++;  
                }
            }else{
                if ( $value3->details != "" ){
                    $satuan = $value3->details->satuan;
                }else{
                    $satuan = "ls";
                }
                $html .= "<tr>";
                $html .= "<td><strong>".$value3->code."</strong></td>";
                $html .= "<td style='background-color: white;color:black;' onclick='showhide(".$value3->id.")' data-attribute='1' id='btn_".$value3->id."'>".$value3->name."</td>";
                $html .= "<td><input type='hidden' class='form-control' name='item_id[".$start."]' value='".$value3->id."'/><input type='hidden' class='form-control' name='code[".$start."]' value='".$value3->code."'/><input type='text' class='form-control' name='volume_[".$start."]' value='0' autocomplete='off'/></td>";
                $html .= "<td><input type='text' class='form-control ' name='satuan_[".$start."]' value='".$satuan."' autocomplete='off' required/></td>";
                $html .= "<td><input type='text' class='form-control nilai_budget' name='nilai_[".$start."]'value='' autocomplete='off'/></td>";
                $html .= "<td><span id='total_{{ $start }}' ></span></td>";
                $html .= "</tr>";
                $start++;
            }
            
        }
        return response()->json( ["status" => "0", "html" => $html, "budget" => $budget, "budget_tahunan_id" => $budget_tahunan_id, "budget_tersisa" => $budget_tersisa] );
    }

    public function deletepekerjaan(Request $request){
        $rab = Rab::find($request->id);
        foreach ($rab->pekerjaans as $key => $value) {
            $rab_pekerjaan = RabPekerjaan::find($value->id);
            $rab_pekerjaan->deleted_at = date("Y-m-d H:i:s.u");
            $rab_pekerjaan->deleted_by = \Auth::user()->id;
            $rab_pekerjaan->save();
        }

         return response()->json( ["status" => "0"] );
    }

    public function approval_history(Request $request){
        $rab = Rab::find($request->id);
        $approval = $rab->approval;
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        return view("rab::approval_history",compact("rab","approval","project","user"));
    }

    public function selectpekerjaan(Request $request){
        $rab = Rab::find($request->id);
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        return view("rab::rab_pekerjaan",compact("user","project","rab"));
    }

    public function generate(Request $Request){
        $rab = Rab::find(3488);
        $itempekerjaan = Itempekerjaan::find(292);
        $start = 0;
        foreach ($itempekerjaan->child_item as $key => $value) {
            if ( count($value3->child_item) > 0 ){
                foreach ($value3->child_item as $key5 => $value5) {
                    if ( count($value5->child_item) > 0 ){
                        foreach ($value5->child_item as $key6 => $value6) {
                            if ( $start >= 9 ){
                                $rabpekerjaan = new RabPekerjaan;
                                $rabpekerjaan->rab_unit_id = $rab->id;
                                $rabpekerjaan->itempekerjaan_id = $value6->id;
                                $rabpekerjaan->nilai = 0;
                                $rabpekerjaan->volume = 1;
                                $rabpekerjaan->satuan = 'm2';
                                $rabpekerjaan->created_by  = \Auth::user()->id;
                                $rabpekerjaan->save();
                            }
                            $start++;
                        }
                    }else{
                        if ( $start >= 9 ){
                            $rabpekerjaan = new RabPekerjaan;
                            $rabpekerjaan->rab_unit_id = $rab->id;
                            $rabpekerjaan->itempekerjaan_id = $value6;
                            $rabpekerjaan->nilai = 0;
                            $rabpekerjaan->volume = 1;
                            $rabpekerjaan->satuan = 'm2';
                            $rabpekerjaan->created_by  = \Auth::user()->id;
                            $rabpekerjaan->save();
                        }
                        $start++;
                    }
                }

            }else{

            }
        }
    }

    public function createtender(Request $request){
        $rab = Rab::find($request->id);
        if ( $rab->tenders->count() > 0 ){
            return redirect("/tender/detail/?id=".$rab->tenders->last()->id);
        }else{
            //echo $rab->units->last()->pekerjaans->last()->id;
            $itempekerjaan = Itempekerjaan::find($rab->pekerjaans->last()->itempekerjaan->parent->id);
            $department_from = $rab->workorder->department_from;
            $project = Project::find($request->session()->get('project_id'));
            $tender = new Tender;
            $tender_no = \App\Helpers\Document::new_number('TENDER', $department_from,$project->id).$rab->budget_tahunan->budget->pt->code;
            $tender->rab_id = $request->tender_rab;
            $tender->name = "Tender-".$itempekerjaan->code."-".$itempekerjaan->name."-".$rab->name;
            $tender->no = $tender_no;
            $tender->rab_id = $rab->id;
            $tender->save();

            if (!file_exists("./assets/tender/".$tender->id)) {
                mkdir("./assets/tender/".$tender->id);
            }

            foreach ($rab->units as $key => $value) {
                $tender_unit = new TenderUnit;
                $tender_unit->tender_id = $tender->id;
                $tender_unit->rab_unit_id = $value->id;
                $tender_unit->created_by = \Auth::user()->id;
                $tender_unit->save();
            }
            return redirect("/tender/detail/?id=".$tender->id);   
        }        
    }

    public function tender(Request $request){
        if ( count($rab->tenders) > 0 ){
            return redirect("/tender/detail/?id=".$rab->tenders->last()->id);
        }else{
            
            $rab = Rab::find($request->id);
            $itempekerjaan = Itempekerjaan::find($rab->pekerjaans->last()->itempekerjaan->parent->id);
            $department_from = $rab->workorder->department_from;
            $project = Project::find($request->session()->get('project_id'));
            $tender = new Tender;
            $tender_no = \App\Helpers\Document::new_number('TENDER', $department_from,$project->id).$rab->budget_tahunan->budget->pt->code;
            $tender->rab_id = $request->tender_rab;
            $tender->name = "Tender-".$itempekerjaan->code."-".$itempekerjaan->name."-".$rab->name;
            $tender->no = $tender_no;
            $tender->rab_id = $rab->id;
            $tender->save();

            if (!file_exists("./assets/tender/".$tender->id)) {
                mkdir("./assets/tender/".$tender->id);
            }

            foreach ($rab->units as $key => $value) {
                $tender_unit = new TenderUnit;
                $tender_unit->tender_id = $tender->id;
                $tender_unit->rab_unit_id = $value->id;
                $tender_unit->created_by = \Auth::user()->id;
                $tender_unit->save();
            }
            return redirect("/tender/detail/?id=".$tender->id);

        }
    }

    public function savelink(Request $request){
        $workorder_budget_detail_id = WorkorderBudgetDetail::find($request->id);
        $project = Project::find($request->session()->get('project_id'));
        $rab_no = \App\Helpers\Document::new_number('RAB', $workorder_budget_detail_id->workorder->department_from,$project->id);
        $rab = new Rab;
        $rab->no = $rab_no;
        $rab->workorder_id = $workorder_budget_detail_id->workorder->id;
        $rab->name = $workorder_budget_detail_id->workorder->name;
        $rab->created_by = \Auth::user()->id;
        $rab->workorder_budget_detail_id = $workorder_budget_detail_id->id;
        $rab->save();
        return redirect("/rab/detail?id=".$rab->id);
    }

}

<?php

namespace Modules\Workorder\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\Unit;
use Modules\Workorder\Entities\Workorder;
use Modules\Workorder\Entities\WorkorderBudgetDetail;
use Modules\Workorder\Entities\WorkorderDetail;
use Modules\Department\Entities\Department;
use Modules\Budget\Entities\BudgetTahunan;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\BudgetDraft\Entities\BudgetDraft;
use Modules\BudgetDraft\Entities\BudgetDraftDetail;
use Illuminate\Support\Facades\Mail;
use \App\Mail\OrderShipped;
use \App\Mail\EmailApproved;
use \App\Mail\EmailApproved2;
use Modules\Approval\Entities\Approval;
use Modules\Tender\Entities\TenderDocument;
use Storage;
use Modules\Project\Entities\ProjectKawasan;

class WorkorderController extends Controller
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
        //$workorder = $project->workorder;
        $workorder = $project->workorders;
        $itempekerjaan = Itempekerjaan::get();
        $department = Department::get();
        return view('workorder::index',compact("user","project","workorder","itempekerjaan","department"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));        
        return view('workorder::create',compact("project","user"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $work_order_no = \App\Helpers\Document::new_number('WO', $request->department_from,$project->id);
        $work_order = new Workorder;
        $work_order->budget_tahunan_id = $request->session()->get('project_id');
        $work_order->department_from = $request->department_from;
        $work_order->department_to = $request->department_to;
        $work_order->no = $work_order_no;
        $work_order->name = $request->workorder_name;
        $work_order->durasi = '0';
        $work_order->satuan_waktu = '0';
        $work_order->date = date("Y-m-d H:i:s.u");
        $work_order->estimasi_nilaiwo = '0';
        $work_order->description = $request->workorder_description;
        $work_order->created_by = \Auth::user()->id;
        $work_order->end_date = NULL;
        $status = $work_order->save();
        return redirect("/workorder/detail/?id=".$work_order->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $workorder = Workorder::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $department = Department::get();
        return view('workorder::detail',compact("workorder","project","user","department"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('workorder::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $work_order = Workorder::find($request->workorder_id);
        $work_order->department_from = $request->department_from;
        $work_order->department_to = $request->department_to;
        $work_order->name = $request->workorder_name;
        $work_order->description = $request->workorder_description;
        $work_order->date = date("Y-m-d",strtotime($request->start_date));
        $status = $work_order->save();
        return redirect("/workorder/detail/?id=".$request->workorder_id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function budgettahunan(Request $request){
        $project = $request->session()->get('project_id');
        $department_id = Department::find($require->department_id);
        $budgets = $department_id->budgets;
        $html = "";
        foreach ($budgets as $key => $value) {
            if ( $value->project_id == $request->session()->get('project_id')){
                foreach ($value->budget_tahunans as $key2 => $value2) {
                    if ( $value2->tahun_anggaran == date('Y')){
                        $html .= "<option value='".$value2->id."'>".$value->no."</option>";
                    }
                }
            }
        }
        return response()->json( ["status" => "0", "html" => $html] );
    }

    public function itempekerjaan(Request $request){
        $budgettahunan = BudgetTahunan::find($request->id);
        $html = "";

        foreach ($budgettahunan->total_parent_item as $key => $value) {
            if ( isset($value['nilai'])){
                //if ( count( \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value['id'])->get() ) > 0 ){
                    $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value['code'])->get()->first();
                    $html .= "<tr style='background-color:grey;color:white;font-weight:bolder;'>";
                    $html .= "<td>".$itempekerjaan->code."</td>";
                    $html .= "<td>".$itempekerjaan->name."</td>";
                    $html .= "<td>".number_format($value['nilai'])."</td>";
                    $html .= "<td>&nbsp;</td>";
                    $html .= "<td>&nbsp;</td>";
                    $html .= "<td>&nbsp;</td>";
                    $html .= "</tr>";
                    foreach ($itempekerjaan->child_item as $key2 => $value2) {
                        $html .= "<tr>";
                        $html .= "<td>".$value2->code."</td>";
                        $html .= "<td>".$value2->name."</td>";
                        $html .= "<td><input type='hidden' class='form-control nilai_budgets' value='".$value2->id."' name='item_id[".$key2."]'/></td>";
                        $html .= "<td><input type='text' class='form-control nilai_budgets' value='' name='nilai[".$key2."]'/></td>";
                        $html .= "<td><input type='text' class='form-control nilai_budgets' value='' name='volume[".$key2."]'/></td>";
                        $html .= "<td><input type='text' class='form-control' value='m2' name='satuan[".$key2."]' required/></td>";
                        $html .= "</tr>";
                    }
                //}
                
            }
            
        }
        return response()->json( ["status" => "0", "html" => $html] );
    }

    public function savepekerjaan (Request $request){

        if ( $request->setwo ){
            foreach ($request->setwo as $key => $value) {
                if ( $request->setwo[$key] != ""  && $request->volume[$value] != "" && $request->satuan[$value] != "" && $request->nilai[$value] != "" ){

                    $workorder = new WorkorderBudgetDetail;
                    $workorder->workorder_id = $request->workorder_id;
                    $workorder->budget_tahunan_id = $request->budget_tahunan;
                    $workorder->itempekerjaan_id = $request->item_id[$value];
                    $workorder->tahun_anggaran = date('Y');
                    $workorder->volume = str_replace(",", "",$request->volume[$value]);
                    $workorder->satuan = $request->satuan[$value];
                    $workorder->nilai = str_replace(",", "", $request->nilai[$value]);
                    $workorder->save();
                    
                }
            }
        }

        $budgettahunan = BudgetTahunan::find($request->budget_tahunan);
        if ( $budgettahunan->budget->project_kawasan_id == "" ){
            $WorkorderDetail = new WorkorderDetail;
            $WorkorderDetail->workorder_id = $request->workorder_id;
            $WorkorderDetail->asset_id = $budgettahunan->budget->project->id;
            $WorkorderDetail->asset_type = "Modules\Project\Entities\Project";
            $WorkorderDetail->save();
        }
        return redirect("/workorder/detail?id=".$request->workorder_id);
    }

    public function saveunits(Request $request){

        foreach ($request->asset as $key => $value) {
            if ( $request->asset[$key] != "" ){

                $asset_exist = WorkorderDetail::where("asset_id",str_replace("Unit_","",$request->asset[$key]))->where("workorder_id",$request->workorder_unit_id)->where("asset_type","Modules\Project\Entities\Unit")->get();
                
                if ( count($asset_exist) <= 0 ){
                    $explode = explode("_", $request->asset[$key]);
                    if ( count($explode) < 2 ){
                        $workorder_unit = new WorkorderDetail;
                        $workorder_unit->workorder_id = $request->workorder_unit_id;
                        $workorder_unit->asset_id = $request->asset[$key];
                        $workorder_unit->asset_type = "Modules\Project\Entities\Project";
                        $workorder_unit->description = 'auto';
                        $workorder_unit->save();
                    }else{
                        $workorder_unit = new WorkorderDetail;
                        $workorder_unit->workorder_id = $request->workorder_unit_id;
                        $workorder_unit->asset_id = str_replace("Unit_","",$request->asset[$key]);
                        $workorder_unit->asset_type = "Modules\Project\Entities\Unit";
                        $workorder_unit->description = 'auto';
                        $workorder_unit->save();
                    }
                }
            }
            
        }
        return redirect("/workorder/detail?id=".$request->workorder_unit_id);
    }

    public function deleteunit(Request $request){
        $workorder = WorkorderDetail::find($request->id);
        $status = $workorder->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function approve(Request $request){
        $workorder = Workorder::find($request->id);
        $approval = \App\Helpers\Document::make_approval('Modules\Workorder\Entities\Workorder',$workorder->id);
        
        return response()->json( ["status" => "0"] );
        
    }

    public function choosebudget(Request $request){
        $budget_tahunan = BudgetTahunan::find($request->budget_tahunan);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));    
        $workorder = Workorder::find($request->workoder_par_id);   
        return redirect("/workorder/non-budget?id=".$workorder->id."&budget=".$budget_tahunan->id); 
        //return view("workorder::detail_budget",compact("budget_tahunan","user","project","workorder"));
    }

    public function approval_history(Request $request){
        $workorder = Workorder::find($request->id);
        $approval = $workorder->approval;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));   
        return view("workorder::approval_history",compact("workorder","user","project"));
    }

    public function nonbudget(Request $request){
        $budget_tahunan = BudgetTahunan::find($request->budget);
        $workorder = Workorder::find($request->id);
        $budget = $budget_tahunan->budget;
        $itempekerjaan = Itempekerjaan::get();
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));    
        return view("workorder::item_non_budget",compact("workorder","user","project","budget_tahunan","itempekerjaan","budget"));
    }

    public function savenonbudget(Request $request){
        $budget_tahunan = BudgetTahunan::find($request->budget_tahunan);
        $budget_draft = BudgetDraft::find($budget_tahunan->budget->id);
        if ( $budget_draft == "" ){
            $budget_draft = new BudgetDraft;
            $budget_draft->budget_parent_id = $budget_tahunan->id;
            $budget_draft->workorder_id = $request->workorder_id;
            $budget_draft->no = $budget_tahunan->budget->no."/R".(count($budget_tahunan->budget->draft) + 1 );
            $budget_draft->created_by = \Auth::user()->id;
            $budget_draft->save();       
        }

        foreach ($request->item_id as $key => $value) {
            if ( $request->volume[$key] != "" && $request->nilai[$key] != "" ){
                $budget_draft_detail = new BudgetDraftDetail;
                $budget_draft_detail->budget_draft_id = $budget_draft->id;
                $budget_draft_detail->itempekerjaan_id = $request->item_id[$key];
                $budget_draft_detail->volume = str_replace(",", "",$request->volume[$key]);
                $budget_draft_detail->satuan = $request->satuan[$key];
                $budget_draft_detail->nilai  = str_replace(",", "",$request->nilai[$key]); 
                $budget_draft_detail->save();
            

                $workorder = new WorkorderBudgetDetail;
                $workorder->workorder_id = $request->workorder_id;
                $workorder->budget_tahunan_id = $budget_tahunan->id;
                $workorder->itempekerjaan_id = $request->item_id[$key];
                $workorder->tahun_anggaran = date('Y');
                $workorder->volume = str_replace(",", "",$request->volume[$key]);
                $workorder->satuan = $request->satuan[$key];
                $workorder->nilai = str_replace(",", "", $request->nilai[$key]);
                $workorder->save();
            }
        }

        $approval = \App\Helpers\Document::make_approval('Modules\BudgetDraft\Entities\BudgetDraft',$budget_draft->id);
        return redirect("workorder/detail?id=".$request->workorder_id);

    }

    public function updapprove(Request $request ){
        $workorder = Workorder::find($request->id);
        if ( $workorder->approval != "" ){
            $workorder_approval = \Modules\Approval\Entities\Approval::find($workorder->approval->id);
            $workorder_approval->approval_action_id = 1;
            $workorder_approval->save();

            foreach ($workorder->approval->histories as $key => $value) {
                $approval_history = \Modules\Approval\Entities\ApprovalHistory::find($value->id);
                $approval_history->approval_action_id = 1;
                $approval_history->save();
            }
        }
        return response()->json( ["status" => "0"] );
    }

    public function deletepekerjaan(Request $request){

        $workorder = WorkorderBudgetDetail::find($request->id);
        if ( $workorder->workorder->budget_draft != "" ){
            $draft_id = BudgetDraft::find($workorder->workorder->budget_draft->id);
            $draft_id->delete();
        }

        $status = $workorder->delete();

        

        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function getallunit(Request $request){
        $workorder = Workorder::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));    
        $array = array(
            "0" => "Planning - P&D",
            "1" => "Planning - EREMS",
            "3" => "Ready for Stock ( from Erem )",
            "5" => "Sold(from Erem)"
        );
        $limit_bangun = \Modules\Globalsetting\Entities\Globalsetting::where("parameter","limit_bangun")->first()->value;
        $standar_limit = $limit_bangun;
        $limit_bangun = '+'.$limit_bangun.'day';
        return view("workorder::workorder_unit",compact("workorder","project","user","array","limit_bangun","standar_limit"));
    }

    public function searchworkorder(Request $request){

    }

    public function itemdetail(Request $request){
        $itempekerjaan = Itempekerjaan::find($request->id);
        $html = "";
         foreach ($itempekerjaan->child_item as $key2 => $value2) {
            if ( $value2->details != "" ){
                $satuan = $value2->details->satuan;
            }else{
                $satuan = "";
            }

            $html .= "<tr>";
            $html .= "<td>".$value2->code."</td>";
            $html .= "<td>".$value2->name."</td>";
            $html .= "<td><input type='hidden' class='form-control nilai_budgets' value='".$value2->id."' name='item_id[".$key2."]'/>";
            $html .= "<input type='text' class='form-control nilai_budgets' value='' name='volume[".$key2."]' autocomplete='off'/></td>";
            $html .= "<td><input type='hidden' class='form-control' value='".$satuan."' name='satuan[".$key2."]' required/><input type='text' class='form-control' value='".$satuan."' autocomplete='off' disabled/></td>";
            $html .= "<td><input type='text' class='form-control nilai_budgets' value='' name='nilai[".$key2."]' autocomplete='off'/></td>";
            $html .= "</tr>";
        }

        return response()->json(["html" => $html, "status" => "0" ]);
    }

    public function search(Request $request){
        $array_params = array(
            "itempekerjaan" => $itempekerjaan->id,
            "judul_pekerjaan" => $judul_pekerjaan,
            "nilai" => $nilai,
            "params" => $params
        );
    }

    public function dokumen(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $workorder_pekerjaan = WorkorderBudgetDetail::find($request->id);
        return view("workorder::document",compact("user","workorder_pekerjaan","project"));
    }

    public function savedocument(Request $request){
        if (!file_exists ("./assets/workorder/".$request->rekanan_group_id )) {
            mkdir("./assets/workorder/".$request->rekanan_group_id);
            chmod("./assets/workorder/".$request->rekanan_group_id,0755);
        }

        $tender_document = new TenderDocument;
        $tender_document->tender_id = NULL;
        $tender_document->workorder_budget_id = $request->workorder_budget_id;
        $tender_document->document_name = $request->document_name;
        
        if ( $_FILES['upload']['name'] == "" ){
            $tender_document->filenames = $request->images;
        }else{
            $uploadedFile = $request->file('upload');  
            $type = $uploadedFile->getClientMimeType();

            $array_file = array(
                "application/msword",
                "application/pdf",
                "image/jpeg",
                "image/pjpeg",
                "image/png",
                "application/excel",
                "application/vnd.ms-excel",
                "application/x-excel",
                "application/x-msexcel"
            );

            $checkpdf = array_search($type, $array_file);
            if ( $checkpdf != "" ) {
                $pathpdf = $uploadedFile->store('public/workorder/'.$request->workorder_budget_id); 
                $tender_document->filenames = $pathpdf;
            }else{                
                return redirect("/workorder/dokument?id=".$request->workorder_budget_id);
            }
        }

        $tender_document->save();
        return redirect("/workorder/dokument?id=".$request->workorder_budget_id);
    }

    public function deletedocument(Request $request){
        $tender_document = TenderDocument::find($request->id);
        $tender_document->delete();

        return response()->json(["status" => "0"]);
    }

    public function downloaddoc(Request $request){
        $tender_document = TenderDocument::find($request->id);
        
        $headers = [
              'Content-Type' => 'application/pdf',
           ];

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function savequick(Request $request){
        
        if ( $request->unit != "" ){     
            $kawasan = "";
            

            $department = Department::find(2);
            $project = Project::find($request->session()->get('project_id'));

            $work_order_no = \App\Helpers\Document::new_number('WO', $department->id,$project->id);

            $work_order = new Workorder;
            $work_order->budget_tahunan_id = $project->id;
            $work_order->department_from = $department->id;
            $work_order->department_to = $department->id;
            $work_order->no = $work_order_no;
            $work_order->name = "Workorder Pembangunan Rumah";
            $work_order->durasi = '0';
            $work_order->satuan_waktu = '0';
            $work_order->date = date("Y-m-d H:i:s.u");
            $work_order->estimasi_nilaiwo = '0';
            $work_order->description = "Workorder Pembangunan Rumah";
            $work_order->created_by = \Auth::user()->id;
            $work_order->end_date = NULL;
            $status = $work_order->save();

            foreach ($request->unit as $key => $value) {
                $workorder_unit = new WorkorderDetail;
                $workorder_unit->workorder_id = $work_order->id;
                $workorder_unit->asset_id = $request->unit[$key];
                $workorder_unit->asset_type = "Modules\Project\Entities\Unit";
                $workorder_unit->description = 'Save Unit Sold Workorder Quick';
                $workorder_unit->save();
            }

            $array_type = array();

            foreach ($request->unit as $key => $value) {
                $unit = Unit::find($request->unit[$key]);
                if ( $unit->type != "" ){
                    if ( isset($array_type[$unit->type->id])){
                        $array_type[$unit->type->id]["bangunan_luas"] = $array_type[$unit->type->id]["bangunan_luas"] + $unit->bangunan_luas;
                    }else{
                        $array_type[$unit->type->id]["bangunan_luas"] = $unit->bangunan_luas;
                    }                    
                }

                if ( $unit->blok != "" ){
                    if ( $unit->blok->kawasan != "" ){
                        $project_kawasan_id = ProjectKawasan::find($unit->blok->kawasan->id);
                        foreach ($project_kawasan_id->budgets as $key => $value) {
                            if ( $value->deleted_at == "" ){
                                if ( $value->department_id == 2 ){
                                    foreach ($value->budget_tahunans as $key2 => $value2) {
                                        if ( $value2->tahun_anggaran == date("Y")){
                                            $array_type[$unit->type->id]["budget_tahunan"] = $value2->id;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            foreach ($array_type as $key => $value) {
                $workorder = new WorkorderBudgetDetail;
                $workorder->workorder_id = $work_order->id;
                $workorder->budget_tahunan_id = $value['budget_tahunan'];
                $workorder->itempekerjaan_id = 293;
                $workorder->tahun_anggaran = date('Y');
                $workorder->volume = $value['bangunan_luas'];
                $workorder->satuan = 'm2';
                $workorder->nilai = 0;
                $workorder->save();
            }

            return redirect("/workorder/detail?id=".$work_order->id);

        }else{
            return view("/workorder");
        }
    }

    public function updatepekerjaan(Request $request){
        $workorder_pekerjaan = WorkorderBudgetDetail::find($request->wokorder_detailpekerjaan_id);
        $workorder_pekerjaan->nilai = str_replace(",", "", $request->nilai);
        $workorder_pekerjaan->volume = str_replace(",", "", $request->volume);
        $workorder_pekerjaan->save();

        return redirect("workorder/detail?id=".$workorder_pekerjaan->workorder_id);
    }
}

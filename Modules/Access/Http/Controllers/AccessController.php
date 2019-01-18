<?php 
namespace Modules\Access\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use Modules\Project\Entities\Project;
use Modules\Budget\Entities\Budget;
use Modules\Budget\Entities\BudgetDetail;
use Modules\Budget\Entities\BudgetTahunanDetail;
use Modules\BudgetDraft\Entities\BudgetDraft;
use Modules\BudgetDraft\Entities\BudgetDraftDetail;
use Modules\Approval\Entities\ApprovalHistory;
use Modules\Workorder\Entities\Workorder;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Workorder\Entities\WorkorderBudgetDetail;
use Modules\Tender\Entities\Tender;
use Modules\Tender\Entities\TenderRekanan;
use Modules\Tender\Entities\TenderMenang;
use Modules\Tender\Entities\TenderMenangDetail;
use Modules\Tender\Entities\TenderKorespondensi;
use Modules\Tender\Entities\TenderDocument;
use Modules\Tender\Entities\TenderDocumentApproval;
use Modules\Approval\Entities\Approval;
use Modules\Spk\Entities\Spk;
use Modules\Vo\Entities\Vo;
use Modules\Project\Entities\ProjectKawasan;
use Modules\Blok\Entities\Blok;
use Modules\Project\Pekerjaan\Templatepekerjaan;
use Modules\Budget\Entities\BudgetTahunan;
use Modules\Budget\Entities\BudgetTahunanTemplate;
use Modules\Budget\Entities\BudgetTahunanDetailtemplate;
use Modules\Rab\Entities\Rab;
use Modules\Department\Entities\Department;
use Modules\Budget\Entities\HppUpdate;
use Modules\Budget\Entities\HppUpdateDetail;


class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }   


    public function project(Request $request){
        $project = Project::get();
        $user = \Auth::user();
        /* Get Budget Document */
        $approval = ApprovalHistory::where("user_id",$user->id)->where("approval_action_id",1)->get();
        $department = Department::get();
        return view("access::user.index",compact("approval","project","user","department"));
    }

    public function approval_summary(Request $request){
        $user = $request->user_id;
        $project = Project::find($request->project_id);

        /* Budget */
        $request_budget = 0;
        $approval_budget = 0;
        $rejected_budget = 0;
        foreach ($project->budgets as $key1 => $value1 ) {
            # code...
            $request_budget = $request_budget + $value1->approval->histories->where("user_id",$user)->where("approval_action_id",1)->count();
            $approval_budget = $approval_budget + $value1->approval->histories->where("user_id",$user)->where("approval_action_id",6)->count();
            $rejected_budget = $rejected_budget + $value1->approval->histories->where("user_id",$user)->where("approval_action_id",7)->count();
        }
        $total_request_budget = $request_budget + $approval_budget + $rejected_budget;

        /* Workorder */
        $request_workorder = 0;
        $approval_workorder = 0;
        $rejected_workoder = 0;
        foreach ($project->workorders as $key => $value) {
            # code...
            $request_workorder = $request_workorder + $value->approval->histories->where("user_id",$user)->where("approval_action_id",1)->count();
            $approval_workorder = $approval_workorder + $value->approval->histories->where("user_id",$user)->where("approval_action_id",6)->count();
            $rejected_workoder = $rejected_workoder + $value->approval->histories->where("user_id",$user)->where("approval_action_id",7)->count();
        }

        /* Tender Rekanan */
        $request_tender = 0;
        $approval_tender = 0;
        $rejected_tender = 0;
        $request_tender_rekanan = 0;
        $approval_tender_rekanan = 0;
        $rejected_tender_rekanan = 0;
        $tenders = $project->tenders->get();
        foreach ( $tenders as $key2 => $value2 ) {
            # code...
            $request_tender = $request_tender + $value2->approval->histories->where("user_id",$user)->where("approval_action_id",1)->count();
            $approval_tender = $approval_tender + $value2->approval->histories->where("user_id",$user)->where("approval_action_id",6)->count();
            $rejected_tender = $rejected_tender + $value2->approval->histories->where("user_id",$user)->where("approval_action_id",7)->count();
            foreach ($value2->rekanans as $key3 => $value3 ) {
                if (isset($value3->approval)){
                    $request_tender_rekanan = $request_tender_rekanan + $value3->approval->histories->where("user_id",$user)->where("approval_action_id",1)->count();
                    $approval_tender_rekanan = $approval_tender_rekanan + $value3->approval->histories->where("user_id",$user)->where("approval_action_id",6)->count();
                    $rejected_tender_rekanan = $rejected_tender_rekanan + $value3->approval->histories->where("user_id",$user)->where("approval_action_id",7)->count();
                }
            }
            $request_tender = $request_tender + $request_tender_rekanan;
            $approval_tender = $approval_tender + $approval_tender_rekanan;
            $rejected_tender = $rejected_tender + $rejected_tender_rekanan;

        }
        /*SPK*/
        $request_spk = 0;
        $approval_spk = 0;
        $rejected_spk = 0;

        foreach ($project->spks as $key4 => $value4) {
            # code...
            if (isset($value4->approval)){
                $request_spk = $request_spk + $value4->approval->histories->where("user_id",$user)->where("approval_action_id",1)->count();
                $approval_spk = $approval_spk + $value4->approval->histories->where("user_id",$user)->where("approval_action_id",6)->count();
                $rejected_spk = $rejected_spk + $value4->approval->histories->where("user_id",$user)->where("approval_action_id",7)->count();
            }
        }

        /* Budget Tahunan*/
        $request_budget_tahunan = 0;
        $approval_budget_tahunan = 0;
        $rejected_budget_tahunan = 0;
        foreach ($project->budget_tahunans as $key6 => $value6 ) {
            # code...
            $request_budget_tahunan = $request_budget_tahunan + $value6->approval->histories->where("user_id",$user)->where("approval_action_id",1)->count();
            $approval_budget_tahunan = $approval_budget_tahunan + $value6->approval->histories->where("user_id",$user)->where("approval_action_id",6)->count();
            $rejected_budget_tahunan = $rejected_budget_tahunan + $value6->approval->histories->where("user_id",$user)->where("approval_action_id",7)->count();
        }

        /* Budget Tahunan*/
        $request_rab = 0;
        $approval_rab = 0;
        $rejected_rab = 0;
        foreach ($project->rabs as $key7 => $value7 ) {
            # code...
            $request_rab = $request_rab + $value7->approval->histories->where("user_id",$user)->where("approval_action_id",1)->count();
            $approval_rab = $approval_rab + $value7->approval->histories->where("user_id",$user)->where("approval_action_id",6)->count();
            $rejected_rab = $rejected_rab + $value7->approval->histories->where("user_id",$user)->where("approval_action_id",7)->count();
        }

        $total_request_budget_tahunan = $request_budget_tahunan + $approval_budget_tahunan + $rejected_budget_tahunan;
        $total_request_workorder = $request_workorder + $approval_workorder + $rejected_workoder;
        $total_request_rab = $request_rab + $approval_rab + $rejected_rab;
        $total_request_tender = $request_tender + $approval_tender + $rejected_tender;
        $total_request_spk = $request_spk + $approval_spk + $rejected_spk;

        return response()->json( [
            "request_budget" => $request_budget, "approval_budget" => $approval_budget, "rejected_budget" => $rejected_budget, "total_request_budget" => $total_request_budget, 
            "request_workorder" => $request_workorder, "approval_workorder" => $approval_workorder, "rejected_workoder" => $rejected_workoder, "total_request_workorder" => $total_request_workorder, 
            "total_request_tender" => $total_request_tender, "request_tender" => $request_tender, "approval_tender" => $approval_tender, "rejected_tender" => $rejected_tender, 
            "total_request_spk" => $total_request_spk, "request_spk" => $request_spk, "approval_spk" => $approval_spk, "rejected_spk" => $rejected_spk, 
            "total_request_budget_tahunan" => $total_request_budget_tahunan, "request_budget_tahunan" => $request_budget_tahunan, "approval_budget_tahunan" => $approval_budget_tahunan, "rejected_budget_tahunan" => $rejected_budget_tahunan, "total_request_rab" => $total_request_rab,  "approval_rab" => $approval_rab, "rejected_rab" => $rejected_rab, "request_rab" => $request_rab]); 
    }

    public function budget(Request $request){
        
        $budget = Budget::find($request->id);
        $project = $budget->project;
        $user = \Auth::user();
        $approval = $budget->approval;
        $effisiensi_netto = 0;
        if ( $budget->project->netto > 0 ){
            $effisiensi_netto = $budget->total_devcost / $budget->project->netto;
        }
        return view("access::user.budgets",compact("budget","project","user","approval","effisiensi_netto"));
    }

    public function budget_detail(Request $request){
        $budget = Budget::find($request->id);
        $approval = $budget->approval;
        $user = \Auth::user();
        $project = $budget->project_id;
        $effisiensi_netto = 0;
        if ( $budget->project->netto > 0 ){
            $effisiensi_netto = $budget->total_devcost / $budget->project->netto;
        }
        return view("access::user.budgets",compact("budget","project","user","approval","effisiensi_netto"));
        
    }

    public function budget_approval(Request $request){
        foreach ($request->budget_id as $key => $value) {
            # code...
            $approva_history_id = ApprovalHistory::where("document_id",$request->input('budget_id.'.$key.'.value'))->where("document_type","App\Budget")->where("user_id",$request->user_id)->get()->first();
            $approva_history = ApprovalHistory::find($approva_history_id->id);
            $approva_history->approval_action_id = $request->status;
            $approva_history->description = $request->input('description.'.$key.'.value');
            $status = $approva_history->save();

            $budget = Budget::find($request->input('budget_id.'.$key.'.value'));
            $highest = $budget->approval->histories->min("no_urut");
            if ( $approva_history->no_urut == $highest){        
                $approval_ac = Approval::find($budget->approval->id);
                $approval_ac->approval_action_id = $request->status;
                $approval_ac->save();

                if ( $request->status == "6" ){
                    if ( count($budget->project->hpp_update) > 0 ){
                        $luas_book = $budget->project->hpp_update->last()->luas_book;
                        $luas_erem = $budget->project->hpp_update->last()->luas_erem;
                    }else{
                        $luas_erem = 0;
                        $luas_book = 0;
                    }

                    $hpp_update = new HppUpdate;
                    $hpp_update->project_id = $budget->project_id;
                    $hpp_update->nilai_budget = $budget->project->total_budget_dev_cost;
                    $hpp_update->luas_book = $luas_book;
                    $hpp_update->luas_erem = $luas_erem;
                    $hpp_update->netto = $budget->project->netto;
                    if ( $budget->project->netto > 0 ){
                        $hpp_update->hpp_book = $budget->project->total_budget_dev_cost / $budget->project->netto;
                    }else{
                        $hpp_update->hpp_book = 0.0;
                    }

                    if ( $budget->project->hpp_update != "" ){
                        $hpp_update->hpp_book_before = $budget->project->hpp_update->last()->hpp_book;
                    }else{
                        $hpp_update->hpp_book_before = 0;
                    }

                    foreach ($budget->project->budgets as $key => $value) {                        
                        $hpp_update_detail = new HppUpdateDetail;
                        $hpp_update_detail->hpp_update_id = $hpp_update->id;
                        $hpp_update_detail->budget_id = $value->id;
                        $hpp_update_detail->save();
                    }

                }
            }
        }

        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function approval_budget_awal(Request $request){
        $budget_id = Budget::find($request->budget_id);
        $user_id = $request->user_id;
        $status = $request->status;

        $document = $budget_id->approval->histories;
        $approval_id = $document->where("user_id",$user_id)->first();
        $highest = $budget_id->approval->histories->min("no_urut");

        if ( isset($approval_id->id)){
            $approval_history = ApprovalHistory::find($approval_id->id);
            $approval_history->approval_action_id = $status;
            $status = $approval_history->save();
            
            if ( $approval_history->no_urut == $highest){       
                $approval_ac = Approval::find($budget_id->approval->id);
                $approval_ac->approval_action_id = $request->status;
                $approval_ac->save();
            }

            if ( $status ){
                return response()->json( ["status" => "0"] );
            }else{
                return response()->json( ["status" => "1"] );
            }
        }else{
            return response()->json( ["status" => "1"] );
        }
        
    }

    public function budget_faskot(Request $request){
        $budget_id = BudgetTahunan::find($request->budget_id);
        $user_id = $request->user_id;
        $status = $request->status;

        $document = $budget_id->approval->histories;
        $approval_id = $document->where("user_id",$user_id)->first();
        $highest = $budget_id->approval->histories->min("no_urut");

        if ( isset($approval_id->id)){
            $approval_history = ApprovalHistory::find($approval_id->id);
            $approval_history->approval_action_id = $status;
            $status = $approval_history->save();
            
            if ( $approval_history->no_urut == $highest){       
                $approval_ac = Approval::find($budget_id->approval->id);
                $approval_ac->approval_action_id = $request->status;
                $approval_ac->save();
            }

            if ( $status ){
                return response()->json( ["status" => "0"] );
            }else{
                return response()->json( ["status" => "1"] );
            }
        }else{
            return response()->json( ["status" => "1"] );
        }
        
    }

    public function workorder(Request $request){
        $user    = \Auth::user();
        $workorders = Workorder::find($request->id);
        $project = $workorders->project->first();
        return view("access::user.workoder",compact("project","user","workorders"));
    }

    public function workorder_detail( Request $request){
        $workorder = Workorder::find($request->id);
        $pekerjaan = $workorder->detail_pekerjaan;
        $project = $workorder->project;
        $user    = \Auth::user();
        $approval = $workorder->approval;
        $workorder_unit = $workorder->details->where("asset_type","Modules\Project\Entities\Unit");
        $devcost = 0;
        
        foreach ($workorder_unit as $key => $value) {
            # code...
            //$devcost = $devcost + $value->asset->templatepekerjaan->con_cost ;
        }

        return view("access::user.workoder_detail",compact("workorder","pekerjaan","project","user","workorder_unit","devcost","approval"));
    }

    public function workorder_approval(Request $request){
        $approval_id = Workorder::find($request->workorder_id)->approval;

        $approva_history_id = ApprovalHistory::where("approval_id",$approval_id->id)->where("user_id",$request->user_id)->get()->first();
        $approva_history = ApprovalHistory::find($approva_history_id->id);
        $approva_history->approval_action_id = $request->status;
        $approva_history->description = $request->description;
        $status = $approva_history->save();

        $highest = $approval_id->histories->min("no_urut");
        if ( $approva_history_id->no_urut == $highest){     
            $approval_ac = Approval::find($approval_id->id);
            $approval_ac->approval_action_id = $request->status;
            $approval_ac->save();
        }

        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function itemdetail(Request $request){
        $item = Itempekerjaan::find($request->parent_id);

        $itempekerjaan = Itempekerjaan::where("parent_id",$request->parent_id)->get();
        $html = "";
        $nilai = 0;
        foreach ( $itempekerjaan as $key => $value ){
            $detailitem = Itempekerjaan::find($value->id);
            $unitworkorder = WorkorderBudgetDetail::where("itempekerjaan_id",$value->id)->where("workorder_id",$request->workorder)->get()->first();
            if (isset($unitworkorder->volume)){
                $html .= "<tr>";
                $html .= "<td>".$detailitem->code."</td>";
                $html .= "<td>".$detailitem->name."</td>";
                $html .= "<td>".number_format($unitworkorder->volume)."</td>";
                $html .= "<td>".$unitworkorder->satuan."</td>";
                $html .= "<td>".number_format($unitworkorder->nilai)."</td>";
                $html .= "<td>".number_format($unitworkorder->nilai * $unitworkorder->volume)."</td>";
                $html .= "</tr>";
                $nilai = $nilai + ($unitworkorder->nilai * $unitworkorder->volume);
            }
        }
        $html .= "<tr>";
        $html .= "<td colspan='5' style='text-align:right;'><i>Total</i></td>";
        $html .= "<td><strong>".number_format($nilai)."</strong></td>";
        $html .= "</tr>";
        return response()->json( ["html" => $html, "coa" => $item->code, "dept" => $item->department->name, "names" => $item->name ] );
    }

    public function tender(Request $request){
        $project = Project::find($request->id);
        $tenders = $project->tenders->get();
        $user = \Auth::user();
        $request_tender = 0;
        $approval_tender = 0;
        $rejected_tender = 0;
        $request_tender_rekanan = 0;
        $approval_tender_rekanan = 0;
        $rejected_tender_rekanan = 0;

        foreach ( $tenders as $key2 => $value2 ) {
        # code...
        $request_tender = $request_tender + $value2->approval->histories->where("user_id",$user)->where("approval_action_id",1)->count();
        $approval_tender = $approval_tender + $value2->approval->histories->where("user_id",$user)->where("approval_action_id",6)->count();
        $rejected_tender = $rejected_tender + $value2->approval->histories->where("user_id",$user)->where("approval_action_id",7)->count();
        foreach ($value2->rekanans as $key3 => $value3 ) {
            if (isset($value3->approval)){
                $request_tender_rekanan = $request_tender_rekanan + $value3->approval->histories->where("user_id",$user->id)->where("approval_action_id",1)->count();
                $approval_tender_rekanan = $approval_tender_rekanan + $value3->approval->histories->where("user_id",$user->id)->where("approval_action_id",6)->count();
                $rejected_tender_rekanan = $rejected_tender_rekanan + $value3->approval->histories->where("user_id",$user->id)->where("approval_action_id",7)->count();

            }
        }
        $request_tender = $request_tender + $request_tender_rekanan;
        $approval_tender = $approval_tender + $approval_tender_rekanan;
        $rejected_tender = $rejected_tender + $rejected_tender_rekanan;

        }

        return view("access::user.tender",compact("project","tenders","user","request_tender"));
    }

    public function tender_detail(Request $request){
        $tender = Tender::find($request->id);
        $user = \Auth::user();
        $project = $tender->rab->workorder->project;
        $approval = $tender->approval;

        $request_tender_rekanan = 0;
        $approval_tender_rekanan = 0;
        $rejected_tender_rekanan = 0;
        $approval_id = "";
        foreach ($tender->rekanans as $key3 => $value3 ) {
            if (isset($value3->approval)){
                $request_tender_rekanan = $request_tender_rekanan + $value3->approval->histories->where("user_id",$user->id)->where("approval_action_id",1)->count();
                $approval_tender_rekanan = $approval_tender_rekanan + $value3->approval->histories->where("user_id",$user->id)->where("approval_action_id",6)->count();
                $rejected_tender_rekanan = $rejected_tender_rekanan + $value3->approval->histories->where("user_id",$user->id)->where("approval_action_id",7)->count();
                if ( $request_tender_rekanan > 0 ){
                    $approval_id .= $value3->approval->id .",";
                }
            }

        }
        
        if ( $approval_id !== "" ){
            $approval_id = trim($approval_id,",");
        }

        $jabatan = $user->jabatan;
        
        return view("access::user.tender_detail",compact("project","tender","user","approval","request_tender_rekanan","approval_tender_rekanan","rejected_tender_rekanan","approval_id"));
    }

    public function tender_workorder_detail( Request $request){
        $workorder = Workorder::find($request->id);
        $pekerjaan = $workorder->detail_pekerjaan;
        $project = $workorder->project;
        $user    = \Auth::user();
        $tender  = Tender::find($request->tender);
        return view("access::user.tender_workorder_detail",compact("workorder","pekerjaan","project","user","tender"));
    }

    public function tender_penawaran(Request $request){
        $tender = Tender::find($request->tender_id);
        $rekanan = $tender->rekanans->where("rekanan_id",$request->rekanan_id)->first();
        $html = "";
        $html .= "<tr>";
        foreach ($rekanan->penawarans as $key => $value) {
            # code...
            $html .= "<td>".number_format($value->nilai)."</td>";
        }
        $html .= "</tr>";
        return response()->json( ["html" => $html] );
    }

    public function rekanan_approve(Request $request){
        $approval_value = trim(str_replace("%3C%3E", "<>", str_replace("%3D", "=", $request->apporval_value)),"==");
        $explode_value = explode("==", $approval_value);
        $highest = Approval::find($request->approval_id)->histories->min("no_urut");
        $user    = \Auth::user();
        for ( $i=0; $i < count($explode_value); $i++ ){
            $explode_detail = explode("<>",$explode_value[$i]);
            $approval = ApprovalHistory::where("approval_id",$explode_detail[0])->where("user_id",$user->id)->first();
            $approval_history = ApprovalHistory::find($approval->id);
            $approval_history->approval_action_id = $explode_detail[1];
            $approval_history->description = $request->input('description.'.$i.'.value');
            $approval_history->save();
            $highest = $approval_history->approval->histories->min("no_urut");
            
            if ( $highest == $approval_history->no_urut ){
                $approval_ac = Approval::find($approval_history->approval->id);
                $approval_ac->approval_action_id = $explode_detail[1];
                $approval_ac->save();
                $tender_rekanan_id = $approval_ac->document;

                if ( $explode_detail[1] == "6" ){
                    $tender_koresponden                     = new TenderKorespondensi;
                    $tender_koresponden->tender_rekanan_id  = $tender_rekanan_id->id;
                    $tender_koresponden->no                 = "";
                    $tender_koresponden->type               = "udg";
                    $tender_koresponden->date               = date("Y-m-d H:i:s");
                    $tender_koresponden->diundang_at        = $tender_rekanan_id->tender->aanwijzing_date;
                    $tender_koresponden->tempat_undangan    = "";
                    $tender_koresponden->due_at             = date("Y-m-d H:i:s");
                    $tender_koresponden->save();
                }
            }            
        }

        return response()->json( ["status" => "0"] );
    }

    public function spk(Request $request){
        $project = Project::find($request->id);
        $user = \Auth::user();
        $spks = $project->spks;

        /*SPK*/
        $request_spk = 0;
        $approval_spk = 0;
        $rejected_spk = 0;

        foreach ($project->spks as $key4 => $value4) {
            # code...
            if (isset($value4->approval)){
                $request_spk = $request_spk + $value4->approval->histories->where("user_id",$user->id)->where("approval_action_id",1)->count();
                $approval_spk = $approval_spk + $value4->approval->histories->where("user_id",$user->id)->where("approval_action_id",6)->count();
                $rejected_spk = $rejected_spk + $value4->approval->histories->where("user_id",$user->id)->where("approval_action_id",7)->count();
            }
        }

        return view("access::user.spk",compact("project","user","spks","request_spk"));
    }

    public function spk_detail(Request $request){
        $user = \Auth::user();
        $spk  = Spk::find($request->id);
        $project = Project::find($spk->project_id);
        $approval = $spk->approval->histories->where("user_id",$user->id)->first();
        if ( $approval->approval_action_id == "1" ){
            $status = "";
        }else if ( $approval->approval_action_id == "6" ){
            $status = "<span class='badge bg-success' style='font-size:20px;'>Approve</span>";
        }else {
            $status = "<span class='badge bg-danger' style='font-size:20px;'>Reject</span>";
        }
        return view("access::user.spk_detail",compact("project","user","spk","status")); 
    }

    public function spk_approve(Request $request){
        $spk = Spk::find($request->spk_id);
        $approval = $spk->approval;
        $approva_history_id = ApprovalHistory::where("approval_id",$approval->id)->where("user_id",$request->user_id)->get()->first();
        $approval_history = ApprovalHistory::find($approva_history_id->id);
        $approval_history->approval_action_id = $request->approve;
        $approval_history->description = $request->description;
        $approval_history->save();
        
        $highest = $approval->histories->min("no_urut");
        if ( $approva_history_id->no_urut == $highest){     
            $approval_ac = Approval::find($approval->id);
            $approval_ac->approval_action_id = $request->approve;
            $approval_ac->save();
        }
        return response()->json( ["status" => "0"] );
    }

    public function vo(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->id);
        return view("access::user.vo",compact("project","user"));
    }

    public function vo_detail(Request $request){
        $user = \Auth::user();
        $vo = Vo::find($request->id);
        $project = $vo->spk->project;
        return view("access::user.vo_detail",compact("project","user","vo"));
    }

    public function budget_unit(Request $request){
        $project_kawasan = ProjectKawasan::find($request->id);
        $project = Project::find($project_kawasan->project_id);
        $user = \Auth::user();
        $budgets = $project_kawasan->budgets->first();
        return view("access::user.budget_unit",compact("project_kawasan","project","user","budgets"));
    }

    public function detail_unit(Request $request){
        $blok = Blok::find($request->id);
        $template = $blok->template_pekerjaan;
        $user = \Auth::user();
        return view("access::user.budget_template",compact("template","user","blok"));
    }

    public function template_unit(Request $request){
        $template = Templatepekerjaan::find($request->id);
        $user = \Auth::user();
        $blok = Blok::find($request->blok);
        return view("access::user.template_pekerjaan",compact("template","user","blok"));
    }

    public function budget_tahunan(Request $request){
        $array_cashflow = array();
        $budget_tahunan = BudgetTahunan::find($request->id);
        $budget_parent = $budget_tahunan->budget->parent_id;
        if ( $budget_parent != "" ){

        $budget_parent = Budget::find($budget_parent);
        $budget_devcost = $budget_parent->id;
        }else{
            $budget_devcost = $budget_tahunan->budget->id;
        }
        $array_carryover = array();
        $project = $budget_tahunan->project;
        $user = \Auth::user();
        $approval = $budget_tahunan->approval;
        $effisiensi_netto = 0;
        $nilai_sum_temp = 0;
        $start = 0;
        if ( $budget_tahunan->project->netto > 0 ){
            $effisiensi_netto = $budget_tahunan->total_devcost / $budget_tahunan->project->netto;
        }

        if ( $budget_tahunan->budget->kawasan != "" ){
            $asset_id = $budget_tahunan->budget->project_kawasan_id;
        }else{
            $asset_id = $budget_tahunan->budget->project_id;
        }

        $spk = $budget_tahunan->budget->project->spks;
        foreach ($spk as $key => $value) {
            # code...
            $spk = \Modules\Spk\Entities\Spk::find($value->id);
            $nilai = $spk->nilai;
            if ( ($spk->progresses != "" )) {
                if ( isset($spk->progresses->first()->itempekerjaan)) {
                    $pekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$spk->progresses->first()->itempekerjaan->parent->code)->get()->first();
                    if ( isset($pekerjaan->group_cost)){
                        $budgetdetail = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$pekerjaan->id)->where("budget_id",$budget_devcost)->get();
                        if ( count($budgetdetail) > 0 ){ 
                            $exp = explode("/", $spk->no);  
                            if ( $exp[5] == "17"){     
                                //if ( ($spk->nilai - round($spk->nilai_bap)) > 0 ){
                                    $array_cashflow[$start] = array(
                                        "nospk" => $spk->no,
                                        "nilaispk" => $spk->nilai,
                                        "bap" =>$spk->nilai_bap,
                                        "sisa" => ($spk->nilai - ($spk->nilai_bap)),
                                        "id" => $spk->id,
                                        "coa" => $spk->itempekerjaan->code.".00.00",
                                        "pekerjaan" => $spk->itempekerjaan->name
                                    );
                                $start++; 
                             }           
                        }else{
                            $nilai_sum_temp = $nilai_sum_temp + $spk->nilai;
                            
                        }                     
                    }                                       
                    
                }
                
            }
            
        }

        $carry_over = 0;
        $total_nilaasi = 0;
        if ( $array_cashflow != "" ){
            foreach ($array_cashflow as $key => $value) {
                $carry_over = $value["sisa"] + $carry_over;
                $total_nilaasi = $value["nilaispk"] +  $total_nilaasi;
            }
        }

        foreach ($budget_tahunan->carry_over as $key => $value) {
            $array_carryover[$key] = array(
                "no_spk" => $value->spk->no,
                "pekerjaan" => $value->spk->name,
                "nilai_spk" => $value->nilai,
                "terbayar" => $value->spk->nilai_bap,
                "sisa" => $value->spk->nilai - $value->spk->nilai_bap,
                "januari" => $value->januari,
                "februari" => $value->februari,
                "maret" => $value->maret,
                "april" => $value->april,
                "mei" => $value->mei,
                "juni" => $value->juni,
                "juli" => $value->juli,
                "agustus" => $value->agustus,
                "september" => $value->september,
                "oktober" => $value->oktober,
                "november" => $value->november,
                "desember" => $value->desember
            );
        }

        $array = array(
            "januari" => 0,
            "februari" => 0,
            "maret" => 0,
            "april" => 0,
            "mei" => 0,
            "juni" => 0,
            "juli" => 0,
            "agustus" => 0,
            "september" => 0,
            "oktober" => 15000000,
            "november" => 15000000,
            "desember" => 15000000
        );
        

        $array_monthly_cf = "";
        foreach ($budget_tahunan->monthly_cash_flow as $key => $value) {
            $array_monthly_cf .= $value .",";
        }
        $array_monthly_cf = trim($array_monthly_cf,",");

        $array_monthly_co = "";
        foreach ($budget_tahunan->monthly_budget_unit as $key => $value) {
            $array_monthly_co .= $value .",";
        }
        $array_monthly_co = trim($array_monthly_co,",");

        $array_monthly_total = "";

        foreach ($array as $key => $value) {
            $array_monthly_total .= $value .",";
        }

        $nilai_sisa_dev_cost = 0;
        $nilai_sisa_con_cost = 0;
        $spk = $budget_tahunan->budget->project->spks;
        foreach ($spk as $key => $value) {
            if ( $value->date->format("Y") <= date("Y")){
                if ( $value->itempekerjaan->group_cost == 1 ){
                    if ( $value->details != "" ){
                        foreach ($value->details as $key2 => $value2) {
                            if ( $value2->asset->id == $asset_id ){
                                if ( $value->baps != "" ){
                                    $bayar = $value->baps->sum("nilai_bap_2");
                                }else{
                                    $bayar = 0;
                                }

                                $sisa = $value->nilai - $bayar;
                                if ( $sisa > 0 ){
                                    $nilai_sisa_dev_cost = $sisa + $nilai_sisa_dev_cost;  
                                }                         
                            }
                        }
                    }
                }else{
                    if ( $value->tender->rab != "" ){
                        if ( $value->tender->rab->budget_tahunan != "" ){
                            if ( $value->tender->rab->budget_tahunan->budget->project_kawasan_id == $asset_id ){
                                if ( $value->baps != "" ){
                                    $bayar = $value->baps->sum("nilai_bap_2");
                                }else{
                                    $bayar = 0;
                                }

                                $sisa = $value->nilai - $bayar;
                                if ( $sisa > 0 ){
                                    $nilai_sisa_con_cost = $sisa + $nilai_sisa_con_cost;  
                                } 
                            }
                        }
                    }
                }   
            }                        
        }

        return view("access::user.budget_tahunan_detail",compact("budget_tahunan","project","user","approval","effisiensi_netto","array_carryover","array_cashflow","carry_over","total_nilaasi","array_monthly_cf","array_monthly_co","array_monthly_total","nilai_sisa_dev_cost","nilai_sisa_con_cost"));
    }

    public function budget_tahunan_approval(Request $request){
        $budget_id = BudgetTahunan::find($request->budget_id);
        $user_id = $request->user_id;
        $status = $request->status;

        $document = $budget_id->approval->histories;
        $approval_id = $document->where("user_id",$user_id)->first();
        if ( isset($approval_id->id)){
            $approval_history = ApprovalHistory::find($approval_id->id);
            $approval_history->approval_action_id = $status;
            $approval_history->description = $request->description;
            $approval_history->save();

            $highest = $budget_id->approval->histories->min("no_urut");
            if ( $approval_history->no_urut == $highest){     
                $approval_ac = Approval::find($budget_id->approval->id);
                $approval_ac->approval_action_id = $status;
                $status = $approval_ac->save();
            }
            if ( $status ){
                return response()->json( ["status" => "0"] );
            }else{
                return response()->json( ["status" => "1"] );
            }
        }else{
            return response()->json( ["status" => "1"] );
        }
        
    }

    public function rab(Request $request){
        $project = Project::find($request->id);
        $rab = $project->rabs;
        $user = \Auth::user();
        return view("access::user.rab",compact("rab","project","user"));
    }

    public function rab_detail(Request $request){
        $rab = Rab::find($request->id);
        $user = \Auth::user();
        $approval = $rab->approval;
        return view("access::user.rab_detail",compact("rab","user","approval"));
    }

    public function rab_approval(Request $request){
        $rab = Rab::find($request->rab_id);
        $user_id = $request->user_id;
        $status = $request->status;

        $document = $rab->approval->histories;
        $approval_id = $document->where("user_id",$user_id)->first();
        if ( isset($approval_id->id)){
            $approval_history = ApprovalHistory::find($approval_id->id);
            $approval_history->approval_action_id = $status;
            $approval_history->save();
            //$status = $approval_history->save();

            $highest = $rab->approval->histories->min("no_urut");
            if ( $approval_history->no_urut == $highest){     
                $approval_ac = Approval::find($rab->approval->id);
                $approval_ac->approval_action_id = $status;
                $status = $approval_ac->save();
            }

            if ( $status ){
                return response()->json( ["status" => "0"] );
            }else{
                return response()->json( ["status" => "1"] );
            }
        }else{
            return response()->json( ["status" => "1"] );
        }
        
    }

    public function tender_menang(Request $request){
        
        $tenderRekanan = TenderRekanan::find($request->id);
        $tender = $tenderRekanan->tender;
        $menangs = $tender->menangs;
        foreach ($menangs as $key4 => $value4) {
            $tenderMenang = TenderMenang::find($value4->id);
            $tenderMenang->tender_rekanan_id = $request->id;
            $tenderMenang->save();

        }

        foreach ($tender->rekanans as $key => $value) {

            $rekanan = TenderRekanan::find($value->id);
            if ( $value->id == $request->id ){                
                $rekanan->is_pemenang = "2";    
                $tender_koresponden                     = new TenderKorespondensi;
                $tender_koresponden->tender_rekanan_id  = $value->id;
                $tender_koresponden->no                 = "";
                $tender_koresponden->type               = "sipp";
                $tender_koresponden->date               = date("Y-m-d H:i:s");
                $tender_koresponden->diundang_at        = date("Y-m-d H:i:s");
                $tender_koresponden->tempat_undangan    = "";
                $tender_koresponden->due_at             = date("Y-m-d H:i:s");
                $tender_koresponden->save();            
            }else{
                if ( $value->is_pemenang != "1"){
                    $rekanan->is_pemenang = "3";
                }
                $tender_koresponden                     = new TenderKorespondensi;
                $tender_koresponden->tender_rekanan_id  = $value->id;
                $tender_koresponden->no                 = "";
                $tender_koresponden->type               = "sutk";
                $tender_koresponden->date               = date("Y-m-d H:i:s");
                $tender_koresponden->diundang_at        = date("Y-m-d H:i:s");
                $tender_koresponden->tempat_undangan    = "";
                $tender_koresponden->due_at             = date("Y-m-d H:i:s");
                $tender_koresponden->save();            
            }
            $rekanan->save();
            
        }
        

        $approval = $tender->approval;
        foreach ($approval->histories as $key => $value) {
            if ( $value->user_id == $request->user_id){
                $approval_history = ApprovalHistory::find($value->id);        
                $approval_history->approval_action_id = "6";
                $approval_history->save();
            }
            $highest = $approval->histories->min("no_urut");
            if ( $value->no_urut == $highest){     
                $approval_ac = Approval::find($approval->id);
                $approval_ac->approval_action_id = "6";
                $status = $approval_ac->save();

                

            }
        }

        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function tender_rab_detail(Request $request){
        $rab = Rab::find($request->id);
        $user = \Auth::user();
        $tender = Tender::find($request->tender);
        return view("access::user.tender_rab_detail",compact("rab","user","tender"));
    }

    public function tender_approved(Request $request){
        $tender = Tender::find($request->tender_id);
        $status = $request->status;
        $user   = $request->user_id;
        $approval = $tender->approval;
        $highest = $approval->histories->min("no_urut");


        $approval_history = $approval->histories->where("user_id",$user)->first();
        $approval_history_id = ApprovalHistory::find($approval_history->id);
        $approval_history_id->approval_action_id = $status ;
        $status = $approval_history_id->save();

        if ( $approval_history->no_urut == $highest){       
            $approval_ac = Approval::find($approval->id);
            $approval_ac->approval_action_id = $request->status;
            $approval_ac->save();
        }


        $approval_value = trim($request->rekanan,"==");
        $explode_value = explode("==", $approval_value);
        for ( $i=0; $i < count($explode_value); $i++ ){
            $explode_detail = explode("<>",$explode_value[$i]);
            $approval = ApprovalHistory::where("approval_id",$explode_detail[0])->where("user_id",$user)->first();
            $approval_history = ApprovalHistory::find($approval->id);
            $approval_history->approval_action_id = $explode_detail[1];
            $approval_history->description = $request->input('description.'.$i.'.value');
            $approval_history->save();

            if ( $approval_history->no_urut == $highest){       
                $approval_ac = Approval::find($explode_detail[0]);
                $approval_ac->approval_action_id = $request->status;
                $approval_ac->save();
            }
            
        }
        
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function budget_devcost(Request $request){
       
        $budgets = Budget::find($request->id);
        $coa = $budgets->total_parent_item;
        $user = \Auth::user();
        $project = Project::find($request->id);
        return view("access::user.budget_devcost",compact("project","user","budgets","coa"));
    }

    public function budget_concost(Request $request){
        
        $budgets = Budget::find($request->id);
        $coa = $budgets->total_parent_item;
        $user = \Auth::user();
        $project = Project::find($request->id);
        return view("access::user.budget_concost",compact("project","user","budgets","coa"));
    }

    public function department(Request $request){
        $project = $request->id;

    }

    public function approve_all(Request $request){
        $approval_list = explode("<>", trim($request->approval_list,"<>"));
        $array = array();
        $nilai = 0;
        for ( $i=0; $i < count($approval_list); $i++ ){
            $approval = explode(",", $approval_list[$i]);

            $approval_history = ApprovalHistory::find($approval[1]);
            $approval_history->approval_action_id = $approval[0];
            $approval_history->save();

            $approvals = Approval::find($approval_history->approval_id);
            $highest  = $approvals->histories->min("no_urut");
            if ( $highest == $approval_history->no_urut ){
                $approvals->approval_action_id = $approval[0];
                $approvals->save();


                if ( $approvals->document_type == "Modules\Budget\Entities\Budget"){
                    //foreach ($approvals->document->project->budgets as $key => $value) {
                        if ( $approvals->approval_action_id == "6"){
                            $array[$i] = "1";
                            $nilai = $nilai + $approvals->document->total_dev_cost;
                        }
                    //}                    
                }
            }

            if ( $approvals->document_type == "Modules\BudgetDraft\Entities\BudgetDraft" ){
                $budget_draft = $approvals->document;
                foreach ($budget_draft->details as $key => $value) {

                    $budgetDetail = new BudgetDetail;
                    $budgetDetail->budget_id = $budget_draft->budget_tahunan->budget->id;
                    $budgetDetail->itempekerjaan_id = $value->itempekerjaan_id;
                    $budgetDetail->nilai = $value->nilai;
                    $budgetDetail->volume = $value->volume;
                    $budgetDetail->satuan = $value->satuan;
                    $budgetDetail->save();

                    $budgetDetail = new BudgetTahunanDetail;
                    $budgetDetail->budget_tahunan_id = $budget_draft->budget_tahunan_id;
                    $budgetDetail->itempekerjaan_id = $value->itempekerjaan_id;
                    $budgetDetail->nilai = $value->nilai;
                    $budgetDetail->volume = $value->volume;
                    $budgetDetail->satuan = $value->satuan;
                    $budgetDetail->save();
                    

                    $budgetDetailDraft = BudgetDraftDetail::find($value->id);
                    $budgetDetailDraft->deleted_at = date("Y-m-d H:i:s");
                    $budgetDetailDraft->save();
                }
                $budgetDraft = BudgetDraft::find($budget_draft->id);
                $budgetDraft->deleted_at = date("Y-m-d H:i:s");
                $budgetDraft->save();
            }
        }

        if ( count($array) > 0 ){                    
            $nilai_awal = 0;
            foreach ($approvals->document->project->budgets as $key => $value) {
                $nilai_awal = $nilai_awal + $value->total_dev_cost;
            }

            $hpp_update = new HppUpdate;
            $hpp_update->project_id = $approvals->document->project->id;
            $hpp_update->nilai_budget = $nilai_awal ;
            $hpp_update->luas_book = $approvals->document->project->netto;
            $hpp_update->created_by = \Auth::user()->id;
            $hpp_update->save();

            foreach ($approvals->document->project->budgets as $key => $value) {
                $hpp_detail = new HppUpdateDetail;
                $hpp_detail->hpp_update_id = $hpp_update->id;
                $hpp_detail->budget_id = $value->id;
                $hpp_detail->created_by = \Auth::user()->id;
                $hpp_detail->save();
            }

            
        }
        
        return response()->json( ["status" => "0"] );
    }

    public function tender_korespondensi(Request $request){
        $user = \Auth::user();
        $tender_korespondensi = TenderKorespondensi::find($request->id);
        $arrayKoresponend = array(
            "udg" => "Undangan Penawaran dan Klarifikasi",
            "sipp" => "Surat Instruksi Penunjukan Pemenang",
            "pp" => "Surat Pemberitahuan Pemenang",
            "sutk" => "Surat Ucapan Terima Kasih",
            "spt" => "Surat Pembatalan Tender"
        );
        $type = $arrayKoresponend[$tender_korespondensi->type];
        return view("access::user.tender_korespondensi",compact("tender_korespondensi","type","user"));
    }

    public function tender_korespondensi_approval(Request $request){
        $user = \Auth::user();
        $user_id = $request->user_id;
        $approval = $request->approval;
        $status = $request->status;

        $approval_history = ApprovalHistory::find($approval);
        $approval_history->approval_action_id = $status;
        $approval_history->save();

        $approvals = Approval::find($approval_history->approval_id);
        $highest  = $approvals->histories->min("no_urut");
        if ( $highest == $approval_history->no_urut ){
            $approvals->approval_action_id = $status;
            $approvals->save();
        }
        return response()->json( ["status" => "0"] );
    }

    public function rekaptender(Request $request){
        $tender = Tender::find($request->id);
        $step   = $request->step - 1 ;
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("access::user.tender_rekap",compact("tender","step","project","user"));
    }

    public function approvedeoc(Request $request){

        if ( $request->document_id ){
            foreach ($request->document_id as $key => $value) {
                if ( $request->document_id[$key] != "" ){
                    $tender = TenderDocumentApproval::find($request->document_id[$key]);
                    $tender->status = $request->status[$key];
                    $tender->save();   
                    $level = $tender->level;             
                }
            }
        }


        $tender = Tender::find($request->tender_docs);
        if ( $tender->check_rejected == 0 ){
            foreach ($tender->tender_document as $key => $value) {
                foreach ($value->document_approval as $key2 => $value2) {
                    if ( ( $level - 1 ) == $value2->level ){
                        $tender = TenderDocumentApproval::find($value2->id);
                        $tender->status = 1;
                        $tender->save();  
                    }
                }
            }            
        }
        return redirect("/access/tender/detail/?id=".$request->tender_docs);
    }

    public function ispemenang(Request $request){
        $tender_rekanan = TenderRekanan::find($request->id);
        $tender_rekanan->is_recomendasi = "1";
        $tender_rekanan->save();

        foreach ($tender_rekanan->tender->rab->units as $key => $value) {
            $tender_menang = new TenderMenang;
            $tender_menang->tender_rekanan_id = $request->id;
            $tender_menang->tender_unit_id = $value->id;
            $tender_menang->asset_type = $value->asset_type;
            $tender_menang->asset_id = $value->asset_id;
            $tender_menang->save();

            foreach ($tender_rekanan->tender->penawarans->last()->details as $key2 => $value2) {
                
                $tender_menang_details = new TenderMenangDetail;
                $tender_menang_details->tender_menang_id = $tender_menang->id;
                $tender_menang_details->itempekerjaan_id = $value2->rab_pekerjaan->itempekerjaan_id;
                $tender_menang_details->nilai = $value2->nilai;
                $tender_menang_details->volume = $value2->volume;
                $tender_menang_details->satuan = $value2->satuan;
                if ( $value->asset_type == "Modules\Project\Entities\Unit"){
                    $unit = \Modules\Project\Entities\Unit::find($value->asset_id);
                    $tender_menang_details->templatepekerjaan_detail_id = $unit->templatepekerjaan_id;
                }else{
                    $tender_menang_details->templatepekerjaan_detail_id = "0";
                }
                $tender_menang_details->save();
            }
        }

        $tender_menang_id = $tender_rekanan->tender->id;
        $class  = "TenderMenang";
        $approval = \App\Helpers\Document::make_approval('Modules\Tender\Entities\TenderMenang',$tender_menang->id);


        return response()->json( ["status" => "0"]);
        
    }

    public function budgetreferensi(Request $request){
        $budgetdetail = BudgetDetail::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view("access::user.budget_referensi",compact("budgetdetail","user","project"));
    }

    public function budgetdetail_approval(Request $request){
        $budgetdetail = BudgetDetail::find($request->budget_detail_id);
        foreach ($budgetdetail->approval->histories as $key => $value) {
            if ( $value->user_id == $request->user_id ){
                $approval_history = ApprovalHistory::find($value->id);
                $approval_history->approval_action_id = $request->status;
                $approval_history->save();

                $approvals = Approval::find($approval_history->approval->id);
                $highest  = $approvals->histories->min("no_urut");
                if ( $highest == $approval_history->no_urut ){
                    $approvals->approval_action_id = $request->status;
                    $approvals->save();
                }
            }
            
        }

        
        return response()->json( ["status" => "0"] );

    }
}

?>
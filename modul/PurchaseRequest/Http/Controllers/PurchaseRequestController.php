<?php

namespace Modules\PurchaseRequest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Department\Entities\Department;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\PurchaseRequest\Entities\PurchaseRequest;
use Modules\PurchaseRequest\Entities\PurchaseRequestDetail;
use Modules\Budget\Entities\Budget;
use Modules\Budget\Entities\BudgetTahunan;
use Modules\Project\Entities\Project;
use Modules\Inventory\Entities\ItemProject;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\BrandOfCategory;
use Modules\Inventory\Entities\ItemCategory;
use Modules\Inventory\Entities\Brand;
use Modules\Inventory\Entities\ItemSatuan;
use Modules\Approval\Entities\Approval;
use Modules\Rekanan\Entities\Rekanan;
use Modules\Inventory\Entities\CreateDocument;
use Modules\Approval\Entities\ApprovalHistory;
use Modules\TenderPurchaseRequest\Entities\PurchaseOrder;
use Modules\Project\Entities\ProjectPtUser;
// use App\Spk;

use Modules\User\Entities\UserDetail;
use DB;
use Auth;
use PDF;

class PurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->middleware(['auth','project_session']);
    }

    public function index(Request $request)
    {
        $project_id = $request->session()->get('project_id');
        $project = Project::find($project_id);
        $user = Auth::user();
        $approve = UserDetail::where("user_id",$user->id)->select("can_approve")->first()->can_approve;
        
        $PR =  PurchaseRequest::select('*')->where('project_for_id',$project_id)->orderBy('created_at','desc')->get();
        
        $isDepartment =   UserDetail::select("mappingperusahaans.department_id")
        ->where("user_details.user_id",$user->id)
        ->join("mappingperusahaans","mappingperusahaans.id","user_details.mappingperusahaan_id")
        ->first()->department_id;

        return view('purchaserequest::index',compact("user","PR","project","approve","isDepartment"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $approve = UserDetail::where("user_id",$user->id)->select("can_approve")->first()->can_approve;

        $department =   DB::table("users")->where("users.id",$user->id)
                        ->join("user_details","user_details.user_id","users.id")
                        ->join("mappingperusahaans","mappingperusahaans.id","user_details.mappingperusahaan_id")
                        ->join("departments","departments.id","mappingperusahaans.department_id")
                        ->where('users.deleted_at',null)
                        ->select("departments.name","departments.id")->first();

        //category & sub
        $categories = ItemCategory::where('parent_id','<>',0)->get();
        $parent_categories = ItemCategory::where('parent_id','=',0)->get();
        // $coa = Itempekerjaan::get();
        $coa = DB::table("coas")->where('deleted_at',null)->get();
        // $rekanan_group = \App\rekanan_group::get();
        $rekanan_group = DB::table("rekanan_groups")->where('deleted_at',null)->get();
        $test = new Budget();
        date_default_timezone_set('asia/jakarta');
        $date = date("Y-m-d");

        $item_result = [];
        $item = ItemProject::select('id','item_id')->where('project_id',$request->session()->get('project_id'))->get();
        foreach ($item as $key => $value) {
            # code...
            $arr = [
                'id'=>$value->id,
                'name'=>$value->item->name,
                'category'=>is_null($value->item->sub_item_category_id) ? $value->item->item_category_id : $value->item->sub_item_category_id,
            ];

            array_push($item_result, $arr);
        }
        
        // $item_satuan = \App\item_satuan::select('id','item_id','name')->get();
        $item_satuan = DB::table("item_satuans")->where('deleted_at',null)->get();

        $project = Project::find($request->session()->get('project_id'));        

        // $budget = \App\budget::select("id")->where("department_id",$department->id)->where("project_id",$request->session()->get('project_id'))->get();
        $budget = DB::table("budgets")->select("id")->where("department_id",$department->id)->where("project_id",$request->session()->get('project_id'))->where('deleted_at',null)->get();
        // $budget_tahunan = \App\budget_tahunan::select("id","budget_id")->get();
        $budget_tahunan = DB::table("budget_tahunans")->select("id","budget_id")->where('deleted_at',null)->get();

        // $budget_tahunan_detail = \App\budget_tahunan_detail::select("id","budget_tahunan_id","itempekerjaan_id")->get();
        $budget_tahunan_detail = DB::table("budget_tahunan_details")->select("id","budget_tahunan_id","itempekerjaan_id")->where('deleted_at',null)->get();
        
        $budget =   DB::table("budget_tahunan_details")
                    ->join("budget_tahunans","budget_tahunans.id","budget_tahunan_details.budget_tahunan_id")
                    ->join("budgets","budgets.id","budget_tahunans.budget_id")
                    ->where("budgets.department_id",$department->id)
                    ->where("budgets.project_id",$request->session()->get('project_id'))
                    ->join("budget_details","budget_details.budget_id","budgets.id")
                    ->distinct()
                    ->join("itempekerjaans","itempekerjaans.id","budget_tahunan_details.itempekerjaan_id")
                    ->select(
                             // "budgets.project_id as bProject_id",
                             // "budgets.department_id as bDepartement_id",
                             "budget_tahunans.id as btId",
                             "budget_tahunans.no as btNo",
                             "budget_tahunan_details.itempekerjaan_id as btdItemPekerjaan",
                             "itempekerjaans.name as ipName",
                             "itempekerjaans.code as ipCode",
                             "itempekerjaans.parent_id as ipId"                              
                            )
                    ->where('budget_tahunan_details.deleted_at',null)
                    ->get();

        $budget_no = [];
        $btdItemPekerjaan = (object)[];
        //foreach di bawah kurang optimal, kejar tayang

        foreach ($budget as $v) {
            if(!in_array([$v->btNo,$v->btId], $budget_no)){
                array_push($budget_no,[$v->btNo,$v->btId]);
            }
        }

        $myArray[] = (object) array('name' => 'My name');
        $myArray[] = (object) array('a' => 'My name');
        
        $input_budget_tahunan = DB::table("budgets")->select("budgets.id","budgets.project_id","budgets.department_id","budget_tahunans.id as id_budget_tahunan","budget_tahunans.no")->join("budget_tahunans","budgets.id","budget_tahunans.budget_id")->where('budgets.deleted_at',null)->get();

        $PO = PurchaseOrder::select("*")->get();

        $SPK = DB::table("spks")->select("*")->get();

        $SPK_department = DB::table("spks")->join("tender_rekanans","tender_rekanans.id","spks.tender_rekanan_id")
                                           ->join("tenders","tenders.id","tender_rekanans.tender_id")
                                           ->join("rabs","rabs.id","tenders.rab_id")
                                           ->join("budget_tahunans","budget_tahunans.id","rabs.budget_tahunan_id")
                                           ->join("budgets","budgets.id","budget_tahunans.budget_id")
                                           ->join("departments","departments.id","budgets.department_id")
                                           // ->where()
                                           ->select("spks.id as spk_id","spks.no as spk_no","departments.name as department_name")
                                           ->get();
        // select("*")->get();

        // App/Spk::get()->last()->tender->rab->budget_tahunan->budget->department;

        // return $SPK_department;  

        $department_spk = Department::find($department->id);
        // return $department_spk->spk;

        return view('purchaserequest::create',compact("user","department","coa","rekanan_group","date","brand","item_satuan","budget","budget_no","budget_tahunan","budget_tahunan_detail","input_budget_tahunan","project","approve","item_result","categories","first_child","parent_categories","PO","department_spk"));
    }
    
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $prePR = (object)[
            "department" => (int)$request->department,
            "butuh_date" => $request->butuh_date,
            "deskripsi_umum" => $request->deskripsi_umum,
            "jumlah_item" => $request->jumlah_item,
            "item" =>   $request->item,
            "brand" => $request->brand,
            "kuantitas" => $request->kuantitas,
            "satuan" => $request->satuan,
            "j_komparasi" => $request->j_komparasi,
            "komparasi_supplier1" => $request->komparasi_supplier1,
            "komparasi_supplier2" => $request->komparasi_supplier2,
            "komparasi_supplier3" => $request->komparasi_supplier3,
            "coa" => $request->coa,
            "deskripsi_item" => $request->deskripsi_item,
            "is_urgent" => $request->is_urgent,
            "date" => $request->waktu_transaksi,
            "spk" => $request->spk,
        ];

        for($i=0;$i<count($prePR->item);$i++){
            $prePR->item[$i] = ((int)$prePR->item[$i]);
            $prePR->brand[$i] = ((int)$prePR->brand[$i]);
            $prePR->coa[$i] = ((int)$prePR->coa[$i]);
        }

        $user_id = Auth::user()->id;
        $project_id = $request->session()->get('project_id');
        $pt_id = ProjectPtUser::where([['user_id','=',$user_id],['project_id','=',$project_id]])->first()->pt_id;

        $PR = new PurchaseRequest;
        $PR->budget_tahunan_id = $request->budget_tahunan;
        $PR->pt_id = DB::table("budgets")->select('pt_id')->where('department_id',$prePR->department)->first()->pt_id;
        $PR->department_id = $prePR->department;
        $PR->project_for_id = $project_id;
        $PR->location_id = 1;

        $PR->no = CreateDocument::createDocumentNumber('PR',2,$project_id,$user_id);
        $PR->date = $prePR->date;
        $PR->butuh_date = $prePR->butuh_date;
        $PR->is_urgent = $prePR->is_urgent;
        $PR->description = $prePR->deskripsi_umum;
        $status = $PR->save();

        $create_approval_pr = CreateDocument::make_approval('Modules\PurchaseRequest\Entities\PurchaseRequest',$PR->id,$project_id,$pt_id);

        // $PRApproval = DB::table("approvals")->where("document_id",$create_approval_pr->id)
        //                                        ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
        //                                        ->select('*')
        //                                        ->get();

        // $AH = new ApprovalHistory;
        // $AH->user_id = Auth::user()->id;
        // $AH->approval_id = $PRApproval[0]->id;
        // $AH->approval_action_id = $PRApproval[0]->approval_action_id;

        // $AH->document_type_id = $PRApproval[0]->document_id;
        // $AH->document_type = $PRApproval[0]->document_type;
        // $status = $AH->save();

        for($i=0;$i<$prePR->jumlah_item;$i++){
            $PRD = new \Modules\PurchaseRequest\Entities\PurchaseRequestDetail;
            $PRD->purchaserequest_id = $PR->id;
            $PRD->itempekerjaan_id = $prePR->coa[$i];
            $PRD->item_id = $prePR->item[$i];
            $PRD->item_satuan_id = $prePR->satuan[$i];
            $PRD->brand_id = $prePR->brand[$i];
            $PRD->recomended_supplier = $prePR->j_komparasi[$i];
            
            $PRD->quantity = $prePR->kuantitas[$i];
            $PRD->description = $prePR->deskripsi_item[$i];
            $PRD->rec_1 = $prePR->komparasi_supplier1[$i+1];
            if($prePR->j_komparasi[$i]>1)
                $PRD->rec_2 = $prePR->komparasi_supplier2[$i+1];
            if($prePR->j_komparasi[$i]>2)
                $PRD->rec_3 = $prePR->komparasi_supplier3[$i+1];
            $PRD->delivery_date = $prePR->butuh_date;
            $PRD->spk_id    = $prePR->spk[$i];
            $PRD->save();       

            $create_approval_pr_detail = CreateDocument::make_approval('Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$PRD->id,$project_id,$pt_id);

            // $PRDApproval = DB::table("approvals")->where("document_id",$create_approval_pr_detail->id)
            //                                    ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
            //                                    ->select('*')
            //                                    ->get();

            // $AH = new ApprovalHistory;
            // $AH->user_id = Auth::user()->id;
            // $AH->approval_id = $PRDApproval[0]->id;
            // $AH->approval_action_id = $PRDApproval[0]->approval_action_id;

            // $AH->document_type_id = $PRDApproval[0]->document_id;
            // $AH->document_type = $PRDApproval[0]->document_type;
            // $status = $AH->save();
         
        }
        return redirect("/purchaserequest/detail/?id=". $PR->id);
    }

    
    public function edit(Request $request,$id)
    {

       $user = Auth::user();
       $project_id = $request->session()->get('project_id');
        $project = Project::find($project_id);
        $approve = UserDetail::where("user_id",$user->id)->select("can_approve")->first()->can_approve;

        $PR = PurchaseRequestDetail::where('purchaserequest_id',$request->id)->get();
        $tmpPR = PurchaseRequest::where('id',$request->id)->first();

        $coa =  DB::table("budget_tahunan_details as btd")
                ->where('btd.deleted_at',null)
                ->where('btd.budget_tahunan_id',$tmpPR->budget_tahunan_id)
                ->join('itempekerjaans as ip','ip.id','btd.itempekerjaan_id')
                ->select('ip.id','ip.name','ip.code')
                ->distinct()
                ->get();

        $PRHeader = PurchaseRequest::find($request->id);
        $PRD = PurchaseRequestDetail::find($request->id);

        $PRH = PurchaseRequest::find($id);

        $sisa_budget = BudgetTahunan::find($PRHeader->budget_tahunan_id)->total_parent_item;
        //return $sisa_budget;

        $pr_id = $request->id;

        $parent_categories = ItemCategory::where('parent_id','=',0)->get();
        $categories = ItemCategory::where('parent_id','<>',0)->get();
        $brand = DB::table("brands")->select('id','name')->where('deleted_at',null)->get();
        $rekanan_group = DB::table("rekanan_groups")->where('deleted_at',null)->get();

        date_default_timezone_set('asia/jakarta');
        $date = date("Y-m-d");
        // $item = \App\item::select('id','name','stock_min')->get();
        $item_result = [];
        $item = ItemProject::select('id','item_id')->where('project_id',$request->session()->get('project_id'))->get();
        foreach ($item as $key => $value) {
            # code...
            $arr = [
                'id'=>$value->id,
                'name'=>$value->item->name,
                'category'=>is_null($value->item->sub_item_category_id) ? $value->item->item_category_id : $value->item->sub_item_category_id,
            ];

            array_push($item_result, $arr);
        }
        $item_satuan = DB::table("item_satuans")->where('deleted_at',null)->get();

        $budget = DB::table("budgets")->select("id")->where("department_id",$PRH->department_id)->where("project_id",$request->session()->get('project_id'))->where('budgets.deleted_at',null)->get();

        $budget_tahunan = DB::table("budget_tahunans")->select("id","budget_id")->where('deleted_at',null)->get();

        $budget_tahunan_detail = DB::table("budget_tahunan_details")->select("id","budget_tahunan_id","itempekerjaan_id")->where('budget_tahunan_details.deleted_at',null)->get();
        
        $budget =   DB::table("budget_tahunan_details")
                    ->join("budget_tahunans","budget_tahunans.id","budget_tahunan_details.budget_tahunan_id")
                    ->join("budgets","budgets.id","budget_tahunans.budget_id")
                    ->where("budgets.department_id",$PRH->department_id)
                    ->where("budgets.project_id",$request->session()->get('project_id'))
                    ->join("budget_details","budget_details.budget_id","budgets.id")
                    ->distinct()
                    ->join("itempekerjaans","itempekerjaans.id","budget_tahunan_details.itempekerjaan_id")
                    ->select(
                             // "budgets.project_id as bProject_id",
                             // "budgets.department_id as bDepartement_id",
                             "budget_tahunans.id as btId",
                             "budget_tahunans.no as btNo",
                             "budget_tahunan_details.itempekerjaan_id as btdItemPekerjaan",
                             "itempekerjaans.name as ipName",
                             "itempekerjaans.code as ipCode"
                            )
                    ->where('budget_tahunan_details.deleted_at',null)
                    ->get();



        $budget_no = [];
        $btdItemPekerjaan = (object)[];
        //foreach di bawah kurang optimal, kejar tayang

        foreach ($budget as $v) {
            if(!in_array([$v->btNo,$v->btId], $budget_no)){
                array_push($budget_no,[$v->btNo,$v->btId]);
            }
        }
        $total = 0;
        
        $summary = BudgetTahunan::find($PRHeader->budget->id)->getTotalParentItemAttribute();
        foreach ($summary as $v) {
            // var_dump($v['nilai']);
            // var_dump($v['volume']);
            $total = $total + ((int)$v['nilai']*(int)$v['volume']);
          }

          $total = "Rp " . number_format($total,2,',','.');


        $terakhir = DB::table('budget_tahunan_details')
        ->where('budget_tahunan_id',$PRHeader->budget->id)
        ->where('deleted_at',null)
        ->orderBy('created_at', 'DESC')->first();

        $pengguna_terakhir = PurchaseRequest::where('budget_tahunan_id',$PRHeader->budget->id)->orderBy('created_at', 'DESC')->skip(1)->first();

           $jumlahNilai_penggunaterakhir = PurchaseRequestDetail::where('purchaserequest_id',$pengguna_terakhir->id)
           ->where('budget_tahunan_id',$PRHeader->budget->id)
           ->join('itempekerjaans','itempekerjaans.id','purchaserequest_details.itempekerjaan_id')
           ->join('budget_tahunan_details','budget_tahunan_details.itempekerjaan_id','itempekerjaans.id')
           ->select('itempekerjaans.id as idPekerjaan','itempekerjaans.name as namePekerjaan','budget_tahunan_details.nilai as nilaiPekerjaan','budget_tahunan_details.budget_tahunan_id as budgetPekerjaan')

           ->get();

        $totalTerakhir = 0;
        foreach ($jumlahNilai_penggunaterakhir as $key => $value){ 
           $jumlahNilai[] = $value->nilaiPekerjaan;
         }

         $totalTerakhir = array_sum($jumlahNilai);

         $totalTerakhir = "Rp " . number_format($totalTerakhir,2,',','.');



        $input_budget_tahunan = DB::table("budgets")
        ->select("budgets.id","budgets.project_id","budgets.department_id","budget_tahunans.id as id_budget_tahunan","budget_tahunans.no")
        ->join("budget_tahunans","budgets.id","budget_tahunans.budget_id")
        ->where('budgets.deleted_at',null)->get();

        return view('purchaserequest::edit2',compact("user","project","PR","approve","pr_id","PRHeader","categories","item_result","PRD","rekanan_group","item_satuan","department","coa","date","brand","budget","budget_no","budget_tahunan","budget_tahunan_detail","input_budget_tahunan","total","parent_categories","pengguna_terakhir","brand","totalTerakhir"));
        
    }


    public function update(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = PurchaseRequestDetail::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
    }

    
    public function detail(Request $request)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $approve = UserDetail::where("user_id",$user->id)->select("can_approve")->first()->can_approve;

        $PR = PurchaseRequestDetail::where('purchaserequest_id',$request->id)->get();
        $PRHeader = PurchaseRequest::find($request->id);

        $sisa_budget = BudgetTahunan::find($PRHeader->budget_tahunan_id)->total_parent_item;
        //return $sisa_budget;

        $pr_id = $request->id;

        $total = 0;
        $summary = BudgetTahunan::find($PRHeader->budget->id)->getTotalParentItemAttribute();
        foreach ($summary as $v) {
            $total = $total + ((int)$v['nilai']*(int)$v['volume']);
          }
          $total = "Rp " . number_format($total,2,',','.');

        $terakhir = DB::table('budget_tahunan_details')->where('budget_tahunan_id',$PRHeader->budget->id)->orderBy('created_at', 'DESC')->where('deleted_at',null)->first();
       
        $pengguna_terakhir = PurchaseRequest::where('budget_tahunan_id',$PRHeader->budget->id)->orderBy('created_at', 'DESC')->first();
        $jumlahNilai_penggunaterakhir = PurchaseRequestDetail::select(
            'itempekerjaans.id as idPekerjaan',
            'itempekerjaans.name as namePekerjaan',
            'budget_tahunan_details.nilai as nilaiPekerjaan',
            'budget_tahunan_details.budget_tahunan_id as budgetPekerjaan')
        ->where('purchaserequest_id',$pengguna_terakhir->id)
        ->where('budget_tahunan_id',$PRHeader->budget->id)
        ->join('itempekerjaans','itempekerjaans.id','purchaserequest_details.itempekerjaan_id')
        ->join('budget_tahunan_details','budget_tahunan_details.itempekerjaan_id','itempekerjaans.id')
        ->get();

        $totalTerakhir = 0;
        foreach ($jumlahNilai_penggunaterakhir as $key => $value){ 
           $jumlahNilai[] = $value->nilaiPekerjaan;
         }

         $totalTerakhir = array_sum($jumlahNilai);

       // foreach ($jumlahNilai as $v) {
       //    $totalTerakhir = $totalTerakhir + ((int)$v['nilaiPekerjaan']);
       //  }
        $totalTerakhir = "Rp " . number_format($totalTerakhir,2,',','.');

        return view('purchaserequest::detail',compact("user","project","PR","approve","pr_id","PRHeader","sisa_budget","total","pengguna_terakhir","totalTerakhir"));
        //return view('purchaserequest::index');
    }


   public function approve(Request $request){
            $id_PRD = $request->id;
            $PRHeader = PurchaseRequest::find($request->id);
            $project_id = $request->session()->get('project_id');
            date_default_timezone_set('asia/jakarta');
            $date = date("Y-m-d h:i:s");
            $user_id = Auth::user()->id;

            if($request->type == "approve"){
                    DB::table("approvals")
                    ->where("id", DB::table("approvals")->select("id")
                                                    ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                    ->where("document_id",$request->id)->first()->id)
                                                    ->where("approval_action_id",2)
                    ->update(["approval_action_id"=>6]);

                    $approval_detail = Approval::where([['document_id','=',$request->id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequestDetail']])->select("id")->first();

                    ApprovalHistory::where("approval_id",$approval_detail->id)
                                   ->where("approval_action_id",2)
                                   ->delete();

                    CreateDocument::make_approval_history( $approval_detail->id,'Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$project_id);


                    $getHeaderID = PurchaseRequestDetail::find($request->id)->purchaserequest_id;
                    $getChildHeader = PurchaseRequestDetail::where('purchaserequest_id',$getHeaderID)->get();
                    $arr_temp = [];
                    foreach ($getChildHeader as $key => $v) {
                            # code...
                            $checkApproval = Approval::where([['document_id','=', $v->id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequestDetail']])->first()->approval_action_id;
                            if($checkApproval != 6 && $checkApproval != 7)
                            {
                                array_push($arr_temp, 1);
                            }
                            else
                            {
                                array_push($arr_temp, 0);
                            }
                    }

                    if(in_array(1,$arr_temp)){
                            Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest'],['approval_action_id','=',2]])->update(['approval_action_id'=>12]);

                            $approval = Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->select("id")->first();

                            $approval_history = ApprovalHistory::where("approval_id",$approval->id)
                                                                                                 ->where("approval_action_id",12)
                                                                                                 ->first();
                            if($approval->approval_action_id == 12){
                            ApprovalHistory::where("approval_id",$approval->id)
                                                            ->where("approval_action_id",2)
                                                            ->delete();
                            }else{
                            
                            }

                            if($approval_history != NULL){

                            }else{
                                    CreateDocument::make_approval_history($approval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);
                            }

                    }else{
                            Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->update(['approval_action_id'=>6]);

                            $approval = Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->select("id")->first();

                            if($approval->approval_action_id == 12){
                            ApprovalHistory::where("approval_id",$approval->id)
                                                            ->where("approval_action_id",12)
                                                            ->delete();
                            }else{
                            ApprovalHistory::where("approval_id",$approval->id)
                                                            ->where("approval_action_id",2)
                                                            ->delete();
                            }

                            CreateDocument::make_approval_history($approval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);


                    }

                    return redirect("/access/purchaserequest/detail/?id=". $request->pr_id);
            }

            else if($request->type == "cancel"){   
                    DB::table("approvals")
                            ->where("id", DB::table("approvals")->select("id")
                                                            ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                            ->where("document_id",$request->id)->first()->id)
                                                            ->where("approval_action_id",6)
                            ->update(["approval_action_id"=>2]);
                    $getHeaderID = PurchaseRequestDetail::find($request->id)->purchaserequest_id;
                    $getChildHeader = PurchaseRequestDetail::where('purchaserequest_id',$getHeaderID)->get();
                    $arr_temp = [];
                    foreach ($getChildHeader as $key => $v) {
                            # code...
                            $checkApproval = Approval::where([['document_id','=', $v->id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequestDetail']])->first()->approval_action_id;
                            if($checkApproval == 6)
                            {
                                array_push($arr_temp, 1);
                            }
                            else
                            {
                                array_push($arr_temp, 0);
                            }
                    }

                    if(in_array(1,$arr_temp)){
                            Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->update(['approval_action_id'=>12]);

                            $PRApproval = DB::table("approvals")->where("document_id",$request->pr_id)
                                                                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                                                                     ->select('*')
                                                                                                     ->first();

                            $approval_history = ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                                                 ->select("approval_action_id")
                                                                                                 ->get()->last();

                            if($approval_history->approval_action_id == 12){
                            ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                         ->where("approval_action_id",6)
                                                                         ->delete();
                            }else{
                            ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                         ->where("approval_action_id",12)
                                                                         ->delete();
                            }

                            if($approval_history != NULL){

                            }else{

                                    CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);
                            }

                    }else{
                            $approval = Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->update(['approval_action_id'=>2]);

                            $PRApproval = DB::table("approvals")->where("document_id",$request->pr_id)
                                                                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                                                                     ->select('*')
                                                                                                     ->first();
                            
                            $approval_history = ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                                                 ->select("approval_action_id")
                                                                                                 ->get()->last();

                            if($approval_history->approval_action_id == 12){
                            ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                         ->where("approval_action_id",12)
                                                                         ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                                         ->delete();
                            }else{
                            ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                         ->where("approval_action_id",6)
                                                                         ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                                         ->delete();
                            }

                            CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);

                    }

                    $PRApproval = DB::table("approvals")->where("document_id",$request->id)
                                                                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                                                                     ->select('*')
                                                                                                     ->first();

                    ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                         ->where("approval_action_id",6)
                                                                         ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                                         ->delete();

                    CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$project_id);

                    return redirect("/purchaserequest/detail/?id=". $request->pr_id);
            }

            else if($request->type == "approveAll"){
                    $id_PR = DB::table("purchaserequest_details")->where("purchaserequest_id",$id_PRD)->select("id")->get();
                    var_dump($id_PR);

                    $id = $PRHeader->id;
                    Approval::where([['document_id','=',$id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest'],['approval_action_id','=',2]])->update(['approval_action_id'=>6]);

                    $approval = Approval::where([['document_id','=',$id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest'],["approval_action_id","<>","7"]])->select("id")->first();
                    
                    if($approval == NULL){
                    }else{
                    ApprovalHistory::where("approval_id",$approval->id)
                                                 ->where("approval_action_id",2)
                                                 ->delete();

                    CreateDocument::make_approval_history($approval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);
                    }

                    foreach($id_PR as $v){
                            DB::table("approvals")->where("id", DB::table("approvals")->select("id")
                                                                        ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                                        ->where("document_id",$v->id)->first()->id)
                                                                        ->where("approval_action_id","<>","7")
                                                                        ->where("approval_action_id",2)
                                                                        ->update(["approval_action_id"=>6]);

                            $approval = Approval::where([['document_id','=',$v->id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequestDetail'],["approval_action_id","<>","7"]])->select("id")->first();

                            if($approval == NULL){
                            }else{
                            ApprovalHistory::where("approval_id",$approval->id)
                                                         ->where("approval_action_id",2)
                                                         ->delete();

                            CreateDocument::make_approval_history($approval->id,'Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$project_id);
                            }
                    }

                    return redirect("/purchaserequest/detail/?id=". $id_PRD);       
            }

            else if($request->type == "cancelAll"){
                    $id_PR = DB::table("purchaserequest_details")->where("purchaserequest_id",$id_PRD)->select("id")->get();
                    var_dump($id_PR);

                    $id = $PRHeader->id;
                    $approval = Approval::where([['document_id','=',$id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest'],['approval_action_id','=',6]])->update(['approval_action_id'=>2]);

                    $PRApproval = DB::table("approvals")->where("document_id",$id)
                                                                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                                                                     ->select('*')
                                                                                                     ->first();

                    $approval_history = ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                                                 ->select("approval_action_id")
                                                                                                 ->get()->last();

                    if($approval_history->approval_action_id == 6){            
                            ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                                 ->where("approval_action_id",6)
                                                                                 ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                                                 ->delete();
                    }else{
                            ApprovalHistory::where("approval_id",$PRApproval->id)
                                                                                 ->where("approval_action_id",12)
                                                                                 ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                                                 ->delete();
                    }

                    CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);

                    foreach($id_PR as $v){
                            DB::table("approvals")
                                    ->where("id", DB::table("approvals")->select("id")
                                                                    ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                                    ->where("document_id",$v->id)->first()->id)
                                                                    ->where("approval_action_id","<>","7")
                                                                    ->where("approval_action_id",6)
                                    ->update(["approval_action_id"=>2]);

                            $PRDApproval = DB::table("approvals")->where("document_id",$v->id)
                                                                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                                                                     ->where("approval_action_id","<>","7")
                                                                                                     ->select('*')
                                                                                                     ->first();

                            ApprovalHistory::where("approval_id",$PRDApproval->id)
                                                                                 ->where("approval_action_id",6)
                                                                                 ->delete();


                            CreateDocument::make_approval_history($PRDApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$project_id);

                    }

                    return redirect("/purchaserequest/detail/?id=". $id_PRD);
            }else if($request->type == "cancelToApproveAll"){
                    
            }

        }

    public function reject(Request $request){
      $id_PRD = $request->id;
      $project_id = $request->session()->get('project_id');
      date_default_timezone_set("Asia/Jakarta");
      $date = date("Y-m-d");
      $user = Auth::user()->id;
        $PRHeader = PurchaseRequestDetail::find($request->id);
        if($request->type == "reject"){
            $approval_obj = Approval::where([['document_id','=',$PRHeader->purchaserequest_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']]);
            if($approval_obj->first()->approval_action_id == 2){
            DB::table("approvals")
            ->where("id", DB::table("approvals")->select("id")
                            ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                            ->where("document_id",$request->id)->first()->id)
            ->update(["approval_action_id"=>7,"inactive_at"=>$date,"inactive_by"=>$user]);

            $PRApproval = DB::table("approvals")->where("document_id",$request->id)
                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                     ->select('*')
                                                     ->first();
            ApprovalHistory::where("approval_id",$PRApproval->id)
                                       ->where("approval_action_id",2)
                                       ->update(["description"=>$request->deskripsi_reject]);

            ApprovalHistory::where("approval_id",$PRApproval->id)
                                       ->where("approval_action_id",2)
                                       // ->update("description",$request->deskripsi_reject)
                                       ->delete();

            CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$project_id);

            $getHeaderID = PurchaseRequestDetail::find($request->id)->purchaserequest_id;
            $getChildHeader = PurchaseRequestDetail::where('purchaserequest_id',$getHeaderID)->get();
            $arr_temp = [];
            foreach ($getChildHeader as $key => $v) {
                # code...
                $checkApproval = Approval::where([['document_id','=', $v->id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequestDetail']])->first()->approval_action_id;
                if($checkApproval != 7)
                {
                  array_push($arr_temp, 1);
                }
                else
                {
                  array_push($arr_temp, 0);
                }
            }


            if(in_array(1,$arr_temp)){
                $approval = Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->update(['approval_action_id'=>2]);
            }else{
                $approval = Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->update(['approval_action_id'=>7]);

                $PRApproval = DB::table("approvals")->where("document_id",$request->pr_id)
                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                     ->select('*')
                                                     ->first();

                ApprovalHistory::where("approval_id",$PRApproval->id)
                                       ->where("approval_action_id",2)
                                       ->delete();



                CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);
            }

            }else if($approval_obj->first()->approval_action_id == 12){
                DB::table("approvals")
                ->where("id", DB::table("approvals")->select("id")
                                ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                ->where("document_id",$request->id)->first()->id)
                ->update(["approval_action_id"=>7,"inactive_at"=>$date,"inactive_by"=>$user]);

                $PRApproval = DB::table("approvals")->where("document_id",$request->id)
                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                     ->select('*')
                                                     ->first();

                ApprovalHistory::where("approval_id",$PRApproval->id)
                                           ->where("approval_action_id",2)
                                           ->update(["description"=>$request->deskripsi_reject]);

                ApprovalHistory::where("approval_id",$PRApproval->id)
                                           ->where("approval_action_id",2)
                                           // ->update("description",$request->deskripsi_reject)
                                           ->delete();

                CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$project_id);

                $getHeaderID = PurchaseRequestDetail::find($request->id)->purchaserequest_id;
                $getChildHeader = PurchaseRequestDetail::where('purchaserequest_id',$getHeaderID)->get();
                $arr_temp = [];
                foreach ($getChildHeader as $key => $v) {
                    # code...
                    $checkApproval = Approval::where([['document_id','=', $v->id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequestDetail']])->first()->approval_action_id;
                    if($checkApproval != 7)
                    {
                      array_push($arr_temp, 1);
                    }
                    else
                    {
                      array_push($arr_temp, 0);
                    }
                }

                if(in_array(1,$arr_temp)){
                    $approval = Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->update(['approval_action_id'=>12]);
                }else{
                    $approval = Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->update(['approval_action_id'=>7]);

                    $PRApproval = DB::table("approvals")->where("document_id",$request->pr_id)
                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                     ->select('*')
                                                     ->first();

                    ApprovalHistory::where("approval_id",$PRApproval->id)
                                           ->where("approval_action_id",12)
                                           ->delete();

                    CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);

                }
            }

            // return $PRDApproval[0]->id;

            return redirect("/purchaserequest/detail/?id=". $request->pr_id);
        }

        else if($request->type == "unreject"){
            DB::table("approvals")
                ->where("id", DB::table("approvals")->select("id")
                                ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                ->where("document_id",$request->id)->first()->id)
                ->update(["approval_action_id"=>2,"inactive_at"=>NULL,"inactive_by"=>NULL]);

            $PRApproval = DB::table("approvals")->where("document_id",$request->id)
                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                     ->select('*')
                                                     ->first();

            ApprovalHistory::where("approval_id",$PRApproval->id)
                                   ->where("approval_action_id",7)
                                   ->delete();

            CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$project_id);

            $getHeaderID = PurchaseRequestDetail::find($request->id)->purchaserequest_id;
            $getChildHeader = PurchaseRequestDetail::where('purchaserequest_id',$getHeaderID)->get();
            $arr_temp = [];
            foreach ($getChildHeader as $key => $v) {
              # code...
              $checkApproval = Approval::where([['document_id','=', $v->id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequestDetail']])->first()->approval_action_id;
              if($checkApproval == 7)
              {
                array_push($arr_temp, 1);
              }
              else
              {
                array_push($arr_temp, 0);
              }
            }



            if(in_array(1,$arr_temp)){
              $approval = Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->update(['approval_action_id'=>2]);

              $PRApproval = DB::table("approvals")->where("document_id",$request->pr_id)
                                                     ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                                                     ->select('*')
                                                     ->first();

                ApprovalHistory::where("approval_id",$PRApproval->id)
                                       ->where("approval_action_id",7)
                                       ->delete();

                $approval_history = ApprovalHistory::where("approval_id",$PRApproval->id)
                                                   ->select("approval_action_id")
                                                   ->get()->last();

                if($approval_history != NULL){

                }else{

                    CreateDocument::make_approval_history($PRApproval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);
                }
            
            }else{
              $approval = Approval::where([['document_id','=',$request->pr_id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->update(['approval_action_id'=>2]);

            }

            return redirect("/purchaserequest/detail/?id=". $request->pr_id);
        }
    }

    public function changeBrand(Request $request)
    {
        $item_project_id = $request->id;
        $brands = null;
        $sub_category = null;
        $parent_category = null;
        $result_brand = [];
        $satuans = null;
        $items = null;
        if($item_project_id != 0)
        {
            $sub_category = ItemProject::find($item_project_id)->item->sub_category;
            $parent_category = ItemProject::find($item_project_id)->item->category;
            if($sub_category != null)
            {
                $brands = BrandOfCategory::select('id','brand_id')->where('category_id',$sub_category->id)->get();
            }
            else
            {
                $sub_category = ItemProject::find($item_project_id)->item->category;
                $parent_category = ItemProject::find($item_project_id)->item->category;                
                $brands = BrandOfCategory::select('id','brand_id')->where('category_id',$sub_category->id)->get();
            }

            
            foreach ($brands as $key => $value) {
                # code...
                $arr = [
                    'id'=>$value->brand_id,
                    'name'=>$value->brand->name
                ];

                array_push($result_brand, $arr);
            }

            //get satuan 
            $item_id = ItemProject::find($item_project_id)->item_id;
            $satuans = ItemSatuan::select('id','name')->where('item_id',$item_id)->get();
        }
        else
        {
            $sub_category = ItemCategory::select('id','name')->where('parent_id','<>',0)->get();
            $parent_category = ItemCategory::select('id','name')->where('parent_id','=',0)->get();
            $items = ItemProject::select('item_projects.id as itemid','items.name as itemname')
            ->join('items','item_projects.item_id','items.id')
            ->where('project_id',$request->session()->get('project_id'))->get();
        }


        
        return response()->json(['brands'=>$result_brand,'satuans'=>$satuans,'categories'=>$sub_category,'items'=>$items,'parent_categories'=>$parent_category]);

    }


    public function request_approval(request $PRHeader){
        $id = $PRHeader->id;
        $project_id = $PRHeader->session()->get('project_id');

        Approval::where([['document_id','=',$id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest'],['approval_action_id','=',1]])->update(['approval_action_id'=>2]);

        $approval = Approval::where([['document_id','=',$id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->select("id")->first();

        CreateDocument::make_approval_history($approval->id,'Modules\PurchaseRequest\Entities\PurchaseRequest',$project_id);


        $id_PR = DB::table("purchaserequest_details")->where("purchaserequest_id",$id)->select("id")->get();

        foreach($id_PR as $v){
            DB::table("approvals")->where("id", DB::table("approvals")->select("id")
                                  ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                  ->where("document_id",$v->id)->first()->id)
                                  ->where("approval_action_id",1)
                                  ->update(["approval_action_id"=>2]);

            $approval_detail = Approval::where([['document_id','=',$v->id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequestDetail']])->select("id")->first();

            CreateDocument::make_approval_history( $approval_detail->id,'Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$project_id);


        }
        return redirect("/purchaserequest/detail/?id=". $id);

    }

      public function batalrequest_approval(request $PRHeader){
        $id = $PRHeader->id;
        date_default_timezone_set('asia/jakarta');
        $date = date("Y-m-d h:i:s");
        $user_id = Auth::user()->id;

        $id_PR = DB::table("purchaserequest_details")->where("purchaserequest_id",$id)->select("id")->get();
        var_dump($id_PR);

        $approval_obj = Approval::where([['document_id','=',$id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest']])->first();

        if($approval_obj->approval_action_id == 2){
            foreach($id_PR as $v){
                DB::table("approvals")->where("id", DB::table("approvals")->select("id")
                                      ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                      ->where("document_id",$v->id)->first()->id)
                                      ->where("approval_action_id",2)
                                      ->update(["approval_action_id"=>1]);

                $PRDApproval = DB::table("approvals")->where("document_id",$v->id)
                                                 ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                                 ->select('*')
                                                 ->first();

                ApprovalHistory::where("approval_id",$PRDApproval->id)
                               ->where("approval_action_id",2)
                               ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                               ->delete();

            }
        }
        $approval = Approval::where([['document_id','=',$id],['document_type','=','Modules\PurchaseRequest\Entities\PurchaseRequest'],['approval_action_id','=',2]])->update(['approval_action_id'=>1]);
        
        ApprovalHistory::where("approval_id",$approval_obj->id)
                               ->where("approval_action_id",2)
                               ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequest")
                               ->delete();


        return redirect("/purchaserequest/detail/?id=". $id);

    }

    public function item_pekerjaan_source(Request $request)
    {
        $item_pekerjaans = Itempekerjaan::select('id','name')->where('parent_id',NULL)->get();
        $obj = [];
        foreach ($item_pekerjaans as $key => $value) {
            # code...
            $obj[$value->id] = $value->name;
        }
        return response()->json($obj);
    }

    public function item_project_source(Request $request)
    {
        $items = ItemProject::select('id','item_id')->get();
        $obj = [];
        foreach ($items as $key => $value) {
            # code...
            $obj[$value->id] = $value->item->name;
        }
        return response()->json($obj);
    }

    public function brand_source(Request $request)
    {
        $brands = Brand::select('id','name')->get();
        $obj = [];
        foreach ($brands as $key => $value) {
            # code...
            $obj[$value->id] = $value->name;
        }
        return response()->json($obj);
    }

    public function satuan_source(Request $request)
    {
        $item_satuans = ItemSatuan::select('id','name')->get();
        $obj = [];
        foreach ($item_satuans as $key => $value) {
            # code...
            $obj[$value->id] = $value->name;
        }
        return response()->json($obj);
    }

    public function supplier_source(Request $request)
    {
        $item_satuans = Rekanan::select('id','name')->get();
        $obj = [];
        foreach ($item_satuans as $key => $value) {
            # code...
            $obj[$value->id] = $value->name;
        }
        return response()->json($obj);
    }

    public function filter_item_pekerjaan(Request $request)
    {
        $budget_id = $request->id;
        $result = [];
        //$getItemPekerjaans = BudgetTahunan::find($budget_id)->getTotalParentItemAttribute();
        $getItemPekerjaans = DB::table('budget_tahunan_details')->where('budget_tahunan_id',$budget_id)
                                                                ->join('itempekerjaans','itempekerjaans.id','budget_tahunan_details.itempekerjaan_id')
                                                                ->distinct()
                                                                ->select('itempekerjaan_id as id','itempekerjaans.name as itempekerjaan','itempekerjaans.code as code')
                                                                ->get();
      

        return response()->json(['item' => $getItemPekerjaans]);
    }

    public function changeItemBaseCategory(Request $request)
    {
        $category_id = $request->category_id;
        $items =null;
        $sub_category = null;
        $parent_category = null;
        if($category_id != 0)
        {
            $items = ItemProject::select('item_projects.id as itemid','items.name as itemname')
            ->join('items','item_projects.item_id','items.id')
            ->where('items.sub_item_category_id',$category_id)
            ->where('project_id',$request->session()->get('project_id'))
            ->get();

            $parent_category = ItemCategory::find($category_id)->parent;
            if(count($items) <=0)
            {
                $items = ItemProject::select('item_projects.id as itemid','items.name as itemname')
            ->join('items','item_projects.item_id','items.id')
            ->where('items.item_category_id',$category_id)
            ->where('project_id',$request->session()->get('project_id'))->get();

            $parent_category = ItemCategory::find($category_id)->parent;
            }


        }
        else
        {

            $sub_category = ItemCategory::select('id','name')->where('parent_id','<>',0)->get();
            $parent_category = ItemCategory::select('id','name')->where('parent_id','=',0)->get();
            $items = ItemProject::select('item_projects.id as itemid','items.name as itemname')
            ->join('items','item_projects.item_id','items.id')
            ->where('project_id',$request->session()->get('project_id'))->get();
        }
        

        return response()->json(['items'=>$items,'all_categories'=>$sub_category,'parent_categories'=>$parent_category]);
    }

    public function changeCategoryBaseParent(Request $request)
    {
        $parent = $request->parent;
        $items =null;
        $sub_category = null;
        $parent_category = null;
        if($parent != 0)
        {
            $items = ItemProject::select('item_projects.id as itemid','items.name as itemname')
            ->join('items','item_projects.item_id','items.id')
            ->where('items.item_category_id',$parent)
            ->where('project_id',$request->session()->get('project_id'))
            ->get();

            $sub_category = ItemCategory::find($parent)->child;
            if(count($items) <=0)
            {

                $parent_category = ItemCategory::find($parent)->child;
            }


        }
        else
        {

            $sub_category = ItemCategory::select('id','name')->where('parent_id','<>',0)->get();
            $parent_category = ItemCategory::select('id','name')->where('parent_id','=',0)->get();
            $items = ItemProject::select('item_projects.id as itemid','items.name as itemname')
            ->join('items','item_projects.item_id','items.id')
            ->where('project_id',$request->session()->get('project_id'))->get();
        }
        

        return response()->json(['items'=>$items,'all_categories'=>$sub_category,'parent_categories'=>$parent_category]);
    }

    public function delete_detail(Request $request)
    {
        $id = $request->id;
        $delete = PurchaseRequestDetail::find($id)->delete();

        return redirect("/purchaserequest/edit/". $request->PR);
    }

    public function edit_pr(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $PRHeader = $request ->id;
        $department = $request->department_id;
        $butuh_date = $request->butuh_date;
        $deskripsi_umum = $request->deskripsi_umum;
        $jumlah_item = $request->jumlah_item;
        $quantity = $request->kuantitas;
        $satuan = $request->satuan;
        $brand = $request->brand;
        $item = $request->item;
        $jumlah = $request->jumlah_item;
        //$kategori = $request->
        $j_komparasi = $request->j_komparasi;
        $komparasi_supplier1 = $request->komparasi_supplier2_1;
        if($j_komparasi[0]>1){
             $komparasi_supplier2 = $request->komparasi_supplier2_2;
        }else{
             $komparasi_supplier2 = NULL;
        } 
        if($j_komparasi[0]>2){
             $komparasi_supplier3 = $request->komparasi_supplier2_3;
        }else{
             $komparasi_supplier3 = NULL;
        }
        $coa = $request->coa;
        $deskripsi_item = $request->deskripsi_item;
        $is_urgent = $request->is_urgen;
        $date = $request->waktu_transaksi;
        //return $j_komparasi;

        $budget = $request->budget_tahunan;
        $pt_id = DB::table("budgets")->select('pt_id')->where('department_id',$department)->first()->pt_id;
        $location = 1;

        echo("<pre>");
            print_r($request->id);
        echo("</pre>");

        $user_id = Auth::user()->id;
        $edit_details = PurchaseRequestDetail::where([
                                                     ['id','=',$request->details_id],
                                                     ['purchaserequest_id','=',$request->id]])
                                              ->update(['item_id'=>$item[0],
                                                       'item_satuan_id'=>$satuan[0],
                                                       'brand_id'=>$brand[0],
                                                       'itempekerjaan_id'=>$coa[0],
                                                       'recomended_supplier'=>$j_komparasi[0],
                                                       'rec_1'=>$komparasi_supplier1[0],
                                                       'rec_2'=>$komparasi_supplier2[0],
                                                       'rec_3'=>$komparasi_supplier3[0],
                                                       'quantity'=>$quantity[0],
                                                       'description'=>$deskripsi_item[0],
                                                       'updated_by'=>$user_id[0]]

                                                      );

      
        return redirect("/purchaserequest/edit/". $request->id);

    }


    public function tambah(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $PRHeader = $request ->id;
        $department = $request->department_id;
        $butuh_date = $request->butuh_date;
        $deskripsi_umum = $request->deskripsi_umum;
        $jumlah_item = $request->jumlah_item;
        $quantity = $request->kuantitas;
        $satuan = $request->satuan;
        $brand = $request->brand;
        $item = $request->item;
        $jumlah = $request->jumlah_item;
        //$kategori = $request->
        $j_komparasi = $request->j_komparasi;
        $komparasi_supplier1 = $request->komparasi_supplier1_1;
        $komparasi_supplier2 = $request->komparasi_supplier1_2;
         $komparasi_supplier3 = $request->komparasi_supplier1_3;
        $coa = $request->coa;
        $deskripsi_item = $request->deskripsi_item;
        $is_urgent = $request->is_urgen;
        $date = $request->waktu_transaksi;
        //return $j_komparasi;
        //$delivery_date = DB::table("purchaserequests")->select('butuh_date')->where('id',$request->id);
        //return $request->delivery_date;

        $budget = $request->budget_tahunan;
        $pt_id = DB::table("budgets")->select('pt_id')->where('department_id',$department)->first()->pt_id;
        $location = 1;

        $user_id = Auth::user()->id;
        $project_id = $request->session()->get('project_id');
        // $project = Project::find($project_id);


            $PRD = new \Modules\PurchaseRequest\Entities\PurchaseRequestDetail;
            $PRD->purchaserequest_id = $request->id;
            $PRD->itempekerjaan_id = $coa[0];
            $PRD->item_id = $item[0];
            $PRD->item_satuan_id = $satuan[0];
            $PRD->brand_id = $brand[0];
            $PRD->recomended_supplier = $j_komparasi[0];
            
            $PRD->quantity = $quantity[0];
            $PRD->description = $deskripsi_item[0];
            $PRD->rec_1 = $komparasi_supplier1[0];
            if( $PRD->recomended_supplier>1){
                $PRD->rec_2 = $komparasi_supplier2[0];
            }else{
                $PRD->rec_2 = NULL;
            }
            if($PRD->recomended_supplier>2){
                $PRD->rec_3 = $komparasi_supplier3[0];
            }else{
                $PRD->rec_3 = NULL;
            }
            $PRD->delivery_date = $request->delivery_date;
            $PRD->save(); 

            // \App\Helpers\Document::make_approval('Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$PRD->id);
            CreateDocument::make_approval('Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$PRD->id,$project_id,$pt_id);

        
       return redirect("/purchaserequest/edit/". $request->id);
    }
    public function editPR(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $butuh_date = $request->butuh_date;
        $deskripsi_umum = $request->deskripsi_umum;
        $is_urgent = $request->is_urgent;
        $budget = $request->budget_tahunan;
        $user_id = Auth::user()->id;

        $editpr = PurchaseRequest::where([['id','=',$request->id]])
                          ->update(['budget_tahunan_id'=> $budget,
                                    'butuh_date'=>$butuh_date,
                                    'is_urgent'=>$is_urgent,
                                    'description'=>$deskripsi_umum,
                                    'updated_by'=>$user_id]
                                  );

        return redirect("/purchaserequest/edit/". $request->id);


    }


    public function makePDF(Request $request){ 

        $PRHeader = PurchaseRequest::where("id",$request->id)->first();

        // return $PRHeader;
        $PRDetail = PurchaseRequestDetail::where("purchaserequest_id",$PRHeader->id)->get();
        // return $PRDetail;

        $pdf = PDF::loadView('purchaserequest::pdf', compact('PRHeader','PRDetail'));
        

        return $pdf->stream('purchaserequest.pdf');
    }

    public function getSPK(Request $request)
    {
        $department_id = $request->department_id;

        $department = Department::find($department_id);

        // return $department->spk;

        $result_SPK = [];

        foreach ($department->spk as $key => $value) {
            # code...
            // return $value['name'];

                $arr = [
                    'id'=>$value['id'],
                    'spk_name'=>$value['name'],
                ];

                array_push($result_SPK, $arr);
        }


        return response()->json(['result'=>$result_SPK]);
    }
}




<?php

namespace Modules\PurchaseRequest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Department\Entities\Department;
use Modules\Itempekerjaan\Entities\Itempekerjaan;
use Modules\PurchaseRequest\Entities\PurchaseRequest;
use Modules\Budget\Entities\Budget;
use Modules\Project\Entities\Project;
use DB;

class PurchaseRequestController extends Controller
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
        $approve = DB::table("user_details")->where("user_id",$user->id)->select("can_approve")->first()->can_approve;
        $project = Project::find($request->session()->get('project_id'));
        $PR = purchaseRequest::get();
        //$status_approval tidak efisien
        $status_approval = [];
        foreach ($PR as $v) {
            $PRD = DB::table("purchaserequest_details")->where("purchaserequest_id",$v->id)->select("id")->get();
            $tmpJumlahPRD = count($PRD);
            $tmpJumlahPRDApprove = 0;
            foreach ($PRD as $v2) {

                $tmpApprove = DB::table("approvals")
                              ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                              ->where("approval_action_id",6)
                              ->where("document_id",$v2->id)
                              ->select("id")->count();
                $tmpJumlahPRDApprove += $tmpApprove;
            }
            if($tmpJumlahPRDApprove == 0 )
                array_push($status_approval,"Nothing Apporved");
            else if($tmpJumlahPRDApprove == $tmpJumlahPRD)
                array_push($status_approval,"All Apporved");
            else
                array_push($status_approval,"Partially Apporved");

        }
        $isDepartment =   DB::table("user_details")
                ->where("user_details.user_id",$user->id)
                ->join("mappingperusahaans","mappingperusahaans.id","user_details.mappingperusahaan_id")
                ->select("mappingperusahaans.department_id")->first()->department_id;

        return view('purchaserequest::index',compact("user","PR","project","approve","status_approval","isDepartment"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $approve = DB::table("user_details")->where("user_id",$user->id)->select("can_approve")->first()->can_approve;

        $department =   DB::table("users")->where("users.id",$user->id)
                        ->join("user_details","user_details.user_id","users.id")
                        ->join("mappingperusahaans","mappingperusahaans.id","user_details.mappingperusahaan_id")
                        ->join("departments","departments.id","mappingperusahaans.department_id")
                        ->select("departments.name","departments.id")->first();
        $coa = Itempekerjaan::get();
        $rekanan_group = \App\rekanan_group::get();
        $test = new Budget();
        date_default_timezone_set('asia/jakarta');
        $date = date("Y-m-d");
        $item = \App\item::select('id','name','stock_min')->get();
        $item_satuan = \App\item_satuan::select('id','item_id','name')->get();
        $brand = \App\brand::get();
        $itempekerjaan = \App\itempekerjaan::select('id','department_id','name')->get();

        $project = Project::find($request->session()->get('project_id'));        

        $budget = \App\budget::select("id")->where("department_id",$department->id)->where("project_id",$request->session()->get('project_id'))->get();
        $budget_tahunan = \App\budget_tahunan::select("id","budget_id")->get();

        $budget_tahunan_detail = \App\budget_tahunan_detail::select("id","budget_tahunan_id","itempekerjaan_id")->get();
        
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
                             "itempekerjaans.name as ipName"                             
                            )
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
        // $tmp = [
        //     $a => [
        //         1,2,3]
        // ];
        // var_dump($tmp);
        // $tmp = (object)$tmp;
        // var_dump($tmp->haha);

        $input_budget_tahunan = DB::table("budgets")->select("budgets.id","budgets.project_id","budgets.department_id","budget_tahunans.id as id_budget_tahunan","budget_tahunans.no")->join("budget_tahunans","budgets.id","budget_tahunans.budget_id")->get();
        
        return view('purchaserequest::create',compact("user","department","coa","rekanan_group","date","brand","item","item_satuan","itempekerjaan","budget","budget_no","budget_tahunan","budget_tahunan_detail","input_budget_tahunan","project","approve"));
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
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
        ];
        for($i=0;$i<count($prePR->item);$i++){
            $prePR->item[$i] = ((int)$prePR->item[$i]);
            $prePR->brand[$i] = ((int)$prePR->brand[$i]);
            $prePR->coa[$i] = ((int)$prePR->coa[$i]);
        } 
        $PR = new PurchaseRequest;
        
        // $PR->budget_tahunan_id = \App\budget::select('id')->where('department_id',$prePR->department)->limit(1)->get()[0]->id;
        // $PR->budget_tahunan_id = \App\budget_tahunan::select('id')->where('budget_id',$PR->budget_tahunan_id)->limit(1)->get()[0]->id;
        
        // $PR->budget_tahunan_id = \App\budget::select('id')->where('department_id',$prePR->department)->limit(1)->get()[0]->id;
        $PR->budget_tahunan_id = $request->budget_tahunan;
        $PR->pt_id = \App\budget::select('pt_id')->where('department_id',$prePR->department)->limit(1)->get()[0]->pt_id;
        
        $PR->department_id = $prePR->department;
        
        $PR->location_id = 1;

        $PR->no =  \App\Helpers\Document::new_number('PR', $prePR->department);
        $PR->date = $prePR->date;
        $PR->butuh_date = $prePR->butuh_date;
        $PR->is_urgent = $prePR->is_urgent;
        $PR->description = $prePR->deskripsi_umum;
        $status = $PR->save();
        for($i=0;$i<$prePR->jumlah_item;$i++){
            $PRD = new \App\PurchaseRequestDetail;
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
            $PRD->save();       
            \App\Helpers\Document::make_approval('Modules\PurchaseRequest\Entities\PurchaseRequestDetail',$PRD->id);
     
        }
        return redirect("/purchaserequest/detail/?id=". $PR->id);
    }
    public function get_satuan(Request $request)
    {
        var_dump($request->satuan);
        
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('purchaserequest::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('purchaserequest::edit');
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
    
    public function detail(Request $request)
    {
        $user = \Auth::user();
        $approve = DB::table("user_details")->where("user_id",$user->id)->select("can_approve")->first()->can_approve;
        $PR = purchaseRequest::get();
        $PRS = \App\PurchaseRequestDetail::where("purchaserequest_id",$request->id)->get();
        $status = [];
        foreach($PRS as $v){
            $approval_action_id =  DB::table("approvals")->select("approval_action_id")
                                        ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                        ->where("document_id",$v->id)->first();
            // if($approval_action_id->approval_action_id!=null)
            //     $status_approval = DB::table("approval_actions")->select("description")->where("id",$approval_action_id)->first();
            if (isset($approval_action_id))
                $status_approval = DB::table("approval_actions")->select("description")->where("id",$approval_action_id->approval_action_id)->first()->description;
            else
                $status_approval = "open";
            array_push($status,$status_approval);
        }

        return view('purchaserequest::detail',compact("user","PR","PRS","status","approve"));
        //return view('purchaserequest::index');
    }
    public function approve(Request $request){
        $id_PRD = $request->id;
        if($request->type == "approve"){
            DB::table("approvals")
            ->where("id", DB::table("approvals")->select("id")
                            ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                            ->where("document_id",$request->id)->first()->id)
            ->update(["approval_action_id"=>6]);
            return redirect("/purchaserequest/detail/?id=". $request->pr_id);
        }
        else if($request->type == "cancel"){
            DB::table("approvals")
                ->where("id", DB::table("approvals")->select("id")
                                ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                ->where("document_id",$request->id)->first()->id)
                ->update(["approval_action_id"=>9]);
            return redirect("/purchaserequest/detail/?id=". $request->pr_id);
        }else if($request->type == "approveAll"){
            $id_PR = DB::table("purchaserequest_details")->where("purchaserequest_id",$id_PRD)->select("id")->get();
            var_dump($id_PR);
            foreach($id_PR as $v){
                DB::table("approvals")
                    ->where("id", DB::table("approvals")->select("id")
                                    ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                    ->where("document_id",$v->id)->first()->id)
                    ->update(["approval_action_id"=>6]);

            }
            return redirect("/purchaserequest/detail/?id=". $id_PRD);
        }else if($request->type == "cancelAll"){
            $id_PR = DB::table("purchaserequest_details")->where("purchaserequest_id",$id_PRD)->select("id")->get();
            var_dump($id_PR);
            foreach($id_PR as $v){
                DB::table("approvals")
                    ->where("id", DB::table("approvals")->select("id")
                                    ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                                    ->where("document_id",$v->id)->first()->id)
                    ->update(["approval_action_id"=>9]);

            }
            return redirect("/purchaserequest/detail/?id=". $id_PRD);
        }else if($request->type == "cancelToApproveAll"){
            
        }

    }
    public function approve_cancel(Request $request){
        
    }

}

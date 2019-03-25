<?php

namespace Modules\PurchaseOrder\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\TenderPurchaseRequest\Entities\PurchaseOrder;
use Modules\TenderPurchaseRequest\Entities\PurchaseOrderDetail;
use Modules\PurchaseOrder\Entities\PurchaseOrderPr;
use Modules\PurchaseOrder\Entities\PurchaseOrderTerm;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaranDetail;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekananDetails;
use Modules\Tender\Entities\TenderMenang;
use Modules\Inventory\Entities\ItemProject;
use Modules\Inventory\Entities\Warehouse;
use Modules\Approval\Entities\Approval;
use Modules\Inventory\Entities\CreateDocument;
use Modules\Approval\Entities\ApprovalHistory;
use Modules\TenderPurchaseRequest\Entities\TenderMenangPR;

use Auth;
use DB;
use PDF;

class PurchaseOrderController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','project_session']);
    }

    public function index(Request $request)
    {
        $result = [];
        $project_id = $request->session()->get('project_id');
        $user = Auth::user();
        $project = Project::find($project_id);
        $PO = PurchaseOrder::where('project_for_id',$project_id)->get();
        return view('purchaseorder::index',compact("user","project","PO"));
    }

    public function getPO(Request $request)
    {
        $result = [];
        $project_id = $request->session()->get('project_id');
        $PO = PurchaseOrder::where('project_for_id',$project_id)->get();

        foreach ($PO as $key => $value) {
          $approval = Approval::where('document_id',$value->id)
                              ->where('document_type','Modules\TenderPurchaseRequest\Entities\PurchaseOrder')
                              ->join('approval_actions','approval_actions.id','approvals.approval_action_id')
                              ->select('approval_actions.description as status')
                              ->get();
          # code...

          $arr = [
            'id'=>$value->id,
            'no_po'=>$value->no,
            'nomor_tender'=>$value->tender_menang->tender->no,
            'supplier'=>$value->tender_menang->tender_purchase_request_group_rekanan_detail->rekanan->name,
            'description'=>$value->description,
            'status'=>$approval[0]->status
          ];

          array_push($result, $arr);
        }
        return datatables()->of($result)->toJson();
    }

    public function detail(Request $request){
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $PO_umum= PurchaseOrder::find($request->id);
        return view('purchaseorder::detail',compact("user","project","PO_umum"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $project_id = $request->session()->get('project_id');
        $result = [];
        $user = Auth::user();
        $project = Project::find($project_id);
        $get_rekanan = Approval::where([['approval_action_id','=',6],['document_type','LIKE','%TenderPurchaseRequestPenawaran%']])->get();

        $tender_menang = TenderMenangPR::join('approvals','approvals.document_id','tender_menang_pr.id_penawaran')
                                       ->where('tender_menang_pr.project_for_id',$project_id)
                                       ->where('approval_action_id','=',6)
                                       ->where('document_type','LIKE','%TenderPurchaseRequestPenawaran%')
                                       ->select('tender_menang_pr.id as id','tender_menang_pr.id_penawaran as id_penawaran', 'tender_menang_pr.tender_purchase_group_rekanan_id as tender_purchase_group_rekanan_id')
                                       ->get();
        foreach ($tender_menang as $key => $value) {
          # code...
          $qty_po = PurchaseOrder::select(DB::raw('sum(pod.quantity) as total'))
                  ->join('purchaseorder_details as pod','purchaseorders.id','pod.purchaseorder_id')
                  ->where('purchaseorders.id_tender_menang',$value->id)
                  ->first();

          $qty_penawaran = TenderPurchaseRequestPenawaran::find($value->id_penawaran)->details->sum('volume');

          $rekanan = TenderMenangPR::where('tender_purchase_group_rekanan_id',$value->tender_purchase_group_rekanan_id)->first();
          
          if($qty_penawaran-$qty_po->total > 0)
          {
              $arr = [
                'no_penawaran'=>$value->penawaran->no,
                'name'=>$rekanan->tender_purchase_request_group_rekanan_detail->rekanan->name,
                'id'=>$value->id
              ];

              array_push($result, $arr);
          }
            
        }
       
        return view('purchaseorder::create',compact("user","project","result","id"));
    }

    public function store(Request $request)
    {
        $project_id = $request->session()->get('project_id');
        $user_id = Auth::user()->id;
        $allitems = json_decode($request->allitems);
        $tender_menang = TenderMenangPR::find($request->id_penawaran);
        $rekanan_id_master = TenderPurchaseRequestGroupRekananDetails::find($tender_menang->rekanan_id)->rekanan_id;
        $project_id = $request->session()->get('project_id');
       // $check_if_exist = PurchaseOrder::where('id_tender_menang',$request->id_penawaran)->first();
        /*if($check_if_exist == null)
        {*/
            $PO = new PurchaseOrder;
            $PO->id_tender_menang = $request->id_penawaran;
            $PO->project_for_id = $project_id;
            $PO->no             = CreateDocument::createDocumentNumber('PO',2,$project_id,$user_id);
            $PO->rekanan_id     = $rekanan_id_master;
            $PO->description    = $request->deskripsi;
            $PO->project_for_id = $project_id;
            $execute = $PO->save();

            if($execute)
            {
                $approval = new Approval;
                $approval->approval_action_id   = 1;
                $approval->document_id          = $PO->id;
                $approval->document_type        = "Modules\TenderPurchaseRequest\Entities\PurchaseOrder";
                $approval->total_nilai          = 0;
                $createApproval = $approval->save();
                if($createApproval)
                {
                   if(count($allitems) > 0)
                   {
                      for($count = 0;$count < count($allitems);$count++)
                      {
                          $check_is_item_project = ItemProject::where([['item_id','=',$allitems[$count]->item_id],['project_id','=',$request->session()->get('project_id')]])->first();
                          if($check_is_item_project != null)
                          {
                            $POD = new PurchaseOrderDetail;
                            $POD->purchaseorder_id  = $PO->id;  // nanti
                            $POD->item_id           = $check_is_item_project->id;
                            $POD->brand_id          = $allitems[$count]->brand_id;
                            $POD->quantity          = $allitems[$count]->quantity;
                            $POD->satuan_id         = $allitems[$count]->satuan_id;
                            $POD->harga_satuan      = $allitems[$count]->harga_satuan;
                            $POD->ppn               = $allitems[$count]->ppn;
                            $POD->pph               = $allitems[$count]->pph;
                            $POD->discon             = NULL;
                            $POD->save();
                          }
                          else
                          {
                            $default_warehouse_id = Warehouse::where('project_id',$request->session()->get('project_id'))->first()->id;
                            $createItemProject = ItemProject::create([
                              'item_id'=>$allitems[$count]->item_id,
                              'project_id'=>$request->session()->get('project_id'),
                              'default_warehouse_id'=>$default_warehouse_id
                            ]);

                            if($createItemProject)
                            {
                              $POD = new PurchaseOrderDetail;
                              $POD->purchaseorder_id  = $PO->id;  // nanti
                              $POD->item_id           = $createItemProject->id;
                              $POD->brand_id          = $allitems[$count]->brand_id;
                              $POD->quantity          = $allitems[$count]->quantity;
                              $POD->satuan_id         = $allitems[$count]->satuan_id;
                              $POD->harga_satuan      = $allitems[$count]->harga_satuan;
                              $POD->ppn               = $allitems[$count]->ppn;
                              $POD->pph               = $allitems[$count]->pph;
                              $POD->discon             = $allitems[$count]->discount;
                              $POD->save();
                            }
                          }
                          
                      }
                   }
                }
            }
        //}
        /*else
        {
            return back()->withErrors(['Data Sudah Ada']);
        }*/
        
        return redirect("/purchaseorder/");
    }
    //po parsial

    public function getDataDetailItemPenawaran(Request $request)
    {
        $results = [];
        $id_penawaran = TenderMenangPR::find($request->id)->id_penawaran;
        $model_penawaran = TenderPurchaseRequestPenawaran::find($id_penawaran);

        $project_id = $request->session()->get('project_id');

        $check_tender_in_po = PurchaseOrder::where('id_tender_menang',$request->id)->get();
        

        if(count($check_tender_in_po) > 0 )
        {

                foreach ($model_penawaran->details as $key => $value) {
                  $item_id_project = ItemProject::where([['item_id','=',$value->item_id],['project_id','=',$project_id]])->first();

                  $qty_item = PurchaseOrder::select(DB::raw('sum(pod.quantity) as total'))
                  ->join('purchaseorder_details as pod','purchaseorders.id','pod.purchaseorder_id')
                  ->where('purchaseorders.id_tender_menang',$request->id)
                  ->where('pod.item_id',$item_id_project)
                  ->first();

                  $arr = [
                      'item_name'=>is_null($value->item) ? 'kosong' : $value->item->name,
                      'satuan_name'=>is_null($value->satuan) ? 'kosong' : $value->satuan->name,
                      'satuan_id'=>$value->item_satuan_id,
                      'item_id'=>$value->item_id,
                      'brand_name'=>is_null($value->brand) ? 'kosong' : $value->brand->name,
                      'brand_id'=>$value->brand_id,
                      'harga_satuan'=>$value->nilai,
                      'quantity'=> $value->volume-$qty_item->total,
                      'ppn'=>$model_penawaran->tender_purchase_request_group_rekanan_detail->rekanan->ppn,
                      'pph'=>is_null($item_id_project->pph) ? 0 : $item_id_project->pph
                  ];

                  array_push($results, $arr);
              }
        }
        else
        {
            foreach ($model_penawaran->details as $key => $value) {
              $item_id_project = ItemProject::where([['item_id','=',$value->item_id],['project_id','=',$project_id]])->first();
            # code...
                $arr = [
                    'item_name'=>is_null($value->item) ? 'kosong' : $value->item->name,
                    'satuan_name'=>is_null($value->satuan) ? 'kosong' : $value->satuan->name,
                    'satuan_id'=>$value->item_satuan_id,
                    'item_id'=>$value->item_id,
                    'brand_name'=>is_null($value->brand) ? 'kosong' : $value->brand->name,
                    'brand_id'=>$value->brand_id,
                    'harga_satuan'=>$value->nilai,
                    'quantity'=> $value->volume,
                    'ppn'=>$model_penawaran->tender_purchase_request_group_rekanan_detail->rekanan->ppn,
                    'pph'=>is_null($item_id_project->pph) ? 0 : $item_id_project->pph
                ];

                array_push($results, $arr);
            }
        }
        

        return response()->json($results);
    }

    public function approvePO(Request $request)
    {
        $stat = false;
        $project_id = $request->session()->get('project_id');
        $update = Approval::where('document_id', $request->id)->where('document_type', "Modules\TenderPurchaseRequest\Entities\PurchaseOrder")
              ->update([
                  'approval_action_id' => 6
              ]);

        $approval = Approval::where([['document_id','=',$request->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\PurchaseOrder']])->first();

        ApprovalHistory::where("approval_id",$approval->id)
                                     ->where("approval_action_id",2)
                                     ->delete();

        CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\PurchaseOrder',$project_id);

          if($update)
          {
            $stat = true;
          }

        return response()->json($stat);
    }

    public function request_approvePO_detail(Request $request)
    {
        $stat = false;
        $project_id = $request->session()->get('project_id');
        $update = Approval::where('document_id', $request->id)->where('document_type', "Modules\TenderPurchaseRequest\Entities\PurchaseOrder")
              ->update([
                  'approval_action_id' => 2
              ]);

        $approval = Approval::where([['document_id','=',$request->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\PurchaseOrder']])->first();

        ApprovalHistory::where("approval_id",$approval->id)
                                     ->where("approval_action_id",1)
                                     ->delete();

        CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\PurchaseOrder',$project_id);

          if($update)
          {
            $stat = true;
          }

        return redirect('/purchaseorder/detail?id='.$request->id);
    }

    public function undo_request_approvePO_detail(Request $request)
    {
        $stat = false;
        $project_id = $request->session()->get('project_id');
        $update = Approval::where('document_id', $request->id)->where('document_type', "Modules\TenderPurchaseRequest\Entities\PurchaseOrder")
              ->update([
                  'approval_action_id' => 1
              ]);

        $approval = Approval::where([['document_id','=',$request->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\PurchaseOrder']])->first();

        ApprovalHistory::where("approval_id",$approval->id)
                                     ->where("approval_action_id",2)
                                     ->delete();

        CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\PurchaseOrder',$project_id);

          if($update)
          {
            $stat = true;
          }

        return redirect('/purchaseorder/detail?id='.$request->id);
    }



    public function approvePOall(Request $request)
    {
         $stat = false;
         $arr_id = json_decode($request->id);
         if(count($arr_id) > 0)
         {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $po = PurchaseOrder::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$po->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\PurchaseOrder']]);

                if($approval_obj->first()->approval_action_id == 2)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>6]);

                    // $PRDApproval = DB::table("approvals")->where("document_id",$po->id)
                    //                                      ->where("document_type","Modules\TenderPurchaseRequest\Entities\PurchaseOrder")
                    //                                      ->select('*')
                    //                                      ->get();

                    // $AH = new ApprovalHistory;
                    // $AH->user_id = Auth::user()->id;
                    // $AH->approval_id = $PRDApproval[0]->id;
                    // $AH->approval_action_id = $PRDApproval[0]->approval_action_id;

                    // $AH->document_id = $PRDApproval[0]->document_id;
                    // $AH->document_type = $PRDApproval[0]->document_type;
                    // $status = $AH->save();

                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }


         return response()->json($stat);
    }

    public function undo_approvePO(Request $request)
    {
        $stat = false;
           $arr_id = json_decode($request->id);
           if(count($arr_id) > 0)
           {
              $checkInsert = 0;
              for ($i=0; $i < count($arr_id) ; $i++) { 
                  # code...
                  $po = PurchaseOrder::where('no',$arr_id[$i])->first();
                  $approval_obj = Approval::where([['document_id','=',$po->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\PurchaseOrder']]);

                  if($approval_obj->first()->approval_action_id == 6)
                  {
                      $change_status = $approval_obj->update(['approval_action_id'=>2]);

                      // $PRDApproval = DB::table("approvals")->where("document_id",$po->id)
                      //                                      ->where("document_type","Modules\TenderPurchaseRequest\Entities\PurchaseOrder")
                      //                                      ->select('*')
                      //                                      ->get();

                      // $AH = new ApprovalHistory;
                      // $AH->user_id = Auth::user()->id;
                      // $AH->approval_id = $PRDApproval[0]->id;
                      // $AH->approval_action_id = $PRDApproval[0]->approval_action_id;

                      // $AH->document_id = $PRDApproval[0]->document_id;
                      // $AH->document_type = $PRDApproval[0]->document_type;
                      // $status = $AH->save();

                      if($change_status)
                      {
                          $checkInsert++;
                      }
                  }
              }

              if($checkInsert > 0)
              {
                  $stat = true;
              }
           }


           return response()->json($stat);
    }

    public function request_approvePO(Request $request)
    {
         $stat = false;
         $project_id = $request->session()->get('project_id');
         $arr_id = json_decode($request->id);
         if(count($arr_id) > 0)
         {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $po = PurchaseOrder::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$po->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\PurchaseOrder']]);
                if($approval_obj->first()->approval_action_id == 1)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>2]);

                    $approval = Approval::where([['document_id','=',$po->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\PurchaseOrder']])->first();

                    ApprovalHistory::where("approval_id",$approval->id)
                                               ->where("approval_action_id",1)
                                               ->delete();

                    CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\PurchaseOrder',$project_id);

                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }


         return response()->json($stat);
    }

    public function undo_request_approvePO(Request $request)
    {
        $stat = false;
        $project_id = $request->session()->get('project_id');
           $arr_id = json_decode($request->id);
           if(count($arr_id) > 0)
           {
              $checkInsert = 0;
              for ($i=0; $i < count($arr_id) ; $i++) { 
                  # code...
                  $po = PurchaseOrder::where('no',$arr_id[$i])->first();
                  $approval_obj = Approval::where([['document_id','=',$po->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\PurchaseOrder']]);

                  if($approval_obj->first()->approval_action_id == 2)
                  {
                        $change_status = $approval_obj->update(['approval_action_id'=>1]);

                        $approval = Approval::where([['document_id','=',$po->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\PurchaseOrder']])->first();

                        ApprovalHistory::where("approval_id",$approval->id)
                                                   ->where("approval_action_id",2)
                                                   ->delete();

                        CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\PurchaseOrder',$project_id);

                      if($change_status)
                      {
                          $checkInsert++;
                      }
                  }
              }

              if($checkInsert > 0)
              {
                  $stat = true;
              }
           }

           return response()->json($stat);
    }

    public function makePDF(Request $request){ 

        $PO = PurchaseOrder::where("id",$request->id)->first();

        // return $PRHeader;
        $PODetail = PurchaseOrderDetail::where("purchaseorder_id",$PO->id)->get();
        // return $PRDetail;

        $pdf = PDF::loadView('purchaseorder::pdf', compact('PODetail'));
        

        return $pdf->download('purchaseorder.pdf');
    }

    
}

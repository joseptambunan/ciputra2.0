<?php

namespace Modules\PurchaseOrder\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use DB;

class PurchaseOrderController extends Controller
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
        // $PO_POD =   DB::table("purchaseorders")
        //             ->join("purchaseorder_details","purchaseorder_details.purchaseorder_id","purchaseorders.id")
        //             ->join("items","items.id","purchaseorder_details.item_id")
        //             ->select("purchaseorders.id","purchaseorders.no","purchaseorders.date","items.name","purchaseorders.description")
        //             ->get();
        $TPR = DB::table("tender_purchase_requests")
                //all in TPR
                ->join("approvals","approvals.document_id","tender_purchase_requests.id")
                ->where("approvals.document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequest")
                ->where("approvals.approval_action_id",2)
                //pemenang
                ->join("tender_purchase_request_rekanans","tender_purchase_request_rekanans.tender_purchase_request_id","tender_purchase_requests.id")
                ->where("tender_purchase_request_rekanans.is_pemenang",1)
                ->join("rekanans","rekanans.id","tender_purchase_request_rekanans.rekanan_id")
                //item dan brand
                ->join("tender_purchase_request_groups","tender_purchase_request_groups.id","tender_purchase_requests.tender_pr_groups_id")
                ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                ->join("items","items.id","purchaserequest_details.item_id")
                ->join("brands","brands.id","purchaserequest_details.brand_id")
                ->distinct()
                ->select("tender_purchase_requests.id","rekanans.name as pemenang","tender_purchase_requests.no","tender_purchase_requests.name","items.name as item","brands.name as brand")
                ->get();
        return view('purchaseorder::index',compact("user","project","TPR"));
    }
    public function detail(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $PO_POD =   DB::table("purchaseorders")
                    ->where("purchaseorders.id",$request->id)
                    ->join("purchaseorder_details","purchaseorder_details.purchaseorder_id","purchaseorders.id")
                    ->join("items","items.id","purchaseorder_details.item_id")
                    ->join("brands","brands.id","purchaseorder_details.brand_id")
                    ->join("item_satuans","item_satuans.id","purchaseorder_details.item_satuan_id")
                    ->select("purchaseorders.id","purchaseorders.no","purchaseorders.date","items.name","purchaseorders.description","brands.name as bName","item_satuans.name as isName","purchaseorder_details.quantity")
                    ->first();
           
        return view('purchaseorder::detail',compact("user","project","PO_POD"));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view('purchaseorder::create',compact("user","project"));
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
    public function show()
    {
        return view('purchaseorder::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('purchaseorder::edit');
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
}

<?php

namespace Modules\PurchaseOrder\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\User\Entities\User;
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
        $PO_POD =   DB::table("purchaseorders")
                    ->join("purchaseorder_details","purchaseorder_details.purchaseorder_id","purchaseorders.id")
                    ->join("items","items.id","purchaseorder_details.item_id")
                    ->select("purchaseorders.no","purchaseorders.date","items.name","purchaseorders.description")
                    ->get();
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));          
        return view('purchaseorder::index',compact("user","PO_POD","user","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('purchaseorder::create');
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

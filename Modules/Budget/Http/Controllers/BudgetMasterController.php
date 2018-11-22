<?php

namespace Modules\Budget\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Budget\Entities\BudgetType;
use Modules\Pekerjaan\Entities\GroupItem;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Budget\Entities\BudgetTypeDetail;

class BudgetMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = \Auth::user();
        return view('budget::master.index',compact("user"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $group_item = GroupItem::get();
        $budget_type = BudgetType::get();
        return view('budget::master.create',compact("user","group_item","budget_type"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = \Auth::user();
        $budget_type = new BudgetType;
        $budget_type->itempekerjaan_id = $request->group_item;
        $budget_type->created_by = $user->id;
        $budget_type->save();

        $itempekerjaan = Itempekerjaan::orderby("code","asc")->get();
        foreach ($itempekerjaan as $key => $value) {
            if ( $value->parent_id == null && $value->group_cost == $request->group_item ){
                if ( $value->code == "225" ){
                    foreach ($value->child_item as $key2 => $value2) {
                        if ( $value2->code == "225.01" || $value2->code == "225.04" || $value2->code == "225.05")  {                           
                            $budget_type_detail = new BudgetTypeDetail;
                            $budget_type_detail->budget_id = $budget_type->id;
                            $budget_type_detail->itempekerjaan_id = $value2->id;
                            $budget_type_detail->created_by = $user->id;
                            $budget_type_detail->save();
                        }                      
                    }
                }else{                   
                    $budget_type_detail = new BudgetTypeDetail;
                    $budget_type_detail->budget_id = $budget_type->id;
                    $budget_type_detail->itempekerjaan_id = $value->id;
                    $budget_type_detail->created_by = $user->id;
                    $budget_type_detail->save(); 
                }
            }
        }

        return redirect("budget/master/detail?id=".$budget_type->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $user = \Auth::user();
        $budget_type = BudgetType::find($request->id);
        return view('budget::master.show',compact("user","budget_type"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('budget::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $user = \Auth::user();
        $budget_type = BudgetType::find($request->id);
        $itempekerjaan = Itempekerjaan::orderby("code","asc")->get();
        foreach ($itempekerjaan as $key => $value) {
            if ( $value->parent_id == null && $value->group_cost == $budget_type->itempekerjaan_id ){
                if ( $value->code == "225" ){
                    foreach ($value->child_item as $key2 => $value2) {
                        if ( $value2->code == "225.01" || $value2->code == "225.04" || $value2->code == "225.05")  {              
                            $check = Itempekerjaan::find($value->id)->budget_type_detail->budget_type;
                            if ( $check == "" ){
                                if ( $check->id != $budget_type->id ){
                                   // echo "insert 1 ".$value->id;
                                }
                            }
                        }                      
                    }
                }else{                   
                    $check = Itempekerjaan::find($value->id)->budget_type_detail->budget_type;
                    if ( $check == "" ){
                        if ( $check->id != $budget_type->id ){
                            //echo "insert 1 ".$value->id;
                        }
                    }
                }
            }
            //echo "<br/>";            
        }
        return response()->json( ["status" => "0"] );
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $budget_type_detail = BudgetTypeDetail::find($request->id);
        $status =  $budget_type_detail->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }
}

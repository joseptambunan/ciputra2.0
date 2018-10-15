<?php

namespace Modules\Pekerjaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Pekerjaan\Entities\Itempekerjaan;
use Modules\Pekerjaan\Entities\Coa;
use Modules\Pekerjaan\Entities\ItempekerjaanCoa;
use Modules\Department\Entities\Department;
use Modules\Budget\Entities\BudgetGroup;
use Modules\Pekerjaan\Entities\ItempekerjaanProgress;
use Modules\Project\Entities\Project;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $user = \Auth::user();
        $itempekerjaan = Itempekerjaan::where("parent_id",null)->get();
        $project = Project::get();
        return view('pekerjaan::index',compact("user","itempekerjaan","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = \Auth::user();
        $department = Department::get();
        $budgetgroup = BudgetGroup::get();
        $project = Project::get();
        return view('pekerjaan::create',compact("user","department","budgetgroup","project"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $itempekerjaan = new Itempekerjaan;
        $itempekerjaan->parent_id = null;
        $itempekerjaan->department_id = $request->department;
        $itempekerjaan->group_cost = $request->group_cost;
        $itempekerjaan->code = $request->code;
        $itempekerjaan->tag = $request->tag;
        $itempekerjaan->name = $request->name;
        $itempekerjaan->ppn = $request->ppn;
        $itempekerjaan->save();
        return redirect("/pekerjaan/detail/?id=".$itempekerjaan->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $user = \Auth::user();
        $itempekerjaan = Itempekerjaan::find($request->id);
        $department = Department::get();
        $budgetgroup = BudgetGroup::get();
        $coa = Coa::get();
        $project = Project::get();
        return view('pekerjaan::detail',compact("itempekerjaan","user","department","budgetgroup","coa","project"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function coas(Request $request)
    {
        $itemcoas = new ItempekerjaanCoa;
        $itemcoas->itempekerjaan_id = $request->coas_itempekerjaan;
        $itemcoas->department_id = $request->department_id;
        $itemcoas->coa_id = $request->coa;
        $itemcoas->save();
        return redirect("/pekerjaan/detail/?id=".$request->coas_itempekerjaan);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $itempekerjaan = Itempekerjaan::find($request->id);
        $itempekerjaan->department_id = $request->department;
        $itempekerjaan->group_cost = $request->group_cost;
        $itempekerjaan->code = $request->code;
        $itempekerjaan->tag = $request->tag;
        $itempekerjaan->name = $request->name;
        $itempekerjaan->ppn = $request->ppn;
        $itempekerjaan->description = $request->description;
        $itempekerjaan->save();
        return redirect("/pekerjaan/detail/?id=".$request->id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $itempekerjaan = Itempekerjaan::find($request->id);
        $status = $itempekerjaan->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function subitem(Request $request){

    }

    public function addprogress(Request $request){

        foreach ($request->item as $key => $value) {
            # code...            
            $check = ItempekerjaanProgress::where("item_pekerjaan_id",$request->item_id)->where("termyn", $key + 1)->get();
            if ( count($check) > 0 ){
                $ItempekerjaanProgress = ItempekerjaanProgress::find($check->first()->id);
            }else{                
                $ItempekerjaanProgress = new ItempekerjaanProgress;
            }
            $ItempekerjaanProgress->item_pekerjaan_id = $request->item_id;
            $ItempekerjaanProgress->termyn = $key + 1;
            $ItempekerjaanProgress->percentage =  $request->item[$key];
            $ItempekerjaanProgress->save();
        }
        return redirect("/pekerjaan/detail/?id=".$request->coa_id);

    }

    public function addchilditem(Request $request){
        $parent = Itempekerjaan::find($request->item_pekerjaan);
        $itempekerjaan = new Itempekerjaan;
        $itempekerjaan->parent_id = $request->item_pekerjaan;
        $itempekerjaan->department_id = $parent->department_id;
        $itempekerjaan->group_cost = $parent->group_cost;
        $itempekerjaan->code       = $request->code;
        $itempekerjaan->name       = $request->item_child;
        $itempekerjaan->ppn        = $parent->ppn / 100;
        $itempekerjaan->tag        = $parent->tag;
        $itempekerjaan->description = $request->item_child;
        $status = $itempekerjaan->save();
        return redirect("/pekerjaan/detail/?id=".$request->item_coa);
    }
}

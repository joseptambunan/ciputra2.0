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
use Modules\Pekerjaan\Entities\ItempekerjaanDetail;
use Modules\Satuan\Entities\CoaSatuan;
use Modules\Pekerjaan\Entities\ItempekerjaanHarga;
use Modules\Pekerjaan\Entities\ItempekerjaanHargaDetail;

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
        $start = 0;
        $satuan = CoaSatuan::get();
        return view('pekerjaan::detail',compact("itempekerjaan","user","department","budgetgroup","coa","project","start","satuan"));
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
        $itempekerjaan->code       = $parent->code.".".$parent->child_item->count();
        $itempekerjaan->name       = $request->item_child;
        $itempekerjaan->ppn        = $parent->ppn / 100;
        $itempekerjaan->tag        = $parent->tag;
        $itempekerjaan->description = $request->item_child;
        $status = $itempekerjaan->save();
        return redirect("/pekerjaan/detail/?id=".$request->item_coa);
    }

    public function savesatuan(Request $request){

        foreach ($request->item_id_ as $key => $value) {
            $detail = Itempekerjaan::find($request->item_id_[$key])->details;
            if ( $detail != ""){
                $itempekerjaan_detail = ItempekerjaanDetail::find($detail->id);
                $itempekerjaan_detail->satuan = $request->item_satuan_[$key];
                $itempekerjaan_detail->save(); 
            }else{            
                $itempekerjaan_detail = new ItempekerjaanDetail;
                $itempekerjaan_detail->itempekerjaan_id = $request->item_id_[$key];
                $itempekerjaan_detail->satuan = $request->item_satuan_[$key];
                $itempekerjaan_detail->save(); 
            }
        }
        return redirect("/pekerjaan/detail/?id=".$request->coa_id);
    }

    public function library(Request $request){
        $user = \Auth::user();
        $project = Project::get();
        $itempekerjaan = Itempekerjaan::find($request->id);
        $class = "";
        $nilai_library_satuan = 0;
        $total_library = 0;
        foreach ($itempekerjaan->harga as $key => $value) {
            if ( $value->project_id == null ){
                $nilai_library_satuan = $value->nilai;
            }
        }

        foreach ($itempekerjaan->child_item as $key => $value) {
            $total_library = $total_library + $value->nilai_library;
        }
        return view("pekerjaan::add_library",compact("user","project","itempekerjaan","class","nilai_library_satuan","total_library"));
    }

    public function savelibrary(Request $request){
        $user = \Auth::user();
        if ( $request->nilai_[0] != "" ){
            $detail_master = Itempekerjaan::find($request->item_id_[0]);   
            $itempekerjaan_harga = new ItempekerjaanHarga;
            $itempekerjaan_harga->itempekerjaan_id = $request->parent_id;
            $itempekerjaan_harga->project_id = null;
            $itempekerjaan_harga->nilai = str_replace(",", "", $request->nilai_[0]);
            $itempekerjaan_harga->satuan = $detail_master->details->satuan;
            $itempekerjaan_harga->created_by = $user->id;
            $itempekerjaan_harga->save();
        }

        foreach ($request->nilai_ as $key => $value) {
            if ( $request->item_id_[$key] != $request->tag ){
                $tag = 0;
            }else{
                $tag = 1;
            }

            $itempekerjaan = Itempekerjaan::find($request->item_id_[$key]);
            $itempekerjaan->tag = $tag;
            $itempekerjaan->save();  

            if ( $request->nilai_[$key] != "" ){
                if ( $key > 0 ){
                    $itempekerjaan_harga_detail = new ItempekerjaanHargaDetail;
                    $itempekerjaan_harga_detail->itempekerjaan_id = $request->item_id_[$key];    
                    $itempekerjaan_harga_detail->itempekerjaan_harga_id = $itempekerjaan_harga->id;
                    $itempekerjaan_harga_detail->project_id = null;
                    $itempekerjaan_harga_detail->nilai = str_replace(",", "", $request->nilai_[$key]);                
                    $itempekerjaan_harga_detail->satuan = $itempekerjaan->details->satuan;
                    $itempekerjaan_harga_detail->created_by = $user->id;
                    $itempekerjaan_harga_detail->save();
                }
            }
        }        
        return redirect("pekerjaan/library-detail/?id=".$request->parent_id);
    }
}

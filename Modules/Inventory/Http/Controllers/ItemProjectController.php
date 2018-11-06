<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Project\Entities\Project;
use Modules\Inventory\Entities\ItemProject;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\ItemSatuan;
use Modules\Inventory\Entities\PermintaanbarangDetail;
use Modules\Inventory\Entities\Inventory;
use DB;
use Auth;
class ItemProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::items_project.index', compact('project','user'));
    }
    public function getData(Request $request)
    {
        $items = ItemProject::get();
        $results = [];
        foreach ($items as $key => $value){
            # code...
            $satuan_name = ItemSatuan::select('name')->where([['konversi','=',DB::raw("(( select min(st.konversi) from item_satuans as st where st.item_id = item_id and st.deleted_at is null ))")],['item_id',$value->item_id]])->first();
            $arr = array(
                'id' => $value->id,
                'item_id'=>$value->item_id,
                'item_category'=> $value->item->category->name,
                'item_name' => $value->item->name,
                'stock_min' =>$value->stock_min,
                'satuan'=>is_null($satuan_name) ? 'Kosong' : $satuan_name->name,
            );
            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $items = Item::all();
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::items_project.create',compact('user','project','items'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $stat = false;
        $satuan_warning = $request->satuan_warning;
            if($satuan_warning == "on") {
                $nilai_satuan_warning = 1;
            }else{
                $nilai_satuan_warning = 0;
            }
        $inventory = $request->is_inventory;
            if($inventory == "on") {
                $nilai_inventory = 1;
                }else{
                $nilai_inventory = 0;
            }
        $consumable = $request->is_consumable;
            if($consumable == "on") {
                $nilai_consumable = 1;
            }else{
                $nilai_consumable = 0;
            }

        $create = ItemProject::create(['item_id'=>$request->item_id,
            'project_id'=>$request->session()->get('project_id'),
            'stock_min'=>$request->stock_min,
            'is_inventory'=>$nilai_inventory,
            'is_consumable'=>$nilai_consumable,
            'description'=>$request->description]);
        if($create)
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('inventory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request,$id)
    {
        $item = ItemProject::find($id);
        $user = Auth::user();
        $items = Item::all();
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::items_project.edit',compact('project','item','user','items'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $stat = false;
        $satuan_warning = $request->satuan_warning;
            if($satuan_warning == "on") {
                $nilai_satuan_warning = 1;
            }else{
                $nilai_satuan_warning = 0;
            }
        $inventory = $request->is_inventory;
            if($inventory == "on") {
                $nilai_inventory = 1;
                }else{
                $nilai_inventory = 0;
            }
        $consumable = $request->is_consumable;
            if($consumable == "on") {
                $nilai_consumable = 1;
            }else{
                $nilai_consumable = 0;
            }

        $updated = ItemProject::find($request->id)
        ->update(['item_id'=>$request->item_id,
            'stock_min'=>$request->stock_min,
            'is_inventory'=>$nilai_inventory,
            'is_consumable'=>$nilai_consumable,
            'description'=>$request->description]);

        if($updated)
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function details(Request $request,$id)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $stockResults = [];
        $arrsatuans = [];
        if($id > 0)
        {
            $item = ItemProject::find($id);

            foreach ($item->item->satuans as $key => $value) {
                # code...
                $allsatuans = array(
                    'no' =>$key+1,
                    'satuan_name' => $value->name
                );
                array_push($arrsatuans, $allsatuans);
            }
            $results = array(
                'name' => $item->item->name,
                'item_category' => $item->item->category->name,
                'satuan_warning' => $item->satuan_warning,
                'stock_min' => $item->stock_min,
                'is_inventory' => $item->is_inventory,
                'is_consumable' => $item->is_consumable,
                'description' => $item->description,
                'default_warehouse' => is_null($item->warehouse) ? '' : $item->warehouse->name
            );
        }

        $booking = PermintaanbarangDetail::select('item_id',DB::raw('sum(quantity) as booking'))->where('item_id',$id)->groupBy('item_id')->first();

        $stocks = Inventory::select('inventories.item_id',DB::raw('sum(inventories.quantity) as total_stock_onhand'),DB::raw('sum(inventories.quantity)-sum(permintaanbarang_details.quantity) as total_stock_avaible'))->leftJoin('permintaanbarang_details','inventories.item_id','=','permintaanbarang_details.item_id')->groupBy('item_id')->get();
        $getItemStockByWarehouse =  Inventory::select('item_id','warehouse_id',DB::raw('sum(quantity) as total_stock'))
        ->where('item_id',$id)->groupBy('item_id','warehouse_id')->get();

        foreach ($getItemStockByWarehouse as $key => $value) {
            # code...
            $sub_data = array(
                'warehouse_name'=> $value->warehouse->name,
                'total_stock' => $value->total_stock,
                'satuan' =>$value->item->satuans[0]->name
            );

            array_push($stockResults, $sub_data);
        }
        
        $stockResults = json_encode($stockResults);
        $results = json_encode($results);
        $resultSatuans = json_encode($arrsatuans);
        return view('inventory::items_project.details',compact('results','stockResults','resultSatuans','booking','project','user'));
       // return response()->json($results);
    }
}

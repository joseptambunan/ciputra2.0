<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\PermintaanbarangDetail;
use Modules\Inventory\Entities\ItemCategory;
use Modules\Inventory\Entities\Warehouse;
use Modules\Project\Entities\Project;
use Modules\Inventory\Entities\Brand;
use Modules\Inventory\Entities\Inventory;
use Modules\Inventory\Http\Requests\RequestItem;
use datatables;
use DB;
use PDF;
use Auth;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $project = Project::all();
        $items   = Item::all();
        return view('inventory::items.index', compact('items','project','user'));
    }

    public function add(Request $request)
    {
        $user = Auth::user();
        $project = Project::all();
        $item_categories            = ItemCategory::where('parent_id',0)->get();
        $brands                     = Brand::all();

        return view('inventory::items.add_form', compact('item_categories','brands','user','project'));
    }
    
    public function addPost(RequestItem $request) 
    {
        $stat = 0;
		/*$satuan_warning = $request->satuan_warning;
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
			}*/
		
        $items                          = new Item;
        $items->kode                     = $request->kode;
        $items->item_category_id        = $request->item_category_id;
        $items->sub_item_category_id    = $request->sub_item_category_id;
        /*$items->default_warehouse_id    = $request->default_warehouse_id;*/
        $items->brand_id                = $request->brand_id;
        $items->name                    = $request->name;
       /* $items->satuan_warning          = $nilai_satuan_warning;
        $items->stock_min               = $request->stock_min;
        $items->is_inventory            = $nilai_inventory;
        $items->is_consumable           = $nilai_consumable;*/
        $items->description             = $request->description;
        $status                         = $items->save();

        if ($status) 
        {
            $stat=1;
            // return redirect($to = 'items/index', $status = 302, $headers = [], $secure = null);
      }else{
          //  return 'Failed';
        }
        return response()->json(['return'=>$stat]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $project = Project::all();
        $brands = Brand::all();
        $item                      = Item::find($request->id);
        $item_categories            = ItemCategory::get();
        $subcategories = ItemCategory::find($item->item_category_id)->child()->get();
        
        return view('inventory::items.edit_form', compact('brands','item', 'item_categories','subcategories','user','project'));
    }

    public function update(Request $request)
    {
        $stat = false;
        $items                          = Item::find($request->id);
        $items->item_category_id        = $request->item_category_id;
        $items->sub_item_category_id    = $request->sub_item_category_id;
       /* $items->default_warehouse_id    = $request->default_warehouse_id;*/
        $items->name                    = $request->name;
        /*$items->satuan_warning          = $request->satuan_warning;
        $items->stock_min               = $request->stock_min;
        $items->is_inventory            = $request->is_inventory;
        $items->is_consumable           = $request->is_consumable;*/
        $items->description             = $request->description;
        $status                         = $items->save();

        if ($status) 
        {
            $stat = true;
        }

        return response()->json($stat);

    }

    public function delete(Request $request)
    {
        $items                          = Item::find($request->id);
        $status                         = $items->delete();
        $stat = false;
        if ($status) 
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function getItems(Request $request)
    {
        
        $items = Item::select('items.id as item_id','items.item_category_id','items.name as item_name','cte.sat')
        ->leftJoin(
            DB::raw("((select it.item_id as id_it,it.name as sat from item_satuans as it where it.konversi = (select min(st.konversi) from item_satuans as st where st.item_id = it.item_id))) as cte"),
            'items.id','=','cte.id_it')
        ->groupBy('items.id','item_category_id','items.name','cte.sat')->get();

        $results = [];
        foreach ($items as $key => $value){
            # code...
            $arr = array(
                'id' => $value->item_id,
                'item_category'=> $value->category->name,
                'item_name' => $value->item_name,
                'satuan'=>is_null($value->sat) ? '-' : $value->sat
            );
            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();

    }

    /*public function details(Request $request,$id)
    {
        $user = Auth::user();
        $project = Project::all();
        $stockResults = [];
        $arrsatuans = [];
        if($id > 0)
        {
            $item = Item::find($id);

            foreach ($item->satuans as $key => $value) {
                # code...
                $allsatuans = array(
                    'no' =>$key+1,
                    'satuan_name' => $value->name
                );
                array_push($arrsatuans, $allsatuans);
            }
            $results = array(
                'name' => $item->name,
                'item_category' => $item->category->name,
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
        return view('inventory::items.details_item',compact('results','stockResults','resultSatuans','booking','project','user'));
       // return response()->json($results);
    }*/

    public function getSubCategories(Request $request)
    {
        $id = $request->id;
        $subcategories = ItemCategory::find($id)->child()->get();

        return response()->json($subcategories);
    }

    public function report_temp()
    {
        $temp = Item::select('items.name as item_name',DB::raw('sum(inventories.quantity) as total_stock'),'item_satuans.name as satuan')
        ->leftJoin('inventories','items.id','=','inventories.item_id')
        ->leftJoin('item_satuans','items.id','=','item_satuans.item_id')
        ->groupBy('items.name','item_satuans.name')->where('item_satuans.konversi',1)->get();

    }
    public function Report()
    {
       /* $arritem = [];
        $arrsatuan = [];
        $arrkonversi = [];

        $getItems = Item::select('items.name as item_name','item_satuans.name as satuan','item_satuans.konversi')
        ->leftJoin('item_satuans','items.id','=','item_satuans.item_id')
        ->where(function($q){
            $q->where('item_satuans.konversi',DB::raw("(select min(konversi) from item_satuans its where its.item_id=item_satuans.item_id)"))
            ->orWhere('item_satuans.konversi',DB::raw("(select max(konversi) from item_satuans its where its.item_id=item_satuans.item_id)"));
        })->orderBy('items.name')->get();

        foreach ($getItems as $key => $value) {
            # code...
            array_push($arritem, $value->item_name);
            array_push($arrsatuan, $value->satuan);
            array_push($arrkonversi, $value->konversi);
        }

        $arrResults = [];
        for($count = 0 ; $count < sizeof($arrsatuan); $count++)
        {
            $item = $arritem[$count];

            if(!isset($arrResults[$item]))
            {
                $arrResults[$item] = [];
                $arrResults[$item]['rowspan'] = 0;
            }

            $arrResults[$item]['printed'] = 'no';
            $arrResults[$item]['rowspan'] +=1;
        }

       return view('items.report',compact('arrResults','arrsatuan','arritem','arrkonversi'));
        //return response()->json($getItems);*/

       /*$data =  Item::select('items.id as item_id','items.item_category_id','items.name as item_name','items.stock_min','item_satuans.name as satuan')
       ->leftJoin('item_satuans','items.id','=','item_satuans.item_id')
       ->where('item_satuans.konversi',
        DB::raw("(select it.item_id as id_it,it.name as sat from item_satuans as it where it.konversi = (select min(st.konversi) from item_satuans as st where st.item_id = it.item_id)) as"))->orderBy('items.name')->get()*/
    }
}

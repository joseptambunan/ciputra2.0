<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\InventarisirDetail;
use Modules\Inventory\Entities\Inventarisir;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\BarangKeluarDetail;
use Modules\Project\Entities\Project;
use Modules\Globalsetting\Entities\Globalsetting;

class InventarisirDetailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = \Auth::user();
        $inventarisir_id = $request->id;
        $project = Project::find($request->session()->get('project_id'));
        $inventarisirDetailCollections = InventarisirDetail::where('inventarisir_id',$inventarisir_id)->get();
        /*if(count($inventarisirDetailCollections) > 0)
        {*/
        return view('inventory::inventarisir_detail.index',compact('inventarisirDetailCollections','request','project','user'));
        //}
        /*else
        {
            return redirect($to = '/inventarisir_detail/add_form?id='.$inventarisir_id, $status = 302, $headers = [], $secure = null);
        }*/
    	
    }

    public function add(Request $request)
    {
        $projectname = Project::find($request->session()->get('project_id'))->name;
    	$inventarisir_id = $request->id;

    	$Items = Item::all();
        $Inventarisir = Inventarisir::find($inventarisir_id);
        $BarangKeluarDetail=null;

        if($Inventarisir != null)
        {
            $BarangKeluarDetail = BarangKeluarDetail::where('barangkeluar_id','=',$Inventarisir->barangkeluar->id)->get();
        }

        return view('inventory::inventarisir_detail.add_form',compact('projectname','inventarisir_id','Items','BarangKeluarDetail'));
    }

    public function edit(Request $request)
    {
        $inventarisirDetail = InventarisirDetail::find($request->id);
        $Items 		  = Item::all();

        return view('inventarisir_detail.edit_form', compact('inventarisirDetail', 'Items'));
    }

    public function addPost(Request $request)
    {
    	$stat =0;
    	
    	$inventarisir_id = $request->inventarisir_id;
    	$barangkeluar_detail_id = $request->barangkeluar_detail_id;
    	$item_id = $request->item_id;
    	$inventory_id = $request->inventory_id;
    	$quantity = $request->quantity;
    	$price = $request->mprice;
    	$ppn = Globalsetting::where('parameter','ppn')->first()->value;
    	$purchased_date = $request->date;

    	try{
    		$InsertDetailInventarisir = InventarisirDetail::create(
    			[
		            'inventarisir_id' => $inventarisir_id,
		            'barangkeluar_detail_id' => $barangkeluar_detail_id,
		            'item_id' => $item_id,
		            'inventory_id' => $inventory_id,
		            'quantity' => $quantity,
		            'price' => $price,
		            'ppn' => $ppn/100,
		            'purchased_date' => $purchased_date
            	]
    		);
    		if($InsertDetailInventarisir)
	        {
	            $stat = 1;
	        }
    	}
    	catch(Exception $e)
    	{}

    	return response()->json(['return'=>$stat,'id'=>$inventarisir_id]);
    }

    public function addPostOther(Request $request)
    {
        $stat =0;
        $action ='';

        $inventarisir_id = $request->inventarisir_id;
        $barangkeluar_detail_id = $request->barangkeluar_detail_id;
        foreach ($barangkeluar_detail_id as $key => $value) {
            # code...
            $action = InventarisirDetail::create(
                [
                    'inventarisir_id' => $inventarisir_id,
                    'barangkeluar_detail_id' => $value,
                    'item_id' => BarangKeluarDetail::find($value)->item_id,
                    'inventory_id' => BarangKeluarDetail::find($value)->inventory_id,
                    'quantity' => BarangKeluarDetail::find($value)->quantity,
                    'price' => BarangKeluarDetail::find($value)->price,
                    //'purchased_date' => $purchased_date,
                    'ppn' => BarangKeluarDetail::find($value)->ppn
                ]
            );
        }
        if($action)
        {
            $stat=1;
        }

        return response()->json(['return'=>$stat,'id'=>$inventarisir_id]);
    }
    //update
    public function update(Request $request)
    {
        $stat =0;
        
        $id = $request->id;
        $inventarisir_id = $request->inventarisir_id;
        $barangkeluar_detail_id = $request->barangkeluar_detail_id;
        $item_id = $request->item_id;
        $inventory_id = $request->inventory_id;
        $quantity = $request->quantity;
        $price = $request->mprice;
        $ppn = $request->ppn;
        $purchased_date = $request->date;

        try{
            $UpdateDetailInventarisir = InventarisirDetail::find($id)->update(
                [
                    'inventarisir_id' => $inventarisir_id,
                    'barangkeluar_detail_id' => $barangkeluar_detail_id,
                    'item_id' => $item_id,
                    'inventory_id' => $inventory_id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'ppn' => $ppn,
                    'purchased_date' => $purchased_date
                ]
            );
            if($UpdateDetailInventarisir)
            {
                $stat = 1;
            }
        }
        catch(Exception $e)
        {}

        return response()->json(['return'=>$stat,'id'=>$inventarisir_id]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $deleteInventarisirDetail = InventarisirDetail::find($id)->delete();
        if($deleteInventarisirDetail)
        {
            return "1";

        }
        else
        {
            return "Delete Failed";
        }
    }
}

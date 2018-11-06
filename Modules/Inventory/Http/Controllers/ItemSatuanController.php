<?php

namespace Modules\Inventory\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Http\Requests\RequestItemSatuan;

use Modules\Inventory\Entities\ItemSatuan;
use Modules\Inventory\Entities\Item;
use Modules\Project\Entities\Project;

class ItemSatuanController extends Controller
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
        $user = \Auth::user();
        $project = Project::all();
        $items = null;
        if($request->id <> null) {

            $items_satuans      = ItemSatuan::where('item_id', '=', $request->id);
            $items              = Item::find($request->id);
        }
        else
        {
            $items_satuans      = ItemSatuan::select();
        }

        $items_satuans = $items_satuans->get();

        return view('inventory::items_satuan.index', compact('request', 'items_satuans', 'items','project','user'));
    }

    public function add(Request $request)
    {
        $items = Item::find($request->id);
        $user = \Auth::user();
        $project = Project::all();
        return view('inventory::items_satuan.add_form', compact('items','user','project'));
    }
    
    public function addPost(RequestItemSatuan $request) 
    {
        $stat = false;
        $items_satuan                   = new ItemSatuan;
        $items_satuan->item_id          = $request->item_id;
        $items_satuan->name             = $request->name;
        $items_satuan->konversi         = $request->konversi;
        $status                         = $items_satuan->save();

        if ($status) 
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function edit(Request $request)
    {
        $items_satuans                      = ItemSatuan::find($request->id);
        return view('items_satuan.edit_form', compact('items_satuans'));
    }

   public function update(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = ItemSatuan::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);

    }

    public function delete(Request $request)
    {
        $items_satuan               = ItemSatuan::find($request->id);
        $status                     = $items_satuan->delete();
        $stat = false;
        if ($status)
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function typeSatuan(Request $request)
    {
        $results = [];
        $term = $request->terms;
        $getSatuan = ItemSatuan::select('name')->where('name','like','%'.$term.'%')->get();
        $temp = '';
        foreach ($getSatuan as $key => $value) {
            # code...
            if(strcmp($value->name ,$temp) != 0)
            {
                array_push($results, $value->name);
            }
            $temp = $value->name;

        }
        return response()->json($results);
    }
}
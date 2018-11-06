<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Permintaanbarang;
use Modules\Inventory\Entities\PermintaanbarangDetail;
use Modules\Inventory\Entities\Barangkeluar;
use Modules\Inventory\Entities\BarangkeluarDetail;
use Modules\Inventory\Entities\Warehouse;
use Modules\Inventory\Entities\Item;
use Modules\Project\Entities\Project;
use Auth;

class BarangKeluarDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permintaan = null;
        $project = Project::find($request->session()->get('project_id'));
        $user = Auth::user();
        if($request->id <> null && $request->permintaanbarang_id <> null)
        {
            $barangkeluars              = Barangkeluar::find($request->id);
            $barangkeluar_details       = BarangkeluarDetail::where('barangkeluar_id', '=', $request->id)->latest()->take(1000)->get();

            $permintaan                = Permintaanbarang::find($request->permintaanbarang_id);
        }
        else
        {
            $barangkeluar_details       = BarangkeluarDetail::all();
        }

        return view('inventory::barang_keluar_detail.index', compact('project','request','barangkeluar_details', 'barangkeluars', 'permintaan','user'));
    }
    
    public function add(Request $request)
    {
        $barangkeluar                  = Barangkeluar::find($request->id);
        $permintaan                    = Permintaanbarang::find($request->id);
        $permintaanbarang_details      = PermintaanbarangDetail::where('permintaanbarang_id', '=', $request->permintaanbarang_id)->get();
        $warehouses                     = Warehouse::get();

        return view('barang_keluar_detail.add_form', compact('request', 'barangkeluar', 'permintaan', 'permintaanbarang_details', 'warehouses'));
    }
    
    public function addPost(Request $request)
    {
        $stat = false;
        $barangkeluarDetail ='';
        $lists_data = json_decode($request->data);
        if(count($lists_data) > 0)
        {
            for($i=0;$i<count($lists_data);$i++)
            {
                $barangkeluarDetail = BarangkeluarDetail::create([
                                            'barangkeluar_id' => $lists_data[$i]->barangkeluar_id,
                                            'permintaanbarang_detail_id' => $lists_data[$i]->permintaanbarang_detail_id,
                                            'item_id' => $lists_data[$i]->item_id,
                                            'warehouse_id' => $lists_data[$i]->warehouse_id,
                                            'item_satuan_id'=>$lists_data[$i]->item_satuan_id,
                                            //'price' => $lists_data[$i]->price ,
                                            'ppn' => 0,
                                           // 'inventory_id' => $lists_data[$i]->InventoryMasuk->id,
                                            'quantity' => $lists_data[$i]->quantity
                                        ]);
            }
        }
        
        if($barangkeluarDetail)
        {
            $stat = true;
        }
        return response()->json($stat);       
    }

    public function edit(Request $request)
    {
        $barangkeluar_detail               = BarangkeluarDetail::find($request->id);
        //$permintaanbarang_details           = PermintaanbarangDetail::where('permintaanbarang_id', '=', $request->id)->get();
        //$barangkeluar                      = Barangkeluar::find($request->barangkeluar_id);
        //$permintaan                        = Permintaanbarang::find($request->permintaanbarang_id);
        $warehouses                         = Warehouse::get();
        $items                              = Item::select('id','name')->get();

        return view('barang_keluar_detail.edit_form', compact('barangkeluar_detail', 'permintaanbarang_details', 'barangkeluar', 'permintaan', 'warehouses', 'items'));
    }

    public function itemModal(Request $request)
    {
        $barangkeluar_details               = BarangkeluarDetail::find($request->id);

        return view('barang_keluar_detail.edit_form', compact('barangkeluar_details', 'permintaanbarang_details', 'barangkeluars', 'permintaans', 'warehouses', 'items'));
    }

    public function update(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = BarangkeluarDetail::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
        
    }
    
    /*public function update(Request $request)
    {


        $barang_keluar_details                                      = BarangkeluarDetail::find($request->id);
        //$barang_keluar_details->barangkeluar_id                     = $request->barangkeluar_id;
        $barang_keluar_details->permintaanbarang_detail_id          = $request->permintaanbarang_detail_id;
        $barang_keluar_details->item_id                             = $request->item_id;
        $barang_keluar_details->warehouse_id                        = $request->warehouse_id;
        $status                                                     = $barang_keluar_details->save();

        if($status)
        {
            return redirect($to = '/barang_keluar_detail/index?id='.$barang_keluar_details->barangkeluar_id.'&permintaanbarang_id='.$barang_keluar_details->barangkeluar->permintaanbarang_id, $status = 302, $headers = [], $secure = null);
        }
        else
        {
            return 'Failed';
        }
    }*/

    public function delete(Request $request)
    {
        $barang_keluars                             = \App\BarangkeluarDetail::find($request->id);
        $status                                     = $barang_keluars->delete();

        if ($status) 
        {
            return $barang_keluars;
        }else{
            return 'Failed';
        }
    }

    public function sent(Request $request)
    {
        $id = $request->id;
        $stat = false;
        $update = BarangkeluarDetail::find($id)->update(['is_sent'=>true]);
        if($update)
        {
            $stat = true;
        }

        return response()->json($stat);
    }
}

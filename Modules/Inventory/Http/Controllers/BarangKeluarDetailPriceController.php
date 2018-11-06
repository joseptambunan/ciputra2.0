<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permintaanbarang;
use App\PermintaanbarangDetail;
use App\Barangkeluar;
use App\BarangkeluarDetail;
use App\BarangkeluarDetailPrice;
use App\Inventory;

class BarangKeluarDetailPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->id <> null && $request->permintaanbarang_id <> null && $request->barangkeluar_id <> null)
        {
            $barangkeluars              = Barangkeluar::find($request->barangkeluar_id);
            $barangkeluar_details       = BarangkeluarDetail::find($request->id);
            $barangkeluar_detail_prices = BarangkeluarDetailPrice::where('barangkeluar_detail_id', '=', $request->id)->latest()->take(1000)->get();

            $permintaan                = Permintaanbarang::find($request->permintaanbarang_id);
        }
        else
        {
            $barangkeluar_detail_prices = BarangkeluarDetailPrice::latest()->take(1000)->get();
        }

        return view('barang_keluar_detail_prices.index', compact('request', 'barangkeluars', 'barangkeluar_details', 'barangkeluar_detail_prices', 'permintaan'));
    }
    
    public function add(Request $request)
    {   
        $inventories                    = Inventory::get();
        $barangkeluars                  = Barangkeluar::find($request->barangkeluar_id);
        $barangkeluar_details           = BarangkeluarDetail::where('barangkeluar_id', '=', $request->barangkeluar_id)->take(1000)->get();
        $permintaans                    = Permintaanbarang::find($request->permintaanbarang_id);

        return view('barang_keluar_detail_prices.add_form', compact('request', 'inventories', 'barangkeluars', 'barangkeluar_details', 'permintaans'));
    }
    
    public function addPost(Request $request)
    {
        foreach ($request->inventory_id as $key => $each) 
        {
            $barangkeluar_detail_prices                              = new \App\BarangkeluarDetailPrice;
            $barangkeluar_detail_prices->barangkeluar_detail_id      = $request->barangkeluar_detail_id;
            $barangkeluar_detail_prices->inventory_id                = $request->input('inventory_id.'.$key.'.value');
            $barangkeluar_detail_prices->quantity                    = $request->input('quantity.'.$key.'.value');
            $barangkeluar_detail_prices->price                       = $request->input('price.'.$key.'.value');
            $barangkeluar_detail_prices->ppn                         = $request->input('ppn.'.$key.'.value');
            $barangkeluar_detail_prices->save();
        }
    }

    public function edit(Request $request)
    {
        $barangkeluar_detail_prices     = BarangkeluarDetailPrice::find($request->id);
        $inventories                    = Inventory::get();
        $barangkeluars                  = Barangkeluar::find($request->barangkeluar_id);
        $barangkeluar_details           = BarangkeluarDetail::find($request->id);
        $permintaans                    = Permintaanbarang::find($request->permintaanbarang_id);

        return view('barang_keluar_detail_prices.edit_form', compact('request', 'barangkeluar_detail_prices', 'inventories', 'barangkeluars', 'barangkeluar_details', 'permintaans'));
    }

    public function update(Request $request)
    {
        $barangkeluar_detail_prices                              = BarangkeluarDetailPrice::find($request->id);
       // $barangkeluar_detail_prices->barangkeluardetail_id      = $request->barangkeluar_detail_id;
        $barangkeluar_detail_prices->inventory_id                = $request->inventory_id;
        $barangkeluar_detail_prices->quantity                    = $request->quantity;
        $barangkeluar_detail_prices->price                       = $request->price;
        $barangkeluar_detail_prices->ppn                         = $request->ppn;
        $status                                                  = $barangkeluar_detail_prices->save();

        if($status)
        {
            return redirect($to = '/barang_keluar_detail_prices/index?id='.$barangkeluar_detail_prices->barangkeluar_detail_id.'&permintaanbarang_id='.$barangkeluar_detail_prices->barangkeluar_detail->barangkeluar->permintaanbarang_id.
                '&barangkeluar_id='.$barangkeluar_detail_prices->barangkeluar_detail->barangkeluar_id, $status = 302, $headers = [], $secure = null);
        }
        else
        {
            return 'Failed';
        }
    }

    public function delete(Request $request)
    {
        $barangkeluar_detail_prices                             = \App\BarangkeluarDetailPrice::find($request->id);
        $status                                                 = $barangkeluar_detail_prices->delete();

        if ($status) 
        {
            return $barangkeluar_detail_prices;
        }else{
            return 'Failed';
        }
    }
}

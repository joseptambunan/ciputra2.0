<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\AssetDetail;
use App\AssetDetailItem;
use App\Permintaanbarang;
use App\Barangkeluar;
use App\BarangkeluarDetail;
use App\BarangkeluarDetailPrice;

class AssetDetailItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->id <> null && $request->permintaanbarang_id <> null && $request->barangkeluar_id <> null && $request->asset_id <> null)
        {
            $barangkeluars              = Barangkeluar::find($request->barangkeluar_id);
            $permintaans                = Permintaanbarang::find($request->permintaanbarang_id);
            $assets                     = Asset::find($request->asset_id);
            $asset_details              = AssetDetail::find($request->id);

            $asset_detail_items         = AssetDetailItem::where('asset_detail_id', '=', $request->id)->latest()->take(1000)->get();
        }
        else
        {
            $asset_detail_items         = AssetDetailItem::latest()->take(1000)->get();
        }

        return view('asset_detail_item.index', compact('request', 'barangkeluars', 'permintaans', 'assets', 'asset_details', 'asset_detail_items'));
    }
    
    public function add(Request $request)
    {   
        $barangkeluars                  = Barangkeluar::find($request->barangkeluar_id);
        $permintaans                    = Permintaanbarang::find($request->permintaanbarang_id);
        $assets                         = Asset::find($request->asset_id);

        $asset_details                  = AssetDetail::where('asset_id', '=', $request->asset_id)->take(1000)->get();

        return view('asset_detail_item.add_form', compact('request', 'barangkeluars', 'permintaans', 'assets', 'asset_details', 'item'));
    }
    
    public function addPost(Request $request)
    {
        foreach ($request->item_id as $key => $each) 
        {
            $asset_detail_items                                        = new \App\AssetDetailItem;
            $asset_detail_items->asset_detail_id                       = $request->asset_detail_id;
            $asset_detail_items->barangkeluar_detail_price_id          = $request->input('barangkeluar_detail_price_id.'.$key.'.value');
            $asset_detail_items->item_id                               = $request->input('item_id.'.$key.'.value');
            $asset_detail_items->barcode                               = bcrypt($request->input('barcode.'.$key.'.value'));
            $asset_detail_items->status                                = $request->input('status.'.$key.'.value');
            $asset_detail_items->save();
        }
    }

    public function edit(Request $request)
    {
        $assets                             = Asset::find($request->asset_id);
        $asset_details                      = AssetDetail::find($request->asset_detail_id);
        $asset_detail_items                 = AssetDetailItem::find($request->id);
        $barangkeluars                      = Barangkeluar::find($request->barangkeluar_id);
        $permintaans                        = Permintaanbarang::find($request->permintaanbarang_id);
        
        $barangkeluar_details               = BarangkeluarDetail::where('barangkeluar_id', '=', $request->barangkeluar_id)->get();

        $barangkeluar_detail_price          = BarangkeluarDetailPrice::get();

        return view('asset_detail_item.edit_form', compact('assets', 'asset_details', 'barangkeluars', 'permintaans', 'barangkeluar_details', 'asset_detail_items', 'barangkeluar_detail_price'));
    }

    public function update(Request $request)
    {
        $asset_detail_items                 = AssetDetailItem::find($request->id);
        $asset_detail_items->barcode        = bcrypt($request->barcode);
        $asset_detail_items->status         = $request->status;
        $status                             = $asset_detail_items->save();

        if($status)
        {
            return $asset_detail_items;
        }
        else
        {
            return 'Failed';
        }
    }

    public function delete(Request $request)
    {
        $asset_details                              = \App\AssetDetail::find($request->id);
        $status                                     = $asset_details->delete();

        if ($status) 
        {
            return $asset_details;
        }else{
            return 'Failed';
        }
    }
}

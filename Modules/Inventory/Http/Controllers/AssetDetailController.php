<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Asset;
use App\AssetDetail;
use App\AssetDetailItem;
use App\Permintaanbarang;
use App\Barangkeluar;
use App\BarangkeluarDetail;

class AssetDetailController extends Controller
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
            $permintaans                = Permintaanbarang::find($request->permintaanbarang_id);
            $assets                     = Asset::find($request->id);

            $asset_details              = AssetDetail::where('asset_id', '=', $request->id)->latest()->take(1000)->get();
        }
        else
        {
            $asset_details              = AssetDetail::latest()->take(1000)->get();
        }

        return view('asset_detail.index', compact('request', 'barangkeluars', 'permintaans', 'assets', 'asset_details'));
    }
    
    public function add(Request $request)
    {   
        $barangkeluars                 = Barangkeluar::find($request->barangkeluar_id);
        $permintaan                    = Permintaanbarang::find($request->permintaanbarang_id);
        $barangkeluar_details          = BarangkeluarDetail::where('barangkeluar_id', '=', $request->barangkeluar_id)->get();
        $asset                         = Asset::find($request->id);

        return view('asset_detail.add_form', compact('request', 'barangkeluars', 'permintaan', 'barangkeluar_details', 'asset'));
    }

    public function itemModal(Request $request)
    {   
        $barangkeluars                  = Barangkeluar::find($request->barangkeluar_id);
        $permintaans                    = Permintaanbarang::find($request->permintaanbarang_id);
        $barangkeluar_details           = BarangkeluarDetail::where('barangkeluar_id', '=', $request->barangkeluar_id)->get();
        $assets                         = Asset::find($request->asset_id);

        return view('asset_detail.add_form', compact('request', 'barangkeluars', 'permintaans', 'barangkeluar_details', 'assets'));
    }
    
    public function addPost(Request $request)
    {
        $asset_id            = $request->asset_id;
        $permintaanbarang_id = $request->permintaanbarang_id;
        $barangkeluar_id     = $request->barangkeluar_id;
        foreach ($request->description as $key => $each) 
        {
            $barangkeluar_detail_id = $request->input('barangkeluar_detail_id.'.$key.'.value');
            $BarangkeluarDetail = BarangkeluarDetail::find($barangkeluar_detail_id);
            $item_id = $BarangkeluarDetail->item_id;
            $description = $request->input('description.'.$key.'.value');
            //insert 
            $AssetDetail = AssetDetail::create([
                'asset_id' => $asset_id,
                'barangkeluar_detail_id' => $barangkeluar_detail_id,
                'item_id' => $item_id,
                'description' => $description

            ]);

            $AssetDetailItem = AssetDetailItem::create([
                'asset_detail_id' => $AssetDetail->id,
                'barangkeluar_detail_price_id' =>$BarangkeluarDetail->prices[0]->id,
                'item_id' => $item_id
            ]);
        }
        if($AssetDetailItem)
        {
            return redirect($to = '/asset_detail/index?id='.$asset_id.'&barangkeluar_id='.$barangkeluar_id.'&permintaanbarang_id='.$permintaanbarang_id, $status = 302, $headers = [], $secure = null); 
        }
        else
        {
            return "failed";
        }
    }

    public function edit(Request $request)
    {
        $assets                             = Asset::find($request->asset_id);
        $asset_details                      = AssetDetail::find($request->id);
        $barangkeluars                      = Barangkeluar::find($request->barangkeluar_id);
        $permintaans                        = Permintaanbarang::find($request->permintaanbarang_id);
        
        $barangkeluar_details               = BarangkeluarDetail::where('barangkeluar_id', '=', $request->barangkeluar_id)->get();

        return view('asset_detail.edit_form', compact('assets', 'asset_details', 'barangkeluars', 'permintaans', 'barangkeluar_details'));
    }

    public function update(Request $request)
    {
        $asset_details                                      = AssetDetail::find($request->id);
        $status                                             = $asset_details->save();

        if($status)
        {
            return $asset_details;
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

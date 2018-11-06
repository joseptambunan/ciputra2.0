<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\InventarisirDetail;
use Modules\Inventory\Entities\Asset;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\MutasiOut;
use Modules\Inventory\Entities\AssetDetail;
use Modules\Inventory\Entities\AssetTransaction;
use Modules\Department\Entities\Department;
use Modules\Project\Entities\Project;
use Modules\Globalsetting\Entities\Globalsetting;
use PDF;
use Auth;
use datatables;
use DB;

class AssetController extends Controller
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
        $project = Project::find($request->session()->get('project_id'));
        $inventarisir_id = $request->id;
        $assets = Asset::where('inventarisir_detail_id', '=', $inventarisir_id)->get();

        if(count($assets) <= 0)
        {
            $getInventarisirDetail =InventarisirDetail::find($inventarisir_id);

            if($getInventarisirDetail != null)
            {
                for($count = 0; $count < $getInventarisirDetail->quantity; $count++)
                {

                    $createAsset = Asset::create(
                        [
                            'inventarisir_detail_id'=>$inventarisir_id,
                            'sumber_id'=>$inventarisir_id,
                            'sumber_type'=>'App\InventarisirDetail',
                            'item_id'=>$getInventarisirDetail->item_id,
                            'item_satuan_id'=>$getInventarisirDetail->item_satuan_id,
                            'quantity'=>1,
                            'price'=>0,
                            'nilai_ekonomis'=>0,
                            'asset_age'=>date('Y-m-d',strtotime('+5 years',strtotime(now()))),
                            'ppn'=>Globalsetting::where('parameter','ppn')->first()->value/100,
                            'description'=>$getInventarisirDetail->item->name,
                            'is_labeled'=>0
                        ]
                    );

                    if($createAsset)
                    {
                        $createAssetTransaction = AssetTransaction::create([
                            'asset_id'=>$createAsset->id,
                            'from_user_id'=>$getInventarisirDetail->inventarisir->id_pic_giver,
                            'to_department_id'=>$getInventarisirDetail->inventarisir->barangkeluar->permintaanbarang->department_id,
                            'received_at'=>$getInventarisirDetail->inventarisir->date
                        ]);

                        if($createAssetTransaction)
                        {
                            $assets = Asset::where('inventarisir_detail_id', '=', $inventarisir_id)->get();
                        }
                    }
                }

            }
            
        }

        return view('inventory::asset.index',compact('assets','inventarisir_id','project','user'));
    }

    public function getAssets(Request $request)
    {
        $inventarisir_id = $request->id;
        $assets = Asset::where('inventarisir_detail_id', '=', $inventarisir_id)->get();
        $results = [];

        foreach ($assets as $key => $value) {
            # code...
            $totalprice = $value->price+($value->price*$value->ppn);
            $nilai_perkiraan_sisa = $value->nilai_ekonomis;
            $batas_umur =  strtotime($value->asset_age) - strtotime($value->created_at);
            $batas_umur_asset = floor($batas_umur/(60*60*24*365));
            if($nilai_perkiraan_sisa == 0)
            {
                 $nilai_perkiraan_sisa = $value->price/($batas_umur_asset+3);
            }

            $arr = array(
                'id'=>$value->id,
                'no'=>$key+1,
                'to_user'=>is_null($value->asset_transactions[0]->user_to) ? 'Kosong' : $value->asset_transactions[0]->user_to->user_name,
                'to_room'=>is_null($value->asset_transactions[0]->room_to) ? 'Kosong' : $value->asset_transactions[0]->room_to->name,
                'satuan_name'=>$value->satuan->name,
                'price'=>number_format($value->price,2,".",","),
                'ppn'=>number_format($value->ppn*100,2,".",","),
                'nilai_ekonomis'=>number_format($nilai_perkiraan_sisa,2,".",","),
                'asset_age'=>$value->asset_age,
                'ppn_value'=>number_format($value->price*($value->ppn),2,".",","),
                'total_price'=>number_format($totalprice,2,".",","),
                'umur'=> $batas_umur_asset,
                'description'=>$value->description
            );

            array_push($results,$arr);
        }

        return datatables()->of($results)->toJson();
    }

    public function generateBarcode()
    {
        $barcode = uniqid(rand());
        $isBarcodeExist = AssetDetail::where('barcode','=',$barcode)->get();
        $counterBarCodeExist = count($isBarcodeExist);
        while($counterBarCodeExist > 0)
        {
            $barcode = uniqid(rand());
            $isBarcodeExist = Asset::where('barcode','=',$barcode)->get();
            $counterBarCodeExist = count($isBarcodeExist);
        }

        return $barcode;
    }

    public function printQrCode(Request $request)
    {
        $inventarisir_id = $request->inventarisir_detail_id;

        //$checkIslabeled = Asset::where([['inventarisir_detail_id','=',$inventarisir_id],['is_labeled','=',1]])->get();
        /*

        if(count($AssetsDetails) == 0)
        {
            
            foreach ($Assets as $key => $value) {
                # code...
                $barcodeGet = $this->generateBarcode();
                
            $AssetsDetails = AssetDetail::where([['inventarisir_detail_id','=',$inventarisir_id],['inactive_at','=',null]])->get();
        }
        else
        {
            $AssetsDetails = AssetDetail::where([['inventarisir_detail_id','=',$inventarisir_id],['inactive_at','=',null]])->get();
        }*/
        
        $Assets = Asset::where('inventarisir_detail_id',$inventarisir_id)->get();
        foreach($Assets as $key => $value)
        {
            $checkAsset_id = AssetDetail::where('asset_id',$value->id)->first();
            if($checkAsset_id == null)
            {
                $barcodeGet = $this->generateBarcode();
                $createAssetDetail = AssetDetail::create([
                    'asset_id'=>$value->id
                    ,'inventarisir_detail_id'=>$inventarisir_id
                    ,'reuse'=>0,
                    'barcode'=>$barcodeGet]);
            
            }

        }

        $AssetsDetails = AssetDetail::where([['inventarisir_detail_id','=',$inventarisir_id],['inactive_at','=',null]])->get();

        $BarcodeInformations = array();
        foreach ($AssetsDetails as $key => $value) {
            # code...
            $arr = array(
                'id'=>$value->id,
                'asset_id'=>$value->asset_id,
                'inventarisir_detail_id'=>$value->inventarisir_detail_id,
                'department_id'=>$value->asset->inventarisirDetail->inventarisir->barangkeluar->permintaanbarang->department_id,
                'project_id'=>$value->asset->inventarisirDetail->inventarisir->barangkeluar->permintaanbarang->project_id,
                'department_name'=>$value->asset->inventarisirDetail->inventarisir->barangkeluar->permintaanbarang->department->name,
                'id_item'=>$value->asset->item_id,
                'nama_item'=>$value->asset->item->name,
                'item_satuan_id'=>$value->asset->item_satuan_id,
                'satuan_name'=>$value->asset->satuan->name,
                'price'=>$value->asset->price,
                'ppn'=>$value->asset->ppn,
                'barcode'=>$value->barcode,
                'description'=>$value->asset->description,
                'created_at'=>date('d-m-Y',strtotime($value->created_at)),
            );
            /*$arr = array($value->id,$value->asset_id,$value->inventarisir_detail_id,$value->asset->inventarisirDetail->inventarisir->barangkeluar->permintaanbarang->department_id,$value->asset->inventarisirDetail->inventarisir->barangkeluar->permintaanbarang->project_id,$value->asset->inventarisirDetail->inventarisir->barangkeluar->permintaanbarang->department->name,$value->asset->item_id,$value->asset->item->name,$value->asset->item_satuan_id,$value->asset->satuan->name,$value->asset->price,$value->asset->ppn,$value->barcode,$value->asset->description,date('d-m-Y',strtotime($value->created_at)),
            );*/
            array_push($BarcodeInformations,$arr);
        }

        $informations = json_encode($BarcodeInformations);
        $pdf = PDF::loadView('inventory::asset.print_qr_code',compact('informations'))->setPaper('a4','potrait');
        return $pdf->stream('print_qrcode.pdf');
        //return view('asset.print_qr_code',compact('informations'));
    }

    public function update(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        
        if($name == 'to_user_id' || $name == 'to_room_id' || $name == 'to_department_id')
        {
            $updated = AssetTransaction::where('asset_id',$pk)->first()->update([$name=>$value]);
            if($updated)
            {
                $stat = 1;
            }
        }
        else
        {
            if($name == 'ppn')
            {
                $value= $value/100;
            }

            if($name == 'asset_age')
            {
                $getCreated_at = Asset::find($pk)->created_at;
                $adding = '+'.$value.' year';
                //$date_awal = date('Y-m-d',strtotime($getCreated_at));
                $value = date('Y-m-d',strtotime($adding,strtotime($getCreated_at)));
            }

            $updated = Asset::find($pk)->update([$name=>$value]);
            if($updated)
            {
                $stat = 1;
            }
        }
        
        return response()->json(['return'=>$stat]);
    }

    public function checkLabled(Request $request)
    {
        $stat = false;
        $msg = '';
        $newasset_id = $request->new_asset_id;
        $newinventarisir_detail_id = $request->new_inventarisir_detail_id;

        $old_inventarisir_detail_id = $request->old_inventarisir_detail_id;
        $old_asset_id = $request->old_asset_id;
        $barcode = $request->barcode;

        $checkMuO = MutasiOut::where([['asset_id','=',$old_asset_id],['barcode','=',$barcode]])->first();

        if($checkMuO != null)
        {

            if($newinventarisir_detail_id != $old_inventarisir_detail_id)
            {
                $check = AssetDetail::where([['asset_id','=',$old_asset_id],['barcode','=',$barcode],['inventarisir_detail_id','=',$old_inventarisir_detail_id],['reuse','=',0]]);
                $inactive = $check->update(['inactive_at'=>now(),'inactive_by'=>Auth::user()->id]);
                $check = $check->first();
                if($check != null)
                {
                    $createNew = AssetDetail::create([
                        'asset_id'=>$newasset_id,
                        'inventarisir_detail_id'=>$newinventarisir_detail_id,
                        'reuse'=>true,
                        'reuse_id'=>$check->id,
                        'barcode'=>$barcode
                    ]);
                    if($createNew)
                    {
                        $stat = true;
                    }
                }
            }
            else
            {
                $msg = 'Data Salah !';
            }
            
        }
        else
        {
            $msg = 'Data Salah!';
        }

        return response()->json(['stat'=>$stat,'msg'=>$msg]);
    }

    public function getListAssets(Request $request)
    {
        $results = [];
        $assets = Asset::select('item_id','item_satuan_id',DB::raw('sum(quantity) as total'))
        ->groupBy('item_id','item_satuan_id')->get();
        foreach ($assets as $key => $value) {
            # code...
            $arr = array(
                'item_id'=>$value->item_id,
                'item_name'=>$value->item->name,
                'satuan'=>$value->satuan->name,
                'total'=>$value->total,
                'category'=>$value->item->category->name
            );

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();
    }

    public function daftarAsset()
    {
        $projectname = Project::find(session('project'))->name;
        return view('asset.daftar_asset',compact('projectname'));
    }

    public function details($item_id)
    {
        $projectname = Project::find(session('project'))->name;
        $item_name = Item::find($item_id)->name;
        $total = Asset::where('item_id',$item_id)->sum('quantity');

        return view('asset.details',compact('projectname','item_id','item_name','total'));
    }

    public function detailTransaction($asset_id)
    {
        $projectname = Project::find(session('project'))->name;
        $item_name = Asset::find($asset_id)->item->name;
        $item_id = Asset::find($asset_id)->item_id;
        return view('asset.details_transaction',compact('item_id','projectname','item_name','asset_id'));
    }

    public function getAssetTransactionRotasi($asset_id)
    {
        $transactions = AssetTransaction::where('asset_id',$asset_id)->get();
        $results = [];
        foreach ($transactions as $key => $value) {
            # code...
            $arr = array(
                'pemberi'=>is_null($value->user_from) ? '-' : $value->user_from->user_name,
                'penerima'=>$value->user_to->user_name,
                'from_departement'=>is_null($value->department_from) ? '-' : $value->department_from->name,
                'from_room'=>is_null($value->room_from) ? '-' : $value->room_from->name,
                'to_department'=>$value->department_to->name,
                'to_room'=>is_null($value->room_to) ? '-' : $value->room_to->name,
                'date'=>date('d-m-Y',strtotime($value->created_at))
            );
            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();
    }

    public function getAssetPerItem($item_id)
    {
        $getAssetPerItems = Asset::where('item_id',$item_id)->get();
        $results = [];
        foreach ($getAssetPerItems as $key => $value) {
            # code...
            $department = is_null(AssetTransaction::where('asset_id',$value->id)->orderBy('created_at','desc')->first()->department_to) ? '-' : AssetTransaction::where('asset_id',$value->id)->orderBy('created_at','desc')->first()->department_to->name;
            $transaksi = AssetTransaction::where('asset_id',$value->id)->orderBy('created_at','desc')->first();
            $location = is_null($transaksi->room_to) ? '-' : $transaksi->room_to->name;
            $ppn_value = $value->price*$value->ppn;
            $umur =  time() - strtotime($value->created_at);//date('n')-date('n',strtotime($value->created_at));
            //$umur == 0 ? $umur=1 : $umur;
            $selisihumur = floor($umur/(60*60*24));
            if($selisihumur == 0)
            {
                $selisihumur = 1;
            }
            $penyusutan = ($ppn_value+$value->price)/$selisihumur;
            $arr = array(
                'id'=>$value->id,
                'price'=>number_format($value->price,2,".",","),
                'ppn'=>$value->ppn*100,
                'ppn_value'=>number_format($ppn_value,2,".",","),
                'total_price'=>number_format($ppn_value+$value->price,2,".",","),
                'penyusutan'=>number_format(($ppn_value+$value->price) - $penyusutan,2,".",","),
                'satuan'=>$value->satuan->name,
                'asset_age'=>$value->asset_age,
                'departemen'=>$department,
                'location'=>$location
            );

            array_push($results,$arr);
        }

        return datatables()->of($results)->toJson();

    }

    public function print()
    {
        $projectname = Project::find(session('project'))->name;
        return view('laporan.index_laporan_asset',compact('projectname'));
    }

    public function printReport()
    {
        $projectname = Project::find(session('project'))->name;
        $Assets = Asset::select('item_id','item_satuan_id','asset_age','price','ppn','description','created_at')->orderBy('item_id')->get();
        $pdf = PDF::loadView('laporan.cetak_laporan_asset',compact('Assets','projectname'))->setPaper('a4','landscape');
        return $pdf->stream('laporan_penyusutan_aktiva_tetap.pdf');
        //return view('laporan.cetak_laporan_asset',compact('Assets','projectname'));
    }

    public function getPenyusutanAsset()
    {
        $result = [];
        $projectname = Project::find(session('project'))->name;
        $Assets = Asset::select('item_id','item_satuan_id','asset_age','price','ppn','description','created_at')->orderBy('item_id')->get();
        foreach ($Assets as $key => $value) {
            # code...
            $batas_umur =  strtotime($value->asset_age) - strtotime($value->created_at);
            
            $batas_umur_asset = floor($batas_umur/(60*60*24*365));

            $nilai_perkiraan_sisa = $value->nilai_ekonomis;

            $umur_asset = date('n')-date('n',strtotime($value->created_at)) +1;

            $nilai_penyusutan = floor($umur_asset/12*(($value->price-$nilai_perkiraan_sisa)/$batas_umur_asset));
            /*$nilai_penyusutanPerBulan = $nilai_penyusutan/12;
            $nilai_penyusutan_final = (12-date('n',strtotime($value->created_at))+1)*$nilai_penyusutanPerBulan;*/

            $arr = array(
                'item_name'=>$value->item->name,
                'satuan'=>$value->satuan->name,
                'umur_asset'=>$batas_umur_asset,
                'nilai_perolehan'=>$value->price,
                'nilai_penyusutan'=>$nilai_penyusutan,
                'tangal_perolehan'=>date('d-m-Y',strtotime($value->created_at)),
                'keterangan'=>$value->description,
                'nilai_perkiraan_sisa'=>$value->nilai_ekonomis,
                'nilai_buku'=>$value->price-$nilai_penyusutan
            );

            array_push($result, $arr);
            
        }

        return datatables()->of($result)->toJson();
    }

    public function posisiAsset()
    {
        $projectname = Project::find(session('project'))->name;
        return view('laporan.index_laporan_posisi_asset',compact('projectname'));
    }

    public function getPosisiAsset()
    {
       // $getAssetst = AssetTransaction::select('*')->orderBy('created_at','desc')->get();
        $getAssets = Asset::all();
        $result = [];

        foreach ($getAssets as $key => $value) {
            # code...
            $batas_umur =  strtotime($value->asset_age) - strtotime($value->created_at);
            
            $batas_umur_asset = floor($batas_umur/(60*60*24*365));
            $AssetTransaction = AssetTransaction::where('asset_id',$value->id)->orderBy('created_at','desc')->first();
            $department = is_null($AssetTransaction->department_to) ? '-':$AssetTransaction->department_to->name;
            $arr = array(
                'item_name' => $value->item->name,
                'department'=>$department,
                'description'=>$value->description,
                'umur_ekonomis'=>$batas_umur_asset,
                'barcode'=>$value->detail['barcode']
            );

            array_push($result, $arr);
        }

        return datatables()->of($result)->toJson();
    }

    public function laporanPosisiAsset()
    {
        $getAssets = Asset::all();
        $projectname = Project::find(session('project'))->name;
        $result = [];

        foreach ($getAssets as $key => $value) {
            # code...
            $batas_umur =  strtotime($value->asset_age) - strtotime($value->created_at);
            
            $batas_umur_asset = floor($batas_umur/(60*60*24*365));
            $AssetTransaction = AssetTransaction::where('asset_id',$value->id)->orderBy('created_at','desc')->first();
            $department = is_null($AssetTransaction->department_to) ? '-':$AssetTransaction->department_to->name;
            $arr = array(
                'department'=>$department,
                'item_name' => $value->item->name,
                'description'=>$value->description,
                'umur_ekonomis'=>$batas_umur_asset,
                'barcode'=>$value->detail['barcode']
            );

            array_push($result, $arr);
        }
        $pdf = PDF::loadView('laporan.cetak_laporan_posisi_asset',compact('result','projectname'))->setPaper('a4','potrait');
        return $pdf->stream('laporan_posisi_asset.pdf');
        //return view('laporan.cetak_laporan_posisi_asset',compact('result','projectname'));
    }

}

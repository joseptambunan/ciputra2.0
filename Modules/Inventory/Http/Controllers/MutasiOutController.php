<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Asset;
use Modules\Department\Entities\Department;
use Modules\Inventory\Entities\Location;
use Modules\Inventory\Entities\User;
use Modules\Inventory\Entities\UnitSub;
use Modules\Inventory\Entities\MutasiOut;
use Modules\Inventory\Entities\Warehouse;
use Modules\Inventory\Entities\Inventory;
use Modules\Inventory\Entities\ItemSatuan;

use Modules\Project\Entities\Project;

use DB;
use datatables;

class MutasiOutController extends Controller
{
    public function index(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
    	return view('inventory::mutasi_out.index',compact('project'));
    }

    /*public function add(Request $request)
    {
        $asset_id = $request->id;
        $getLatestAssetTransaction = AssetTransaction::where([['asset_id','=',$asset_id],['status','=',0]])->orderBy('id','desc')->first();
        $Asset = Asset::find($asset_id);
        $Users = User::all();
        $Locations = Location::all();
        $Departments = Department::all();
        $UnitsSub = UnitSub::all();

        return view('mutasi_out.add_form',compact('asset_id','Users','Locations','Departments','UnitsSub','Asset','getLatestAssetTransaction'));
    }*/

    public function add(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $warehouses = Warehouse::select('id','name')->get();
        return view('inventory::mutasi_out.add_form',compact('warehouses','project'));
    }

    /*public function addPost(Request $request)
    {
        $status =1;
        $asset_id = $request->asset_id;
        $from_user_id = $request->from_user_id;
        $from_department_id = $request->from_department_id;
        $from_unit_sub_id = $request->from_unit_sub_id;
        $from_location_id = $request->from_location_id;
        $to_user_id = $request->to_user_id;
        $to_department_id = $request->to_department_id;
        $to_unit_sub_id = $request->to_unit_sub_id;
        $to_location_id = $request->to_location_id;
        $description = $request->description;
        //transaction details
        $imgpath = $request->file('image');
        $img_data = file_get_contents($imgpath);
        $img_base64 = base64_encode($img_data);

        $actionAssetTransaction = AssetTransaction::create(
                [
                    'asset_id' => $asset_id,
                    'from_user_id' => \Auth::user()->id,
                    'from_department_id' => $from_department_id,
                    'from_unit_sub_id' => $from_unit_sub_id,
                    'from_location_id' => $from_location_id,
                    'to_user_id' => $to_user_id,
                    'to_department_id' => $to_department_id,
                    'to_unit_sub_id' => $to_unit_sub_id,
                    'to_location_id' => $to_location_id,
                    'status' => $status,
                    'description' => $description
                ]
            );
        if($actionAssetTransaction)
        {
            $actionAssetTransactionImage = AssetTransactionImage::create(
                [
                    'asset_transaction_id'=>$actionAssetTransaction->id,
                    'path' => $imgpath,
                    'image_data' => $img_base64
                ]
            );

            if($actionAssetTransactionImage)
            {
                return redirect($to = '/mutasi_out/index', $status = 302, $headers = [], $secure = null);
            }
        }

    }*/

    public function addPost(Request $request)
    {
        $stat = false;
        $id_pic_giver = $request->id_pic_giver;
        $pic_giver = $request->giver;

        $id_pic_recipient = $request->id_pic_recipient;
        $pic_recipient = $request->recipient;
       
        $source = session('project');

        $id_destination = $request->id_destination;
        $destination = $request->destination;

        $id_destination_warehouse = $request->id_destination_warehouse;
        $description = $request->description;
        $is_inventory = $request->is_inventory;
        $allItemStore = json_decode($request->allItemStore);

        if(count($allItemStore) > 0)
        {
            for($i =0;$i < count($allItemStore);$i++)
            {
                $idItem = $allItemStore[$i]->kode_produk;
                $item_satuan_id =  ItemSatuan::select('id')->where(function($q) use ($idItem)
                    {
                        $q->where(
                            [
                                ['konversi','=',ItemSatuan::where('item_id',$idItem)->min('konversi')],
                                ['item_id','=',$idItem]
                            ]
                        );
                    })->first();

                $actionmutasi = MutasiOut::create([
                        'id_pic_recipient'=>$id_pic_recipient,
                        'pic_recipient'=>$pic_recipient,
                        'id_pic_giver'=>$id_pic_giver,
                        'name_pic_giver'=>$pic_giver,
                        'item_id'=>$allItemStore[$i]->kode_produk,
                        'item_satuan_id'=>$item_satuan_id->id,
                        'asset_id'=>$allItemStore[$i]->id,
                        'barcode'=>$allItemStore[$i]->kode_barang,
                        'source'=>$source,
                        'id_destination'=>is_null($id_destination) ? $id_destination_warehouse : $id_destination,
                        'destination'=>$destination,
                        'image1'=>(count($allItemStore[$i]->image) == 0) ? null : $allItemStore[$i]->image[0],
                        'image2'=>(count($allItemStore[$i]->image) == 0) ? null : $allItemStore[$i]->image[1],
                        'image3'=>(count($allItemStore[$i]->image) == 0) ? null : $allItemStore[$i]->image[2],
                        'confirm_by_warehouseman'=>0,
                        'is_inventory'=>$is_inventory,
                        'confirm_by_hod'=>0,
                        'description'=>$description
                    ]);
                if($actionmutasi)
                {
                    $stat = true;

                }
                /*if($is_inventory)
                {
                    
                }*/
            }
        }
        

        return response()->json(['stat'=>$stat]);
        
    }

    public function getItemAsset(Request $request)
    {
        $terms = $request->terms;
        $results = [];
        $getItemAssets = Asset::select('assets.id as asset_id','item_id','barcode','items.name')->join('items','assets.item_id','=','items.id')->where('items.name','like','%'.$terms.'%')->get();
        foreach ($getItemAssets as $key => $value) {
            # code...
            $arr = array(
                'asset_id'=>$value->asset_id,
                'item_id'=>$value->item_id,
                'barcode'=>$value->barcode,
                'item_name'=>$value->name
            );

            array_push($results, $arr);
        }
            /*# code...
            if(strcmp($value->name ,$temp) != 0)
            {
                array_push($results, $value->name);
            }*/

        return response()->json($getItemAssets);
    }

    public function addPost2(Request $request)
    {
        $stat = false;
        $dataExists = [];
        $action = '';
        $allItemStore = json_decode($request->allItemStore2);
        if(count($allItemStore) > 0)
        {
            for($i =0;$i < count($allItemStore);$i++)
            {
                $check = MutasiOut::where([
                    ['period_op_name_id','=',$period_op_name_id],
                    ['barcode','=',$allItemStore[$i]->kode_barang]
                ])->first();

                if($check == null)
                {
                    $action = OpNameAsset::create([
                                    'period_op_name_id'=>$period_op_name_id,
                                    'barcode'=>$allItemStore[$i]->kode_barang
                                    ,'item_id'=>$allItemStore[$i]->kode_produk
                                    ,'description'=>$allItemStore[$i]->remarks]);
                }
                else
                {
                    $isExists = array(
                        'item_name' => $allItemStore[$i]->nama_barang,
                        'barcode' => $allItemStore[$i]->kode_barang
                    );
                    array_push($dataExists, $isExists);
                }
                
            }
            if($action)
            {
                $stat = true;
            }
        }
    }

    public function detail(Request $request,$id)
    {
        $project = Project::find($request->session()->get('project_id'));
        $mutasi_out = MutasiOut::find($id);
        
        return view('inventory::mutasi_out.details',compact('mutasi_out','project'));
    }

    public function getSource(Request $request)
    {
        $term = $request->term;
        $source = MutasiOut::select('source')->where('source','like',$term.'%')->get();

        return response()->json($source);
    }

    public function getData()
    {
        $results = [];
        $getMutasiOuts = MutasiOut::all();
        foreach ($getMutasiOuts as $key => $value) {
            # code...
            $arr = array(
                'no'=>$key+1,
                'asset_id'=>$value->asset_id,
                'item_name'=>$value->item->name,
                'source'=>$value->source,
                'dest'=>is_null($value->warehouse) ? $value->destination : $value->warehouse->name,
                'id'=>$value->id,
                'barcode'=>$value->barcode,
                'date'=>date('d-m-Y',strtotime($value->created_at))
            );

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();

    }
}

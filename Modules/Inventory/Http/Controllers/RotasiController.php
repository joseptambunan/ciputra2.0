<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Asset;
use Modules\Inventory\Entities\AssetTransaction;
use Modules\Inventory\Entities\AssetTransactionImage;
use Modules\Department\Entities\Department;
use Modules\Location\Entities\Location;
use Modules\User\Entities\User;
use Modules\Inventory\Entities\UnitSub;
use Modules\Inventory\Entities\Rotasi;
use Modules\Project\Entities\Project;
use datatables;

class RotasiController extends Controller
{
    //
    public function index(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $AssetTransactions = AssetTransaction::where('status',2)->get();
        return view('inventory::rotasi.index',compact('AssetTransactions','project'));
    }

    public function add(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
    	$asset_id = $request->id;
        $getLatestAssetTransaction = AssetTransaction::where([['asset_id','=',$asset_id],['status','=',2]])->orderBy('id','desc')->first();
    	$Asset = Asset::find($asset_id);
    	$Users = User::all();
    	//$Locations = Location::all();
    	$Departments = Department::all();
    	

    	return view('inventory::rotasi.add_form',compact('asset_id','Users','Departments','Asset','getLatestAssetTransaction','project'));
    }


    public function addPost(Request $request)
    {
        $stat = false;
        $dataExists = [];
        $action = '';
        $pic_giver = $request->giver;
        $pic_recipient = $request->recipient;
        $from_department_id = $request->from_department_id;
        //$from_location_id = $request->from_location_id;
        $to_department_id = $request->to_department_id;
        $source = $request->from_room;
        $destination = $request->to_room;
        $id_source = $request->id_from_room;
        $id_destination = $request->id_to_room;
        $descriptions = $request->descriptions;
        $allItemStore = json_decode($request->allItemStore);
        if(count($allItemStore) > 0)
        {
            for($i =0;$i < count($allItemStore);$i++)
            {

                $action = AssetTransaction::create([
                        'asset_id'=>$allItemStore[$i]->id,
                        'from_user_id'=>$pic_giver,
                        'from_department_id'=>$from_department_id,
                        /*'from_unit_sub_id'=>null,
                        'from_location_id'=>null,*/
                        'from_room_id'=>$id_source,
                        'to_user_id'=>$pic_recipient,
                        'to_department_id'=>$to_department_id,
                        /*'to_unit_sub_id'=>null,
                        'to_location_id'=>null,*/
                        'to_room_id'=>$id_destination,
                        'status'=>null,
                        'description'=>$descriptions,
                        'received_at'=>date('Y-m-d')
                ]);
            }
            if($action)
            {
                $stat = true;
            }
        }


        return response()->json(['stat'=>$stat]);
    }

    public function getData()
    {
        $results = [];
        $rotations = Rotasi::all();
        foreach ($rotations as $key => $value) {
            # code...
            $arr = array(
                'no'=>$key+1,
                'asset_id'=>$value->asset_id,
                'item_name'=>$value->item->name,
                'source'=>$value->from_room,
                'dest'=>$value->to_room,
                'id'=>$value->id,
                'barcode'=>$value->barcode,
                'date'=>date('d-m-Y',strtotime($value->created_at))
            );

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();
    }

    public function details(Request $request,$id)
    {
        $project = Project::find($request->session()->get('project_id'));
        $rotasi = Rotasi::find($id);
        return view('inventory::rotasi.details',compact('rotasi','project'));
    }

    public function details2(Request $request,$id)
    {
        $project = Project::find($request->session()->get('project_id'));
        $rotasi = Rotasi::find($id);

        return view('inventory::rotasi.details2',compact('rotasi','project'));
    }

    public function getCurrentPosition(Request $request)
    {
        $results = [];
        $asset_id = $request->code;
        $getlocation = AssetTransaction::select('to_department_id','to_location_id','to_room_id')->where('asset_id',$asset_id)->orderBy('created_at','desc')->first();

        if($getlocation != null)
        {
            $results = array(
                'to_department_name'=>is_null($getlocation->department_to) ? '-' : $getlocation->department_to->name,
                'to_room_name'=>is_null($getlocation->room_to) ? '-' : $getlocation->room_to->name
            );
        }
        
        return response()->json($results);
    }
}

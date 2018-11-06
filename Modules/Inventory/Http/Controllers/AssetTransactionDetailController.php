<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Project\Entities\Project;
use Modules\Pt\Entities\Pt;
use Modules\Inventory\Entities\AssetTransaction;
use Modules\Inventory\Entities\AssetTransactionDetail;
use Modules\Inventory\Entities\AssetDetailItem;
use Modules\User\Entities\User;
use Modules\Department\Entities\Department;
use App\UnitSub;
use App\Location;

class AssetTransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->id <> null)
        {
            $asset_transactions                 = AssetTransaction::find($request->id);
            $asset_transaction_details          = AssetTransactionDetail::where('asset_transaction_id', '=', $request->id)->latest()->take(1000)->get();
        }
        else
        {
            $asset_transaction_details          = AssetTransactionDetail::latest()->take(1000)->get();
        }

        return view('asset_transaction_detail.index', compact('request', 'asset_transactions', 'asset_transaction_details'));
    }
    
    public function add(Request $request)
    {   
        $asset_transactions                     = AssetTransaction::find($request->id);
        $asset_detail_items                     = AssetDetailItem::get();
        $users                                  = User::get();    
        $departments                            = Department::get();
        $unit_subs                              = UnitSub::get();
        $locations                              = Location::get();

        return view('asset_transaction_detail.add_form', compact('request', 'asset_transactions', 'asset_detail_items', 'users', 'departments', 'unit_subs', 'locations'));
    }
    
    public function addPost(Request $request)
    {
        $asset_transaction_details                              = new \App\AssetTransactionDetail;
        $asset_transaction_details->asset_transaction_id        = $request->asset_transaction_id;
        $asset_transaction_details->asset_detail_item_id        = $request->asset_detail_item_id;
        $asset_transaction_details->from_user_id                = $request->from_user_id;
        $asset_transaction_details->from_department_id          = $request->from_department_id;
        $asset_transaction_details->from_unit_sub_id            = $request->from_unit_sub_id;
        $asset_transaction_details->from_location_id            = $request->from_location_id;
        $asset_transaction_details->to_user_id                  = $request->to_user_id;
        $asset_transaction_details->to_department_id            = $request->to_department_id;
        $asset_transaction_details->to_unit_sub_id              = $request->to_unit_sub_id;
        $asset_transaction_details->to_location_id              = $request->to_location_id;
        $asset_transaction_details->received_at                 = $request->received_at;
        $asset_transaction_details->status                      = $request->status;
        $asset_transaction_details->description                 = $request->description;
        $status                                                 = $asset_transaction_details->save();

        if($status)
        {
            return $asset_transaction_details;
        }
        else
        {
            return 'Failed';
        }   
    }

    public function edit(Request $request)
    {
        $asset_transactions                     = AssetTransaction::find($request->asset_transaction_id);
        $asset_transaction_details              = AssetTransactionDetail::find($request->id);
        $asset_detail_items                     = AssetDetailItem::get();
        $users                                  = User::get();    
        $departments                            = Department::get();
        $unit_subs                              = UnitSub::get();
        $locations                              = Location::get();

        return view('asset_transaction_detail.edit_form', compact('request', 'asset_transactions', 'asset_detail_items', 'asset_transaction_details', 'users', 'departments', 'unit_subs', 'locations'));
    }

    public function update(Request $request)
    {
        $asset_transaction_details                              = AssetTransactionDetail::find($request->id);
        $asset_transaction_details->asset_transaction_id        = $request->asset_transaction_id;
        $asset_transaction_details->asset_detail_item_id        = $request->asset_detail_item_id;
        $asset_transaction_details->from_user_id                = $request->from_user_id;
        $asset_transaction_details->from_department_id          = $request->from_department_id;
        $asset_transaction_details->from_unit_sub_id            = $request->from_unit_sub_id;
        $asset_transaction_details->from_location_id            = $request->from_location_id;
        $asset_transaction_details->to_user_id                  = $request->to_user_id;
        $asset_transaction_details->to_department_id            = $request->to_department_id;
        $asset_transaction_details->to_unit_sub_id              = $request->to_unit_sub_id;
        $asset_transaction_details->to_location_id              = $request->to_location_id;
        $asset_transaction_details->received_at                 = $request->received_at;
        $asset_transaction_details->status                      = $request->status;
        $asset_transaction_details->description                 = $request->description;
        $status                                                 = $asset_transaction_details->save();

        if($status)
        {
            return $asset_transaction_details;
        }
        else
        {
            return 'Failed';
        }   
    }

    public function delete(Request $request)
    {
        $asset_transaction_details                  = \App\AssetTransactionDetail::find($request->id);
        $status                                     = $asset_transaction_details->delete();

        if ($status) 
        {
            return $asset_transaction_details;
        }else{
            return 'Failed';
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Pt;
use App\AssetTransaction;

class AssetTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $asset_transactions                = AssetTransaction::latest()->take(1000)->get();

        return view('asset_transaction.index', compact('asset_transactions'));
    }
    
    public function add(Request $request)
    {   
        $projects                   = Project::get();
        $pts                        = Pt::get();

        return view('asset_transaction.add_form', compact('request', 'projects', 'pts'));
    }
    
    public function addPost(Request $request)
    {
        $asset_transactions                             = new \App\AssetTransaction;
        $asset_transactions->project_id                 = $request->project_id;
        $asset_transactions->pt_id                      = $request->pt_id;
        $asset_transactions->no                         = $request->no;
        $asset_transactions->date                       = $request->date;
        $asset_transactions->description                = $request->description;
        $status                                         = $asset_transactions->save();

        if($status)
        {
            return redirect($to = 'asset_transaction/index', $status = 302, $headers = [], $secure = null);
        }else{
            return 'Failed';
        }
    }

    public function edit(Request $request)
    {
        $asset_transactions                 = AssetTransaction::find($request->id);
        $projects                           = Project::get();
        $pts                                = Pt::get();

        return view('asset_transaction.edit_form', compact('asset_transactions', 'projects', 'pts'));
    }

    public function update(Request $request)
    {
        $asset_transactions                             = AssetTransaction::find($request->id);
        $asset_transactions->project_id                 = $request->project_id;
        $asset_transactions->pt_id                      = $request->pt_id;
        $asset_transactions->no                         = $request->no;
        $asset_transactions->date                       = $request->date;
        $asset_transactions->description                = $request->description;
        $status                                         = $asset_transactions->save();

        if($status)
        {
            return $asset_transactions;
        }
        else
        {
            return 'Failed';
        }
    }

    public function delete(Request $request)
    {
        $asset_transactions                 = \App\AssetTransaction::find($request->id);
        $status                             = $asset_transactions->delete();

        if ($status) 
        {
            return $asset_transactions;
        }else{
            return 'Failed';
        }
    }
}

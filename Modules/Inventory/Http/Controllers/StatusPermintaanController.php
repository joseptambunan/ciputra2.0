<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\StatusPermintaan;
use Modules\Project\Entities\Project;
use datatables;
use Auth;
class StatusPermintaanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $user = Auth::user();
        return view('inventory::status_permintaan.index',compact('project','user'));
    }

    public function update(Request $request)
    {

    }

    public function add(Request $request)
    {
    	
    }

    public function getData()
    {
        $status_permintaans = StatusPermintaan::all();
        return datatables()->of($status_permintaans)->toJson();
    }

    public function store(Request $request)
    {
        $stat = false;
        $name = $request->name;
        $id = $request->id;
        $check = StatusPermintaan::find($id);
        if($check != null)
        {
            $updated = $check->update(['name'=>$name]);
            if($updated)
            {
                $stat = true;
            }
        }
        else
        {
            $saved = StatusPermintaan::create(['name'=>$name]);

            if($saved)
            {
                $stat = true;
            }
        }
        
        return response()->json($stat);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $stat = false;
        $deleted = StatusPermintaan::find($id)->delete();

        if($deleted)
        {
            $stat = true;
        }

        return response()->json($stat);
    }
}

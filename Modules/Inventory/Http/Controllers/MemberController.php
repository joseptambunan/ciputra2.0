<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Member;
use Modules\User\Entities\User;
use Modules\Project\Entities\Project;
use Auth;
use datatables;

class MemberController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get("project_id"));
    	return view('inventory::member.index',compact('project','user'));

    }

    public function store(Request $request)
    {
        $execute = '';
        $stat = false;
        $check = Member::find($request->id);
        if($check == null)
        {
            $execute = Member::updateOrCreate([
                'member_name'=>$request->name,
                'description'=>$request->description
            ]);
        }
        else
        {
            $execute = $check->update(['member_name'=>$request->name,'description'=>$request->description]);
        }

        if($execute)
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function delete(Request $request)
    {

        $model = Member::find($request->id);
        $status = $model->delete();
        $stat = false;
        if ($status) 
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function getData()
    {
        $results = [];
        $members = Member::all();
        foreach ($members as $key => $value) {
            # code...
            $arr = array(
                'no'=>$key+1,
                'id'=>$value->id,
                'name'=>$value->member_name,
                'remarks'=>$value->description,
                'created_at'=>date('Y-m-d H:m:s',strtotime($value->created_at)),
                'updated_at'=>date('Y-m-d H:m:s',strtotime($value->updated_at))
            );

            array_push($results, $arr);
        }
        return datatables()->of($results)->toJson();

    }

}

<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Room;
use Modules\Project\Entities\Project;
use Modules\User\Entities\User;
use Modules\Project\Entities\ProjectPtUser;
use Auth;
use datatables;

class RoomController extends Controller
{
    //
    public function index(Request $request)
    {
        $project_id = $request->session()->get('project_id');
    	$project = Project::find($project_id);
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $pts         = ProjectPtUser::where([['user_id','=',$user_id],['project_id',$project_id]])->get();
    	return view('inventory::room.index',compact('project','pts','user'));
    }

    public function store(Request $request)
    {
        $stat = false;

        $cek = Room::find($request->id);
        if($cek == null)
        {
            $execute = Room::updateOrCreate([
                'project_id'=>$request->session()->get('project_id'),
                'pt_id'=>$request->pt_id,
                'name'=>$request->name
                ]);
        }
        else
        {
            $execute = $cek->update([
                'project_id'=>$request->session()->get('project_id'),
                'pt_id'=>$request->pt_id,
                'name'=>$request->name]);
        }
        

        if($execute)
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function getData()
    {
        $results = [];
        $rooms = Room::all();

        foreach ($rooms as $key => $value) {
            # code...
            $arr = array(
                'id'=>$value->id,
                'name'=>$value->name,
                'no'=>$key+1,
                'pt_id'=>$value->pt_id,
                'project_name'=>$value->project->name,
                'pt_name'=>$value->pt->name
            );

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();

    }

    public function delete(Request $request)
    {
        $stat = false;
        $delete = Room::find($request->id)->delete();

        if($delete)
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function typeRoom(Request $request)
    {
        //$results = [];
        $term = $request->get('q');
        $getRooms = Room::select('id','name')->where('name','like','%'.$term.'%')->get();

        return response()->json($getRooms);
    }
}

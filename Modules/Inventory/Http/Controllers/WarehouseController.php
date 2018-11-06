<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Warehouse;
use Modules\Country\Entities\City;
use Modules\Department\Entities\Department;
use Modules\User\Entities\UserWarehouse;
use Modules\User\Entities\User;
use Modules\Project\Entities\Project;
use Modules\Inventory\Http\Requests\RequestWarehouse;
use Auth;
class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $warehouses             = Warehouse::all();
        return view('inventory::warehouse.index', compact('warehouses','user','project'));
    }
    
    public function add(Request $request)
    {   
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $cities                 = City::get();
        $departments            = Department::all();
        return view('inventory::warehouse.add_form', compact('cities','departments','user','project'));
    }
    
    public function addPost(RequestWarehouse $request)
    {
        $response = false;
        $warehouses                                         = new Warehouse();
        $warehouses->address                                = $request->address;
        $warehouses->code                                   = $request->code;
        $warehouses->project_id                             = session('project');
        $warehouses->department_id                          = $request->department_id;
        $warehouses->head_id                                = '0';
        $warehouses->head_type                              = 'App\UserWarehouse';
        $warehouses->city_id                                = $request->city_id;
        $warehouses->name                                   = $request->name;
        //$warehouses->capacity_volume                        = $request->capacity_volume;
        $status                                             = $warehouses->save();

        if($status)
        {
            $response = true;
        }

        return response()->json($response);
    }

    public function edit(Request $request)
    {

        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $warehouse             = Warehouse::find($request->id);
        $cities                 = City::get();
        $departments            = Department::all();
        return view('inventory::warehouse.edit_form', compact('cities','departments','user','project'));
    }

    public function update(Request $request)
    {
        $stat =false;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = Warehouse::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json($stat);
        
    }

    public function picIndex(Request $request)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $users_warehouse = Warehouse::find($request->id);
        return view('inventory::pic_warehouse.index',compact('users_warehouse','user','project'));
    }

    public function picAdd(Request $request)
    {
        $users      = User::all();
        $warehouse_id = $request->id;
        return view('inventory::pic_warehouse.add_form',compact('users','warehouse_id'));
    }

    public function storePic(Request $request)
    {
        $stat = false;
        $userid = $request->id_pic;
        $warehouses = json_decode($request->id_warehouses);
        if(count($warehouses) > 0)
        {
            for($i = 0; $i < count($warehouses);$i++)
            {
                $exe = UserWarehouse::create([
                    'user_id'=>$userid,'warehouse_id'=>$warehouses[$i]
                ]);
            }

            if($exe)
            {
                $stat = true;
            }
        }

        return response()->json($stat);
    }
    public function picStore(Request $request)
    {
        $store = Warehouse::find($request->warehouse_id)->users()->attach([$request->users_id]);
        return redirect($to = '/inventory/warehouse/pic/index?id='.$request->warehouse_id, $status = 302, $headers = [], $secure = null);
    }

    public function picDelete(Request $request)
    {
        $users_warehouse = Warehouse::find($request->warehouse_id)->users();
        $status          = $users_warehouse->detach([$request->user_id]);
        return redirect($to = '/inventory/warehouse/pic/index?id='.$request->warehouse_id, $status = 302, $headers = [], $secure = null);
    }

    public function delete(Request $request)
    {
        $stat = false;
        $warehouses                                 = Warehouse::find($request->id);
        $status                                     = $warehouses->delete();

        if ($status) 
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function details(Request $request,$id)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $warehouse = Warehouse::find($id);
        return view('inventory::warehouse.details',compact('warehouse','user','project'));
    }

}

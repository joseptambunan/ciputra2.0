<?php

namespace Modules\Department\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Department\Entities\Department;
use Modules\Project\Entities\Project;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $user = \Auth::user();
        $department = Department::orderBy("id","desc")->get();
        $project = Project::get();
        return view('department::index',compact("user","department","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('department::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('department::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('department::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function adddepartment(Request $request){
        $department = new Department;
        $department->code = $request->code;
        $department->name = $request->department;
        $department->description = $request->keterangan;
        $department->save();
        return redirect("department");
    }

    public function deletedepartment(Request $request){
        $department = Department::find($request->id);
        $status = $department->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function updatedepartment(Request $request){
        $department = Department::find($request->id);
        $department->name = $request->name;
        $department->code = $request->code;
        $status = $department->save();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }
}

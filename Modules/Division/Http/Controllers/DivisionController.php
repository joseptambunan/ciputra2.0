<?php

namespace Modules\Division\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Division\Entities\Division;
use Modules\Project\Entities\Project;

class DivisionController extends Controller
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
        $divisions = Division::orderBy("id","desc")->get();
        $project = Project::get();
        return view('division::index',compact("user","divisions","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('division::create');
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
        return view('division::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('division::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $division = Division::find($request->id);
        $division->name = $request->name;
        $division->code = $request->code;
        $status = $division->save();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $division = Division::find($request->id);
        $status = $division->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function adddivision(Request $request){
        $division = new Division;
        $division->code = $request->code;
        $division->name = $request->division;
        $division->description = $request->keterangan;
        $status = $division->save();
        return redirect("division");
    }


}

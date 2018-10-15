<?php

namespace Modules\Jabatan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Jabatan\Entities\UserJabatan;
use Modules\Project\Entities\Project;

class JabatanController extends Controller
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
        $jabatan = UserJabatan::get();
        $project = Project::get();
        return view('jabatan::index',compact("user","jabatan","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('jabatan::create');
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
        return view('jabatan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('jabatan::edit');
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

    public function addJabatan(Request $request){
        $jabatan = new UserJabatan;
        $jabatan->code = $request->code;
        $jabatan->name = $request->jabatan;
        $jabatan->description = $request->keterangan;
        $jabatan->save();
        return redirect("jabatan");
    }

    public function deletejabatan(Request $request){
        $jabatan = UserJabatan::find($request->id);
        $status = $jabatan->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function updatejabatan(Request $request){
        $jabatan = UserJabatan::find($request->id);
        $jabatan->name = $request->name;
        $jabatan->code = $request->code;
        $status = $jabatan->save();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }

    }
}

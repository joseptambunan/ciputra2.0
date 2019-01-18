<?php

namespace Modules\Spk\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Spk\Entities\SpkType;
use Modules\Project\Entities\Project;

class SpkMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $spk_type = SpkType::get();
        $project = Project::get();
        $user = \Auth::user();
        return view('spk::master.index',compact("user","project","spk_type"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $spk_type = new SpkType;
        $spk_type->description = $request->tipe;
        $spk_type->save();
        return redirect("/spk/tipe");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('blog::edit');
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
    public function destroy(Request $request)
    {
        $spk_type = SpkType::find($request->id);
        $spk_type->delete();
        return response()->json( ["status" => "0"] );
    }
}

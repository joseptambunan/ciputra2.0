<?php

namespace Modules\TenderMaster\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TenderMaster\Entities\TenderMaster;

class TenderMasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tendermaster = TenderMaster::get();
        $user = \Auth::user();
        return view('tendermaster::index',compact("user","tendermaster"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('tendermaster::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $tendermaster = new TenderMaster;
        $tendermaster->name = $request->name;
        $tendermaster->save();
        return redirect("/tendermaster");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('tendermaster::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('tendermaster::edit');
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
        $tendermaster = TenderMaster::find($request->id);
        $tendermaster->delete();
        return response()->json( ["status" => "0"] );
    }
}

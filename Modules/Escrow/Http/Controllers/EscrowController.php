<?php

namespace Modules\Escrow\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Escrow\Entities\Escrow;
use Modules\Project\Entities\Project;
use Modules\Pekerjaan\Entities\Itempekerjaan;

class EscrowController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $escrow = Escrow::get();
        $user   = \Auth::user();
        $project = Project::get();
        return view('escrow::index',compact("user","escrow","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('escrow::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $escrow = new Escrow;
        $escrow->name = $request->name;
        $escrow->created_by = \Auth::user()->id;
        $escrow->save();
        return redirect("escrow");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $escrow = Escrow::find($request->id);
        $user   = \Auth::user();
        $project = Project::get();
        $itempekerjaan = Itempekerjaan::get();
        return view('escrow::show',compact("user","project","escrow","itempekerjaan"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('escrow::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $itempekerjaan = Itempekerjaan::find($request->itempekerjaan_id);
        $code = $itempekerjaan->code;
        $all_item = Itempekerjaan::where("code","like",$code."%")->get();
        foreach ($all_item as $key => $value) {
            $item = Itempekerjaan::find($value->id);
            $item->escrow_id = $request->escrow;
            $item->save();
        }

        return redirect("/escrow/detail?id=".$request->escrow);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $itempekerjaan = Itempekerjaan::find($request->id);
        $itempekerjaan->escrow_id = null;
        $status = $itempekerjaan->save();
        if ( $status == "0"){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }
}

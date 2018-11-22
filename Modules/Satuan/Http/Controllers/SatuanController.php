<?php

namespace Modules\Satuan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Satuan\Entities\CoaSatuan;
use Modules\Pekerjaan\Entities\Itempekerjaan;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = \Auth::user();
        $satuan = CoaSatuan::get();
        return view('satuan::index',compact("user","satuan"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('satuan::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {

        return view('satuan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('satuan::edit');
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
    public function store(Request $request)
    {
        $user = \Auth::user();
        $coa_satuan = new CoaSatuan;
        $coa_satuan->satuan = $request->itemsatuan;
        $coa_satuan->created_by = $user->id;
        $coa_satuan->save();
        return redirect("satuan");
    }

    public function destroy(Request $request){
        $user = \Auth::user();
        $satuan = CoaSatuan::find($request->id);
        $satuan->deleted_at = date("Y-m-d H:i:s.u");
        $satuan->deleted_by = $user->id;
        return response()->json( ["status" => "0"] );
    }
}

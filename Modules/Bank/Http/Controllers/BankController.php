<?php

namespace Modules\Bank\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Bank\Entities\Bank;
use Modules\Country\Entities\City;
use Modules\Project\Entities\Project;

class BankController extends Controller
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
        $bank = Bank::orderBy("name","asc")->get();
        $city = City::get();
        $project = Project::get();
        return view('bank::index',compact("bank","user","city","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $bank = new Bank;
        $bank->name = $request->bank;
        $bank->masking = $request->masking;
        $bank->city_id = $request->city_id;
        $status = $bank->save();
        return redirect("bank");
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
        return view('bank::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $bank = Bank::find($request->id);
        $bank->name = $request->name;
        $bank->masking = $request->masking;
        $bank->city_id = $request->kota;
        $status = $bank->save();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
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
        $bank = Bank::find($request->id);
        $status = $bank->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }
}

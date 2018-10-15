<?php

namespace Modules\Country\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Country\Entities\Country;
use Modules\Country\Entities\Province;
use Modules\Country\Entities\City;
use Modules\Project\Entities\Project;

class CountryController extends Controller
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
        $country = Country::get();
        $project = Project::get();
        return view('country::index',compact("user","country","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('country::create');
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
        return view('country::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('country::edit');
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

    public function detail(Request $request){
        $country = Country::find($request->id);
        $user = \Auth::user();
        $project = Project::get();
        return view('country::detail',compact("user","country","project"));
    }

    public function addProvince(Request $request){
        $country = $request->country;
        $name = $request->province;
        $province = new Province;
        $province->country_id = $country;
        $province->name = $name;
        $status = $province->save();
        return redirect("/country/detail/?id=".$country);
    }

    public function addCities(Request $request){
        $province = $request->province;
        $city = $request->city;
        $cities = new City;
        $cities->province_id = $province;
        $cities->name = $city;
        $cities->save();

        $province = Province::find($province);
        $country  = $province->country->id;
        return redirect("/country/detail/?id=".$country);
    }

    public function deleteCities(Request $request){
        $cities = City::find($request->id);
        $status = $cities->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function deleteProvince(Request $request){
        $province = Province::find($request->id);
        $status = $province->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function updateCity(Request $request){
        $cities = City::find($request->id);
        $cities->name = $request->city;
        $status = $cities->save();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function updateProv(Request $request){
        $province = Province::find($request->id);
        $province->name = $request->province;
        $status = $province->save();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }
}

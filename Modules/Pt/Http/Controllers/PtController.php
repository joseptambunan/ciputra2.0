<?php

namespace Modules\Pt\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Pt\Entities\Pt;
use Modules\Country\Entities\City;
use Modules\Country\Entities\Province;
use Modules\Bank\Entities\Bank;
use Modules\Pt\Entities\PtMasterRekening;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectPtUser;
use Modules\Department\Entities\Department;
use Modules\Division\Entities\Division;
use Modules\Pt\Entities\Mappingperusahaan;

class PtController extends Controller
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
        $pt = Pt::get();
        $project = Project::get();
        return view('pt::index',compact("user","pt","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = \Auth::user();
        $city = City::get();
        $project = Project::get();
        return view('pt::create',compact("user","city","project"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $pt = new Pt;
        $pt->code = $request->code;
        $pt->city_id = $request->kota;
        $pt->name = $request->name;
        $pt->code = $request->code;
        $pt->address = $request->alamat;
        $pt->phone = $request->telepon;
        $pt->npwp = $request->npwp;
        $pt->description = $request->keterangan;
        $pt->save();
        return redirect("/pt/detail/?id=". $pt->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $user = \Auth::user();
        $city = City::get();
        $pt = Pt::find($request->id);
        $bank = Bank::get();
        $project = Project::get();
        $department = Department::get();
        $divisi = Division::get();
        return view('pt::detail',compact("user","city","pt","bank","project","department","divisi"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $pt = Pt::find($request->ptid);
        $pt->name = $request->name;
        $pt->code = $request->code;
        $pt->address = $request->alamat;
        $pt->npwp = $request->npwp;
        $pt->phone = $request->telepon;
        $pt->city_id = $request->kota;
        $pt->description = $request->keterangan;
        $status = $pt->save();
        return redirect("pt/detail/?id=".$request->ptid);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $rekening = PtMasterRekening::find($request->id);
        $rekening->bank_id = $request->bank;
        $rekening->rekening = $request->rekening;
        $status = $rekening->save();
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
        $rekening = PtMasterRekening::find($request->id);
        $status = $rekening->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function addrekening(Request $request){

        $rekening = new PtMasterRekening;
        $rekening->pt_id = $request->pt_id;
        $rekening->bank_id = $request->bank;
        $rekening->rekening  = $request->rekening  ;
        $rekening->save();
        return redirect("pt/detail/?id=".$request->pt_id);
    }

    public function addproject(Request $request){
        $pt = new ProjectPtUser;
        $pt->user_id = \Auth::user()->id;
        $pt->pt_id = $request->pt_proyek;
        $pt->project_id = $request->project;
        $pt->save();
        return redirect("/pt/detail/?id=".$request->pt_proyek);
    }

    public function deleteproject(Request $request)
    {
        $project = ProjectPtUser::find($request->id);
        $status = $project->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function addmapping(Request $request){
        $mapping = new Mappingperusahaan;
        $mapping->pt_id = $request->pt_mapping;
        $mapping->department_id = $request->departmen_mapping;
        $mapping->division_id = $request->divisiion_mapping;
        $mapping->save();
        return redirect("/pt/detail/?id=".$request->pt_mapping);
    }

    public function deletemapping(Request $request){
        $mapping = Mappingperusahaan::find($request->id);
        $status = $mapping->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }
}

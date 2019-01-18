<?php

namespace Modules\Kontraktor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Rekanan\Entities\RekananGroup;
use Modules\Country\Entities\Country;
use Modules\Rekanan\Entities\Rekanan;
use Modules\Globalsetting\Entities\Globalsetting;

class KontraktorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        return view('kontraktor::index',compact("project","user"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('kontraktor::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $rekanan_group = new RekananGroup;
        $rekanan_group->npwp_no = $request->npwp_no;
        $rekanan_group->profile_images = "1286785.png";
        $rekanan_group->project_id = $project->id;
        $rekanan_group->save();
        $data['status'] = 0;
        $data['id'] = $rekanan_group->id;
        echo json_encode($data);
    }   

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        $rekanan_group = RekananGroup::find($request->id);
        $country = Country::get();
        if ( $rekanan_group->rekanans->count() <= 0 ){
            $email = "";
            $telepon = "";
        }else{
            $email = $rekanan_group->rekanans->first()->email;
            $telepon = $rekanan_group->rekanans->first()->telp;
        }

        return view('kontraktor::show',compact("project","user","country","rekanan_group","telepon","email"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('kontraktor::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $rekanan_group = RekananGroup::find($request->rekanan_group_id);
        if (!file_exists ("./assets/rekanan/".$request->rekanan_group_id )) {
            mkdir("./assets/rekanan/".$request->rekanan_group_id);
            chmod("./assets/rekanan/".$request->rekanan_group_id,0755);
        }

        $global = Globalsetting::where("parameter","ppn")->get();
        if ( count($global) > 0 ){
            $ppn = $global->first()->value;
        }else{
            $ppn = 0;
        }

        $target_file = "./assets/rekanan/".$request->rekanan_group_id."/".$_FILES['npwp']['name'];
            move_uploaded_file($_FILES["npwp"]["tmp_name"], $target_file);
        $target_file_cv= "./assets/rekanan/".$request->rekanan_group_id."/".$_FILES['cv']['name'];
            move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file_cv);

        if ( $rekanan_group->rekanans->count() <= 0 ){
            $rekanan = new Rekanan;
            $rekanan->rekanan_group_id = $rekanan_group->id;
            $rekanan->name = $request->nama_perusahaan;
            $rekanan->surat_alamat = $request->alamat_perusahaan;
            $rekanan->telp = $request->telp_perusahaan;
            $rekanan->email = $request->email_perusahaan;
            $rekanan->cv = $_FILES['cv']['name'];
            $rekanan->ppn = $ppn;
            if ( $request->pkp == null ){
                $rekanan->pkp_status = 2;
            }else{
                $rekanan->pkp_status = 1;
            }
            $rekanan->save();
        }else{
            $rekanan_child_id = $rekanan_group->rekanans->first()->id;
            $rekanan = Rekanan::find($rekanan_child_id);            
            $rekanan->rekanan_group_id = $rekanan_group->id;
            $rekanan->name = $request->nama_perusahaan;
            $rekanan->surat_alamat = $request->alamat_perusahaan;
            $rekanan->telp = $request->telp_perusahaan;
            $rekanan->email = $request->email_perusahaan;
            $rekanan->cv = $_FILES['cv']['name'];
            $rekanan->ppn = $ppn;
            if ( $request->pkp == null ){
                $rekanan->pkp_status = 2;
            }else{
                $rekanan->pkp_status = 1;
            }

            $rekanan->save();
        }

        if ( $request->pkp == null ){
            $rekanan->coa_ppn = 2;
        }else{
            $rekanan->coa_ppn = 1;
        }

        $rekanan_group->name = $request->nama_perusahaan;
        $rekanan_group->npwp_image = $_FILES['npwp']['name'];
        $rekanan_group->npwp_kota = $request->kota;
        $rekanan_group->npwp_alamat = $request->alamat_perusahaan;
        $rekanan_group->description = $request->description;
        $rekanan_group->save();
        

        return redirect("/kontraktor/detail/?id=".$rekanan_group->id );
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function ceknpwp(Request $request){
        $npwp = $request->npwp;
        $kontraktor = RekananGroup::where("npwp_no",$npwp)->count();
        if ( $kontraktor > 0) {
            $data['status'] = 0;
        }else{
            $data['status'] = 1;
        }

        echo json_encode($data);
    }
}

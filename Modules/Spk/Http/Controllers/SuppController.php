<?php

namespace Modules\Spk\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Spk\Entities\Spk;
use Modules\Project\Entities\Project;
use Modules\Rekanan\Entities\RekananSupp;
use Modules\Rekanan\Entities\RekananSuppTemplate;
use Modules\Rekanan\Entities\SuppTemplate;

class SuppController extends Controller
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
        return view('spk::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $spk = Spk::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view('spk::supp.create',compact("spk","project","user"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $spk = Spk::find($request->spk_id);
        $supp_no = RekananSupp::get()->count() + 1 ."/SUPP/".date("m")."/".date("Y")."/".$spk->tender->rab->budget_tahunan->budget->pt->code;
        $supp_template_id = SuppTemplate::get()->last();
        $rekanan_supp = new RekananSupp;
        $rekanan_supp->rekanan_id = $request->rekanan_id;
        $rekanan_supp->pt_id = $request->pt_id;
        $rekanan_supp->penandatangan = $request->penandatangan;
        $rekanan_supp->saksi = $request->saksi;
        $rekanan_supp->supp_template_id = $supp_template_id->id;
        $rekanan_supp->no = $supp_no;
        $rekanan_supp->date = date("Y-m-d");
        $rekanan_supp->expired_at = NULL;
        $rekanan_supp->setuju_at = NULL;
        $rekanan_supp->printed_at = NULL;
        $rekanan_supp->saksi_rekanan_name = $request->cp_jabatan;
        $rekanan_supp->saksi_rekanan_name_2 = $request->cp_saksi;
        $rekanan_supp->save();
        return redirect("/spk/supp/?id=".$spk->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $spk = Spk::find($request->id);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view('spk::supp.show',compact("user","project","spk"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('spk::edit');
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
}

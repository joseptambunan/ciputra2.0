<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;


class ProjectController extends Controller
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
        if ( $user->group->id == "1"){
            $project = Project::get();
        }else{
            $project = $user->project;
        }
        return view('project::index',compact("user","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = \Auth::user();
        return view('project::create',compact("user"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $project = new Project;
        $project->subholding = $request->subholding;
        $project->code = $request->code;
        $project->name = $request->name;
        $project->luas = str_replace(",","",$request->luas);
        $project->address = $request->address;
        $project->zipcode = $request->zipcode;
        $project->phone = $request->phone;
        $project->fax    = $request->fax ;
        $project->email = $request->email;
        $project->description = $request->description;
        $project->save();

        return redirect("project/detail/?id=".$project->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $project = Project::find($request->id);
        return view('project::show',compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('project::edit');
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

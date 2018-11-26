<?php

namespace Modules\Approval\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Modules\Approval\Entities\ApprovalReference;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('approval::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('approval::create');
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
        return view('approval::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('approval::edit');
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

    public function saveapprovaldetail(Request $request){

        foreach ($request->check_ as $key => $value) {
            if ( isset($request->document_[$key]) ){
                if ( $request->check_[$key] != ""){                    
                    $approval_reference = new ApprovalReference;
                    $approval_reference->user_id = $request->user_id;
                    $approval_reference->project_id = $request->project_id;
                    $approval_reference->pt_id = $request->pt_id;
                    $approval_reference->document_type = $request->document_[$key];
                    $approval_reference->no_urut = $request->urut[0];
                    $approval_reference->min_value = 0;
                    $approval_reference->max_value = str_replace(",", "", $request->max_value_[$key]);
                    $status = $approval_reference->save();  
                }              
            }        
        }
        return redirect("/user/detail/?id=".$request->user_id);
    }
}

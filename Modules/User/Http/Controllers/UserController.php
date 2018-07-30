<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Entities\UserGroup;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectPtUser;
use Modules\Pt\Entities\Pt;
use Modules\Document\Entities\DocumentType;
use Modules\Approval\Entities\ApprovalReference;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = \Auth::user();
        if ( $user->group->id == "1"){
            return redirect("home");          
        }else{

        }
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('user::create');
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
        $user = \Auth::user();
        $usermaster = User::get();
        return view('user::show',compact("user","usermaster"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function detail(Request $request)
    {
        $user = \Auth::user();
        $users = User::find($request->id);
        $project_pt_user = $users->project_pt_users;
        $project = Project::get();
        $pt = Pt::get();
        $document = DocumentType::get();
        return view('user::detail',compact("user","project_pt_user","project","pt","document","users"));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function updateProject(Request $request)
    {
        $project = ProjectPtUser::find($request->id);
        $project->project_id = $request->project_name_;
        $project->pt_id = $request->pt_name;
        $status = $project->save();
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
        $user = User::find($request->id);
        $status = $user->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function saveapproval(Request $request){
        //print_r($request->min_value_);die;
        $start = 0;
        foreach ($request->document_ as $key => $value) {
            if ( isset($request->check_[$start]) ){
                $approval_reference = new ApprovalReference;
                $approval_reference->user_id = \Auth::user()->id;
                $approval_reference->project_id = $request->project_name;
                $approval_reference->pt_id = $request->pt_name;
                $approval_reference->document_type = $request->document_[$key];
                $approval_reference->no_urut = $request->urut[$start];
                $approval_reference->min_value = $request->min_value_[$start];
                $status = $approval_reference->save();                
            }
            $start++;
        }

        return redirect("/user/detail/?id=".\Auth::user()->id);
       
    }

    public function deleteApproval(Request $request){
        $user = ApprovalReference::find($request->id);
        $status = $user->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function addUser(Request $request){
        $user = new User;
        $user->user_login = $request->userlogin;
        $user->user_name = $request->username;
        $user->is_rekanan = $request->isrekanan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_phone = $request->phone;
        $user->description = $request->description;
        $user->save();
        return redirect("/user/detail?id=".$user->id);
    }

    public function updateUser(Request $request){
        $user = User::find($request->userid);
        $user->user_login = $request->userlogin;
        $user->user_name = $request->username;
        $user->is_rekanan = $request->isrekanan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_phone = $request->phone;
        $user->description = $request->description;
        $user->save();
        return redirect("/user/detail?id=".$request->userid);
    }
}

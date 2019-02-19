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
use Modules\Jabatan\Entities\UserJabatan;
use Modules\User\Entities\UserDetail;
use Modules\Project\Entities\ProjectPt;

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
        $project = Project::get();
        return view('user::show',compact("user","usermaster","project"));
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
        $jabatan = UserJabatan::get();
        return view('user::detail',compact("user","project_pt_user","project","pt","document","users","jabatan"));
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
        $user = ProjectPtUser::find($request->id);
        $status = $user->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
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
        $user->is_rekanan = 0;
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
        $user->is_rekanan = 0;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_phone = $request->phone;
        $user->description = $request->description;
        $user->save();
        return redirect("/user/detail?id=".$request->userid);
    }

    public function projectpt(Request $request){
        $project_pt = ProjectPt::find($request->project_s);

        $project = new ProjectPtUser;
        $project->user_id = $request->userid;
        $project->project_id = $project_pt->project->id;
        $project->pt_id = $project_pt->pt->id;
        $project->project_pt = $request->project_s;
        $status = $project->save();
        return redirect("/user/detail?id=".$request->userid);
    }

    public function saveuserdetail(Request $request){
        $user_detail = new UserDetail;
        $jabatan = UserJabatan::find($request->jabatan);
        $project_pt = ProjectPtUser::find($request->project_pt);
        if ( $request->jabatan > 5 ){
            if ( $request->dept != "" ) {
                foreach ($request->dept as $key => $value) {
                    $user_jabatan = new UserDetail;
                    $user_jabatan->user_id = $request->user_id;
                    $user_jabatan->mappingperusahaan_id = $request->dept[$key];
                    $user_jabatan->user_jabatan_id = $request->jabatan;
                    if ( $request->is_approve != "" ){
                        $user_jabatan->can_approve = 1;
                    }
                    $user_jabatan->created_by = \Auth::user()->id;
                    $user_jabatan->user_level = $jabatan->id;
                    $user_jabatan->project_pt_id = $request->project_pt;
                    $user_jabatan->save();
                }
            }else{
                $user_jabatan = new UserDetail;
                $user_jabatan->user_id = $request->user_id;
                $user_jabatan->mappingperusahaan_id = $request->dept[$key];
                $user_jabatan->user_jabatan_id = $request->jabatan;
                if ( $request->is_approve != "" ){
                    $user_jabatan->can_approve = 1;
                }
                $user_jabatan->created_by = \Auth::user()->id;
                $user_jabatan->user_level = $jabatan->id;
                $user_jabatan->project_pt_id = $request->project_pt;
                $user_jabatan->save();
            }
        }else{
            foreach ($project_pt->pt->mapping as $key => $value) {
                $user_jabatan = new UserDetail;
                $user_jabatan->user_id = $request->user_id;
                $user_jabatan->mappingperusahaan_id = $value->id;
                $user_jabatan->user_jabatan_id = $request->jabatan;
                if ( $request->is_approve != "" ){
                    $user_jabatan->can_approve = 1;
                }
                $user_jabatan->created_by = \Auth::user()->id;
                $user_jabatan->user_level = $jabatan->id;
                $user_jabatan->project_pt_id = $request->project_pt;
                $user_jabatan->save();
            }
        }

        if ( $jabatan->code == "PIC"){
            $user = User::find($request->user_id);
            $user->is_pic = 1;
            $user->save();
        }
        return redirect("/user/detail?id=".$request->user_id);
    }

    public function approvaldetail(Request $request){
        $project_pt = ProjectPtUser::find($request->id);
        $user = User::find($project_pt->user_id);
        $project = Project::get();
        $document = DocumentType::get();
        $user_detail = $user->details;
        $level = array();
        foreach ($user_detail as $key => $value) {
            $level[$key] = $value->user_level;
        }
        $uniq = array_values(array_unique($level));

        return view("user::approval_detail",compact("user","project_pt","project","document","uniq"));
    }

    public function saveapprovaldetail(Request $request){
        print_r($request->document_);
        foreach ($request->check_ as $key => $value) {
            if ( isset($request->document_[$key]) ){
                if ( $request->check_[$key] != ""){                    
                    $approval_reference = new ApprovalReference;
                    $approval_reference->user_id = $request->user_id;
                    $approval_reference->project_id = $request->project_id;
                    $approval_reference->pt_id = $request->pt_id;
                    $approval_reference->document_type = $request->document_[$key];
                    $approval_reference->no_urut = $request->urut[0];
                    $approval_reference->min_value = str_replace(",", "", $request->min_value_[$key]);
                    $approval_reference->max_value = str_replace(",", "", $request->max_value_[$key]);
                    $approval_reference->param_min = $request->param_min[$key];
                    $approval_reference->param_max = $request->param_max[$key];
                    $status = $approval_reference->save();  
                }              
            }        
        }
        return redirect("/user/detail/?id=".$request->user_id);
    }

    public function removedetail(Request $request){
        $pt = Pt::find($request->pt);
        $user = User::find($request->user_id);
        foreach ($user->details as $key => $value) {
            foreach ($pt->mapping as $key2 => $value2) {
                if ( $value2->id == $value->mappingperusahaan_id ){
                    if ( $value->user_jabatan_id == $request->jabatan_id ){
                        $user_detail = UserDetail::find($value->id);
                        $user_detail->delete();
                    }
                }
            }
        }
         return response()->json( ["status" => "0"] );
    }

    public function send_email(){
        
    }

    public function approvalde(Request $request){
        echo "asdas";
    }
}

<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Http\Requests\RequestPermintaanbarang;
use Modules\Project\Entities\Project;
use Modules\Pt\Entities\Pt;
use Modules\Department\Entities\Department;
use Modules\Spk\Entities\Spk;
use Modules\User\Entities\User;
use Modules\Inventory\Entities\Permintaanbarang;
use Modules\Inventory\Entities\StatusPermintaan;
use Modules\Inventory\Entities\CreateDocument;

use Modules\Approval\Entities\Approval;
use Modules\Approval\Entities\ApprovalAction;
use Modules\Approval\Entities\ApprovalHistory;
use Modules\Approval\Entities\ApprovalReference;
use PDF;
use Auth;

class PermintaanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $user = \Auth::user();
        $permintaans = Permintaanbarang::all();
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::permintaanbarang.index', compact('permintaans','project','user'));
    }
    
    public function add(Request $request)
    {   
        $project = Project::find($request->session()->get('project_id'));
        $projects       = Project::get();
        $pts            = User::find(Auth::user()->id)->project_pt_users->where('project_id',$request->session()->get('project_id'));
        $departments    = Department::get();
        $spks           = Spk::select('id','no')->get();
        $users          = User::get();
        $user           = \Auth::user();
        $statusPermintaans = StatusPermintaan::select('id','name')->get();
        
        return view('inventory::permintaanbarang.add_form', compact('project', 'projects', 'pts', 'departments', 'users', 'spks','statusPermintaans','user'));
    }
    
    public function addPost(RequestPermintaanbarang $request)
    {

        $stat =0;
        $project_id = $request->session()->get('project_id');
        $user_id = Auth::user()->id;
        $permintaans                            = new Permintaanbarang;
        $permintaans->project_id                = $project_id;
        $permintaans->pt_id                     = $request->pt_id;
        $permintaans->department_id             = $request->department_id;
        $permintaans->spk_id                    = $request->spk_id;
        $permintaans->user_id                   = $user_id;
        $permintaans->no                        = CreateDocument::createDocumentNumber('PB',$request->department_id,$project_id,$user_id);
        $permintaans->date                      = $request->date;
        $permintaans->status_permintaan_id      = $request->status;
        $permintaans->description               = $request->description;
        $status                                 = $permintaans->save();

        if($status)
        {
           $stat =1;
        }

        return response()->json(['return'=>$stat]);
    }

    public function edit(Request $request)
    {
        $permintaan                = Permintaanbarang::find($request->id);
        $projects                   = Project::get();
        $pts            = User::find(Auth::user()->id)->project_pt_users->where('project_id',$request->session()->get('project_id'));
        $departments                = Department::get();
        $spks                       = Spk::get();
        $users                      = User::get();
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $statusPermintaans = StatusPermintaan::select('id','name')->get();
        return view('inventory::permintaanbarang.edit_form', compact('project','permintaan', 'projects', 'pts', 'departments', 'spks', 'users','statusPermintaans','user'));
    }

    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $stat = 1;
        $permintaans                            = Permintaanbarang::find($request->id);
        $permintaans->project_id                = $request->project_id;
        $permintaans->pt_id                     = $request->pt_id;
        $permintaans->department_id             = $request->department_id;
        $permintaans->spk_id                    = $request->spk_id;
        $permintaans->user_id                   = $user_id;
        $permintaans->status_permintaan_id      = $request->status;
        $permintaans->date                      = $request->date;
        $permintaans->description               = $request->description;
        $status                                 = $permintaans->save();

        if($status)
        {
            $stat =1;
        }
        return response()->json(['return'=>$stat]);
    }

    public function delete(Request $request)
    {
        $permintaans = Permintaanbarang::find($request->id);
        $status      = $permintaans->delete();

        if ($status) 
        {
            return $permintaans;
        }else{
            return 'Failed';
        }
    }

    public function print(Request $request)
    {
        $id_permintaan = $request->permintaan_barang_id;
        $permintaan = Permintaanbarang::find($id_permintaan);
       // $details = 
        //return view('permintaan_barang.print',compact('permintaan'));     
        $pdf = PDF::loadView('inventory::permintaanbarang.print',compact('permintaan'))->setPaper('a4','potrait');
        return $pdf->stream('laporan_permintaan_barang.pdf');

    }

    public function approvePermintaanBarang(Request $request)
    {
        $stat = false;
        $document_id = $request->id;
        $approval_action_id = 6;
        $documentType = 'Modules\Inventory\Entities\Permintaanbarang';
        $user_id = Auth::user()->id;

        $approvePermintaanbarang = Permintaanbarang::find($document_id)->update(['confirm_by_requester'=>1]);
        if($approvePermintaanbarang)
        {
            $createApproval = Approval::create(
                [
                    'approval_action_id'=>$approval_action_id,
                    'document_id'=>$document_id,
                    'document_type'=>$documentType
                ]
            );
            if($createApproval)
            {
                $createHistory =ApprovalHistory::create([
                    'no_urut'=>$user_id,
                    'user_id'=>$user_id,
                    'approval_action_id'=>$approval_action_id,
                    'approval_id'=>$createApproval->id,
                    'document_id'=>$document_id,
                    'document_type'=>$documentType,
                    'description'=>'Permintaanbarang'
                ]);

                if($createHistory)
                {
                    $stat = true;
                }
            }
        }

        return response()->json($stat);
        
    }
}

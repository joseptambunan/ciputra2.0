<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PrivilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        //print_r(\Auth::user());
        $user = \Modules\User\Entities\User::find(\Auth::user()->id);
        $jabatan = $user->jabatan;
        if ( $user->id == "1"){
            $request->session()->put('level', 'superadmin');
            return redirect("user");
        }

        foreach ($jabatan as $key => $value) {
            if ( $value['level'] == "10"){
                $request->session()->put('level', '');
                return redirect("/project/detail?id=".$value['project_id']);
            }else{
                $request->session()->put('level', '');
                return redirect("/access");
            }
        }
        /*if ( $user->is_level == "2"){
            return redirect("/kontraktor");
        }elseif ( $user->is_level == "1") {
            if ( $user->id == "1"){
                return redirect("/user");
            }else{
                return redirect("/access");
            }
        }*/
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
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('user::edit');
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
        \Auth::logout();
        return redirect("/");
    }

    
}

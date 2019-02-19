<?php

namespace Modules\Globalsetting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Globalsetting\Entities\Globalsetting;

class GlobalsettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = \Auth::user();
        $globalsetting = Globalsetting::get();
        return view('globalsetting::index',compact("user","globalsetting"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('globalsetting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $globalsetting = new Globalsetting;
        $globalsetting->parameter = $request->params;
        $globalsetting->value = $request->nilai;
        $globalsetting->save();
        return redirect("/globalsetting");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('globalsetting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('globalsetting::edit');
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

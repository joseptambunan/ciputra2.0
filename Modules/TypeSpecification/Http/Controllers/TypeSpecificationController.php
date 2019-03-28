<?php

namespace Modules\TypeSpecification\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TypeSpecification\Entities\TypeSpecification;


class TypeSpecificationController extends Controller
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
        $type_specification =TypeSpecification::get();
        $user = \Auth::user();
        return view('typespecification::index',compact("type_specification","user"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('typespecification::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $typespecification = new TypeSpecification;
        $typespecification->specification = $request->name;
        $typespecification->save();
        return redirect("typespecification");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('typespecification::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('typespecification::edit');
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

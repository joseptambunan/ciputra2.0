<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Modules\Category\Entities\Category;
use \Modules\Category\Entities\CategoryDetail;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = \Auth::user();
        $category = Category::get();
        return view('category::index',compact("user","category"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->nama;
        $category->created_by =\Auth::user()->id;
        $category->save();
        return redirect("category");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $category = Category::find($request->id);
        $details = $category->details;
        $user = \Auth::user();
        return view('category::detail',compact("user","details","category"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $category_detail = new CategoryDetail;
        $category_detail->category_id = $request->category_id;
        $category_detail->sub_type = $request->nama;
        $category_detail->save();
        return redirect("category/detail?id=".$request->category_id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $status = $category->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function deletedetail(Request $request){
        $category_detail = CategoryDetail::find($request->id);
        $status = $category_detail->delete();
        if ( $status ){
            return response()->json( ["status" => "0"] );
        }else{
            return response()->json( ["status" => "1"] );
        }
    }

    public function updatepercentage(Request $request){
        foreach ($request->id_ as $key => $value) {
            $category_detail = CategoryDetail::find($request->id_[$key]);
            $category_detail->percentage = str_replace(",", "", $request->percentage_[$key]);
            $category_detail->save();
        }
        return redirect("category/detail?id=".$request->category_id);
    }
}

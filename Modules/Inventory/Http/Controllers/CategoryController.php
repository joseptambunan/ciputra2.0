<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Http\Requests\RequestCategory;
use Modules\Inventory\Http\Requests\RequestEditCategory;
use Modules\Inventory\Entities\ItemCategory;
use Modules\Project\Entities\Project;
use Auth;

class CategoryController extends Controller
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
        $project = Project::all();
        $user = Auth::user();
        return view('inventory::category.show',compact('project','user'));
       // return view('Category.index', compact('categories', 'ItemCategory', 'item_category'));
    }

    public function getCategories()
    {
        $all_category = ItemCategory::all();
        foreach ($all_category as $key => $value) {
            # code...
            $sub_data['id'] = $value->id;
            $sub_data['name'] = $value->name;
            $sub_data['text'] = $value->name;

            $sub_data['tags'][0] = $value->child->count();

            $sub_data['parent_id'] = $value->parent_id;
            $data[] = $sub_data;

        }

        foreach ($data as $key => &$value) {
            # code...
            $output[$value['id']] = &$value;
        }

        foreach ($data as $key => &$value) {
            # code...
            if($value['parent_id'] && isset($output[$value['parent_id']]))
            {
                $output[$value['parent_id']]['nodes'][] = &$value;
            }
        }

        foreach ($data as $key => &$value) {
            # code...
            if($value['parent_id'] && isset($output[$value['parent_id']]))
            {
                unset($data[$key]);
            }
        }
        //$data = json_decode($data);
        return response()->json($data);
    }

    public function getparent()
    {
        $categories             = ItemCategory::where('parent_id',0)->get();

        return response()->json($categories);
    }

    public function add(Request $request)
    {

        $project = Project::all();
        $user = Auth::user();
        return view('inventory::category.add_form',compact('user','project'));
    }
    
    public function addPost(RequestCategory $request) 
    {
        $stat                       = 0;
        $errMsg                     ='';
        $ItemCategory               = new ItemCategory;
        $ItemCategory->parent_id    = $request->parent_id;
        $ItemCategory->name         = $request->name;
        try
        {
            $status = $ItemCategory->save();
            if($status)
            {
                $stat = 1;
            }
        }
        catch(Exception $e)
        {
            $errMsg = $e->getMessage();
        }

        return response()->json(['return'=>$stat,'errMsg'=>$errMsg]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $project = Project::all();
        $categories             = ItemCategory::find($request->id);
        $ItemCategory           = ItemCategory::where('parent_id',0)->get();

        return view('inventory::Category.edit_form', compact('categories', 'ItemCategory','project','user'));
    }

    public function update(RequestEditCategory $request)
    {
        $stat = false;
        $ItemCategory               = ItemCategory::find($request->id);
        $ItemCategory->parent_id    = $request->parent_id;
        $ItemCategory->name         = $request->name;
        $status                     = $ItemCategory->save();

        if ($status) 
        {

            $stat = true;
        }

        return response()->json($stat);
    }

    public function delete(Request $request)
    {
        $ItemCategory               = ItemCategory::find($request->id);
        $status                 = $ItemCategory->delete();
        $stat = false;
        if ($status) 
        {
            $stat = true;
        }

        return response()->json($stat);
    }
}

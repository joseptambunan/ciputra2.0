<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Project\Entities\Project;
use Modules\Inventory\Entities\Brand;
use Modules\Inventory\Http\Requests\RequestBrand;
use Auth;

class BrandController extends Controller
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
        $brands = Brand::all();
        return view('inventory::brand.index', compact('brands','user','project'));
    }

    public function add(Request $request)
    {
        $project = Project::all();
        $user = Auth::user();
        return view('inventory::brand.add_form',compact('user','project'));
    }
    
    public function addPost(RequestBrand $request) 
    {
        $stat   = 0;
        $errMsg = '';
        $name   = $request->name;
        $check = Brand::where('name','=',$name)->first();
        if($check != null)
        {
           $errMsg ='brand '.$check->name.' sudah ada!';
        }
        else
        {
            try
            {
                $status         = Brand::create(['name'=>$name]);
                if ($status) 
                {
                    $stat=1;
                }
            }
            catch(Exception $e)
            {
                $errMsg = $e->getMessage();
            }
            
        }
        return response()->json(['return'=>$stat,'errMsg'=>$errMsg]);
    }

    public function edit(Request $request)
    {
        $brands             = \App\Brand::find($request->id);

        return view('inventory::brand.edit_form', compact('brands'));
    }

    public function update(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = Brand::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);

    }

    public function delete(Request $request)
    {
        $brand              =Brand::find($request->id);
        $status             = $brand->delete();
        $stat = false;
        if ($status) 
        {
            $stat = true;
        }

        return response()->json($stat);
    }
}

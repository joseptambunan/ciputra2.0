<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Http\Requests\RequestPeriodeOpName;

use Modules\Inventory\Entities\PeriodOpName;
use Modules\Inventory\Entities\OpNameAsset;
use Modules\Inventory\Entities\Warehouse;
use Modules\Project\Entities\Project;
use datatables;
class StockOpNameController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function assets($periode_id)
    {
        $detailPeriod = PeriodOpName::find($periode_id);

        return view('inventory::qr_code_reader.stock_opname_assets',compact('detailPeriod'));
    }

    public function getAssets()
    {

       // return datatables()->of()->toJson();
    }

    public function scan(Request $request,$periode_id)
    {
        $header = PeriodOpName::find($periode_id);
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::qr_code_reader.scan_qr_code',compact('header','project'));
    }

    public function setup_period(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $warehouses = Warehouse::select('id','name')->get();

    	return view('inventory::qr_code_reader.create_period',compact('warehouses','project'));
    }

    public function store_period(RequestPeriodeOpName $request)
    {
        $start_opname = $request->start_opname;
        $end_opname = $request->end_opname;
        $warehouse_id = $request->warehouse_id;
        $desc = $request->description;

        $execute = PeriodOpName::create([
            'start_opname'=>$start_opname,
            'end_opname'=>$end_opname,
            'warehouse_id'=>$warehouse_id,
            'description'=>$desc
        ]);

        if($execute)
        {
            return redirect('/inventory/opname/scan_qr_code/'.$execute->id);
        }
    }

    public function store_opname(Request $request)
    {
        $stat = false;
        $dataExists = [];
        $action = '';
        $period_op_name_id = $request->period_op_name_id;
        $allItemStore = json_decode($request->allItemStore);
        if(count($allItemStore) > 0)
        {
            for($i =0;$i < count($allItemStore);$i++)
            {
                $check = OpNameAsset::where([
                    ['period_op_name_id','=',$period_op_name_id],
                    ['barcode','=',$allItemStore[$i]->kode_barang]
                ])->first();

                if($check == null)
                {
                    $action = OpNameAsset::create([
                                    'period_op_name_id'=>$period_op_name_id,
                                    'barcode'=>$allItemStore[$i]->kode_barang
                                    ,'item_id'=>$allItemStore[$i]->kode_produk
                                    ,'description'=>$allItemStore[$i]->remarks]);
                }
                else
                {
                    $isExists = array(
                        'item_name' => $allItemStore[$i]->nama_barang,
                        'barcode' => $allItemStore[$i]->kode_barang
                    );
                    array_push($dataExists, $isExists);
                }
                
            }
            if($action)
            {
                $stat = true;
            }
        }


        return response()->json(['stat'=>$stat,'dataExists'=>$dataExists]);
    }

    public function getPeriodAssetOp()
    {
        $periods = PeriodOpName::all();
        $results = [];
        foreach ($periods as $key => $value) {
            # code...
            $arr = array(
                'id' => $value->id,
                'start_opname'=>date('d-m-Y',strtotime($value->start_opname)),
                'end_opname' =>date('d-m-Y',strtotime($value->end_opname)),
                'warehouse_id'=>$value->warehouse_id,
                'warehouse_name'=>$value->warehouse->name,
                'description' =>$value->description
            );

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();
    }

    public function periode_index(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::qr_code_reader.periode_opname_assets',compact('project'));
    }

    public function updatePeriod(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = PeriodOpName::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
    }

    public function deletePeriode(Request $request)
    {
        $stat=0;
        $id = $request->id;
        $execute_delete = PeriodOpName::find($id)->delete();
        if($execute_delete)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
    }

}

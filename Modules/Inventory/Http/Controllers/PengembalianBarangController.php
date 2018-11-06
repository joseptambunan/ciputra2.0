<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Http\Requests\RequestPengembalianbarang;
use Modules\Inventory\Entities\Pengembalianbarang;
use Modules\Inventory\Entities\PengembalianbarangDetail;
use Modules\Inventory\Entities\Permintaanbarang;
use Modules\Inventory\Entities\Keterangan;
use Modules\Project\Entities\Project;
use Modules\Inventory\Entities\Barangkeluar;
use Modules\Inventory\Entities\Warehouse;
use Modules\Inventory\Entities\CreateDocument;
use datatables;
use DB;
use Auth;
class PengembalianBarangController extends Controller
{
    //
    public function index(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
    	return view("inventory::pengembalian_barang.index",compact('project','user'));
    }

    public function add(Request $request)
    {
        $user = \Auth::user();
         $warehouses = Warehouse::all();
         $remarks = Keterangan::all();
         $project = Project::find($request->session()->get('project_id'));
    	return view("inventory::pengembalian_barang.add_form",compact('project','remarks','warehouses','user'));
    }

    public function store(Request $request)
    {
    	$execute = '';
    	$errMsg = '';
    	$stat = false;
    	$allItemStore = json_decode($request->allItemStore);
        $project_id = $request->session()->get('project_id');
        $user_id = Auth::user()->id;
    	if(count($allItemStore) > 0)
    	{
            CreateDocument::createDocumentNumber('PB',$request->department_id,$project_id,$user_id);
            for($i = 0; $i < count($allItemStore);$i++){
                $execute = Pengembalianbarang::create([
                            'barangkeluar_id'=>$allItemStore[$i]->barangkeluar_id
                            ,'no'=>CreateDocument::createDocumentNumber('PNB', $allItemStore[$i]->department_id,$project_id,$user_id)
                            //,'item_id' => $allItemStore[$i]->item_id
                            //,'warehouse_id'=>$allItemStore[$i]->warehouse_id
                            ,'quantity_pinjam'=>$allItemStore[$i]->quantity_pinjam
                            /*,'quantity_kembali' => $allItemStore[$i]->quantity_kembali
                            ,'item_satuan_id'=>$allItemStore[$i]->item_satuan_id
                            ,'remarks' => $allItemStore[$i]->remarks*/
                        ]);

                if($execute)
                {
                    $createDetail = PengembalianbarangDetail::create(
                        [
                            'pengembalianbarang_id'=>$execute->id,
                             'barangkeluar_id'=>$allItemStore[$i]->barangkeluar_id,
                            'item_id'=>$allItemStore[$i]->item_id,
                            'warehouse_id'=>$allItemStore[$i]->warehouse_id,
                            'quantity_kembali'=>$allItemStore[$i]->quantity_kembali,
                            'remarks'=>$allItemStore[$i]->remarks,
                            'item_satuan_id'=>$allItemStore[$i]->item_satuan_id
                        ]
                    );
                    if($createDetail)
                    {
                        $stat = true;
                    }
                }
            }
    	}
    	else
    	{
    		$errMsg = 'Data belum lengkap';
    	}

    	return response()->json(['stat'=>$stat,'errMsg'=>$errMsg]);
    }

    public function getData()
    {
    	$arrdata = [];
        $getDatas=PengembalianbarangDetail::all();
        foreach ($getDatas as $key => $value) {
            # code...
            $list = array('nomor'=>$value->pengembalianbarang->no,
                'no_bk'=>$value->barangkeluar->no,
            'item_name'=>$value->items->name,
            'qty_pinjam'=>$value->pengembalianbarang->quantity_pinjam,
            'satuan_name'=>is_null($value->satuan) ? '-' : $value->satuan->name,
            'qty_kembali'=>$value->quantity_kembali
        );

            array_push($arrdata, $list);
        }
    	return datatables()->of($arrdata)->toJson();

    }

    public function checkNoPermintaanBarang(Request $request)
    {
        //$stat = false;
        $permintaanbarang_id = 0;
        $barangkeluar_results = [];
        $nomor_permintaan = $request->nomor_permintaan_barang;
        $permintaanBarang = Permintaanbarang::where('no',$nomor_permintaan)->first();
        $department_id = $permintaanBarang->department_id;
        $check_permintaan = Barangkeluar::where('permintaanbarang_id',$permintaanBarang->id)->get();

        foreach ($check_permintaan as $key => $value) {
            # code...
            $arrData = array(
                'barangkeluar_id'=>$value->id,
                'no_barangkeluar' => $value->no,
                'desc' => $value->description,
                'date' => date('d-m-Y',strtotime($value->date))
            );

            array_push($barangkeluar_results,$arrData);
        }

        return response()->json(['data'=>$barangkeluar_results,'department_id'=>$department_id]);
    }

    public function checkNoBarangKeluar(Request $request)
    {
    	$stat = false;
    	$results = [];
    	$id = $request->id;

    	$checking = Barangkeluar::find($id);
    	if($checking != null)
    	{
    		$stat = true;
    		$checkOnPengembalian = Pengembalianbarang::where('barangkeluar_id',$id)->get();

            //return count($checkOnPengembalian);
    		if(count($checkOnPengembalian) == 0)
    		{
    			foreach ($checking->barangkeluardetails as $key => $value) {
    			# code...
	    			$arrValue = array(
	    				'item_id' => $value->item_id,
	    				'warehouse'=>$value->warehouse->name,
	    				'warehouse_id' => $value->warehouse_id,
	    				'quantity_pinjam' => $value->quantity,
                        'quantity_kembali'=>$value->quantity,
	    				'item_name' => $value->item->name,
                        'satuan_name'=>is_null($value->satuan) ? '-' : $value->satuan->name,
                        'item_satuan_id'=>$value->item_satuan_id,
                        'awalan'=> true
	    			);

	    			array_push($results, $arrValue);
    			}
    			
    		}
    		else
    		{
    			foreach ($checking->barangkeluardetails as $key => $value) {
    				# code...
                    $quantity_kembali = PengembalianbarangDetail::where('barangkeluar_id',$id)->sum('quantity_kembali');
    				$arrValue = array(
    					'item_id' => $value->item_id,
	    				'warehouse'=> $value->warehouse->name,
	    				'warehouse_id' => $value->warehouse_id,//$value->warehouse_id,
	    				'quantity_pinjam' => $value->quantity,
                        'quantity_kembali'=>$quantity_kembali,
	    				'item_name' => $value->item->name,
                        'satuan_name'=>is_null($value->satuan) ? '-' : $value->satuan->name,
                        'item_satuan_id'=>$value->item_satuan_id,
                        'awalan'=>false
    				);
    				array_push($results, $arrValue);
    			}
    		}
 
    			
    	}

    	return response()->json(['stat'=>$stat,'results'=>$results,'id'=>$id]);
    }

    public function delete()
    {

    }

    public function details($idbarangkeluar)
    {
        $project = Project::find($request->session()->get('project_id'))->name;
        /*$getDatas = Pengembalianbarang::select('id','barangkeluar_id','item_satuan_id','item_id','created_at',DB::raw('sum(quantity_kembali) as total_kembali'))->groupBy('id','barangkeluar_id','item_id','item_satuan_id','created_at')->where('barangkeluar_id',$idbarangkeluar)->get();*/

        $getDatas = Pengembalianbarang::where('barangkeluar_id',$idbarangkeluar)->first();
        $lists = [];
        foreach ($getDatas->details as $key => $value) {
            # code...
            /*$quantity_pinjam = Pengembalianbarang::where([['barangkeluar_id','=',$value->barangkeluar_id],
                        ['item_id','=',$value->item_id],['status','=',null]])->first()->quantity_pinjam;*/

            $list = array(
                'id'=>$value->id,
                'barangkeluar_id'=>$value->barangkeluar_id,
                'item_name'=>$value->items->name,
                'no'=>$value->pengembalianbarang->Barangkeluar->no,
                'qty_pinjam'=>$value->pengembalianbarang->quantity_pinjam,
                'item_satuan'=>is_null($value->satuan) ? '-' : $value->satuan->name,
                'date'=>date('d-m-Y',strtotime($value->created_at)),
                'qty_kembali'=>$value->quantity_kembali);
            array_push($lists, $list);
        }
    	$barangkeluar = Barangkeluar::find($idbarangkeluar)->first();
    	return view('inventory::pengembalian_barang.details',compact('lists','barangkeluar','project'));
    }

    public function update(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = Pengembalianbarang::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
        
    }
}

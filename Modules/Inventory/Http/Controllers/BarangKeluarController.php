<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Permintaanbarang;
use Modules\Inventory\Entities\PermintaanbarangDetail;
use Modules\Inventory\Entities\Barangkeluar;
use Modules\Inventory\Entities\BarangkeluarDetail;
use Modules\Inventory\Entities\BarangkeluarDetailPrice;
use Modules\Inventory\Entities\Warehouse;
use Modules\Inventory\Entities\Inventory;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\ItemSatuan;
use Modules\Inventory\Entities\Barangmasuk;
use Modules\Inventory\Entities\Approval;
use Modules\Project\Entities\Project;
use Modules\Inventory\Entities\CreateDocument;
use datatables;
use PDF;
use DB;
use Auth;

class BarangKeluarController extends Controller
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
        $list_barang_keluars = [];
        $user = Auth::user();
        $status_sent = [];
        $is_sent = false;
        $project = Project::find($request->session()->get('project_id'));
        $permintaanbarang_id = $request->id;
        $permintaan = null;
        if($request->id != null)
        {
            $permintaan      = Permintaanbarang::find($permintaanbarang_id);
            $barang_keluars  = Barangkeluar::where('permintaanbarang_id',$permintaanbarang_id)->get();
            
            foreach ($barang_keluars as $key => $value) {
                # code...
                if($value->barangkeluardetails->count() > 0)
                {
                    foreach ($value->barangkeluardetails as $key => $each) {
                        # code...
                        if($each->is_sent)
                        {
                            array_push($status_sent, $value->id);
                        }
                    }
                }

                if(in_array($value->id, $status_sent))
                {
                    $is_sent = true;
                }
                
                $push_barang_keluar = array(
                    'id' => $value->id,
                    'permintaanbarang_id' => $value->permintaanbarang_id,
                    'no' => $value->no,
                    'confirmed_by_warehouseman'=>$value->confirmed_by_warehouseman,
                    'status_barang'=>$value->permintaanbarang->status_persetujuan,
                    'date' => $value->date,
                    'status_sent'=>$is_sent,
                    'detail_count' => $value->barangkeluardetails->count(),
                    'inventarisir_count' => $value->inventarisirs->count()
                );

                array_push($list_barang_keluars, $push_barang_keluar);
            }

        }
        else
        {
            $barang_keluars = Barangkeluar::all();
            foreach ($barang_keluars as $key => $value) {
                # code...
                if($value->barangkeluardetails->count() > 0)
                {
                    foreach ($value->barangkeluardetails as $key => $each) {
                        # code...
                        if($each->is_sent)
                        {
                            array_push($status_sent, $value->id);
                        }
                    }
                }

                if(in_array($value->id, $status_sent))
                {
                    $is_sent = true;
                }
                
                $push_barang_keluar = array(
                    'id' => $value->id,
                    'permintaanbarang_id' => $value->permintaanbarang->id,
                    'no' => $value->no,
                    'confirmed_by_warehouseman'=>$value->confirmed_by_warehouseman,
                    'status_barang'=>$value->permintaanbarang->status_persetujuan,
                    'date' => $value->date,
                    'status_sent'=>$is_sent,
                    'detail_count' => $value->barangkeluardetails->count(),
                    'inventarisir_count' => $value->inventarisirs->count()
                );

                array_push($list_barang_keluars, $push_barang_keluar);
            }
            //return redirect('/permintaan_barang/index');
        }

        $json_barang_keluars = json_encode($list_barang_keluars);
        return view('inventory::barang_keluar.index',compact('project', 'permintaan','json_barang_keluars','user'));
    }
    
    public function add(Request $request)
    {   
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $results = [];

        $permintaanbarang_id = $request->id;
        $permintaan   = Permintaanbarang::find($permintaanbarang_id);
       // return $results;
        $permintaanresults = array($permintaanbarang_id,$permintaan->no);

        return view('inventory::barang_keluar.add_form', compact('permintaanresults','project','user'));
    }

    public function getDataBarangKeluar($id)
    {
        $data = [];
        $results = ItemSatuan::select('item_satuans.name as satuan_name','cte.*','warehouses.name as gudang')
        ->join(DB::raw("((
            select pds.id as permintaan_details_id
            ,pds.permintaanbarang_id
            ,pds.item_id
            ,it.name as item_name,
            pds.item_satuan_id,
            inv.warehouse_id,
             (select konversi from item_satuans where id = pds.item_satuan_id and item_satuans.deleted_at is null) as nilai_konversi_permintaan,
            (pds.quantity) - (select COALESCE(sum(quantity),0) from barangkeluar_details bs where bs.permintaanbarang_detail_id = pds.id and bs.deleted_at is null) as total_minta,
            (select konversi from item_satuans where id = inv.item_satuan_id) as nilai_konversi_stock,
            sum(inv.quantity) as total_stock,
            ((sum(inv.quantity))*(select konversi from item_satuans where id = inv.item_satuan_id))-(select COALESCE(sum(quantity),0) from barangkeluar_details bs where bs.permintaanbarang_detail_id = pds.id and bs.deleted_at is null and bs.warehouse_id=inv.warehouse_id) as total_stock_after_konversi 
            from permintaanbarang_details pds 
            inner join inventories inv on pds.item_id = inv.item_id 
            inner join items it on pds.item_id = it.id 
            where inv.deleted_at is null and pds.deleted_at  is null group by pds.id,pds.permintaanbarang_id,pds.item_id,it.name,pds.item_satuan_id,inv.warehouse_id,pds.quantity,inv.item_satuan_id)) as cte"),
        'item_satuans.id','=','cte.item_satuan_id')
        ->join('warehouses','warehouses.id','=','cte.warehouse_id')
        ->where([['cte.permintaanbarang_id','=',$id],['cte.total_minta','>',0],['cte.total_stock_after_konversi','>',0]])->get();

        foreach ($results as $key => $value) {
            # code...
            $arr = array ('gudang'=>$value->gudang,
            'permintaan_details_id'=>$value->permintaan_details_id,
            'satuan_name'=>$value->satuan_name,
            'item_satuan_id'=>$value->item_satuan_id,
            'item_id'=>$value->item_id,
            'item_name'=>$value->item_name,
            'warehouse_id'=>$value->warehouse_id,
            'total_minta'=>$value->total_minta,
            'total_stock_after_konversi'=>number_format((float)$value->total_stock_after_konversi/$value->nilai_konversi_permintaan, 2, '.', ''));

            array_push($data,$arr);
        }

        return datatables()->of($data)->toJson();
    }
    
    public function addPost(Request $request)
    {
        $stat = false;
        $permintaanbarang_id = $request->permintaanbarang_id;
        $department_id =Permintaanbarang::find($permintaanbarang_id)->department_id;
        $description = $request->description;
        $date = $request->date;
        $execute = Barangkeluar::create([
                'permintaanbarang_id' => $permintaanbarang_id,
                'confirmed_by_warehouseman' => false,
                'confirmed_by_requester' => true,
                'description' => $description,
                'date' => $date,
                'no' => CreateDocument::createDocumentNumber('BK',$department_id,$request->session()->get('project_id'),Auth::user()->id)
            ]);
        if($execute)
        {
            $stat = true;
        }

        return response()->json(['stat'=>$stat,'id'=>$execute->id]);
    }

    public function edit(Request $request)
    {
        $barang_keluar  = Barangkeluar::find($request->id);
        $permintaan    = Permintaanbarang::find($barang_keluar->permintaanbarang_id);

        return view('barang_keluar.edit_form',compact('barang_keluar', 'permintaan'));
    }

    public function update(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = Barangkeluar::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }
        return response()->json(['return'=>$stat]);
    }

    public function delete(Request $request)
    {
        $barang_keluars                             = Barangkeluar::find($request->id);
        $status                                     = $barang_keluars->delete();
        $stat = false;
        if ($status) 
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function print(Request $request)
    {
        $id = $request->barang_keluar_id;
        $barangkeluar = Barangkeluar::find($id);
        $barangkeluardetails = BarangkeluarDetail::select('item_id','warehouse_id','item_satuan_id',DB::raw('sum(quantity) as quantity'))
        ->where('barangkeluar_id',$id)
        ->groupBy('item_id','warehouse_id','item_satuan_id')->get();
        //return view('barang_keluar.print',compact('barangkeluar'));     
        $pdf = PDF::loadView('inventory::barang_keluar.print',compact('barangkeluar','barangkeluardetails'))->setPaper('a4','potrait');
        return $pdf->stream('laporan_barang_keluar.pdf');
    }

    public function approve(Request $request)
    {
        $stat = false;
        $inventory ='';
        $id = $request->id;
        $permintaanbarang_id = $request->permintaan_barang_id;

        $approval = Approval::where('document_id',$id)->update(['approval_action_id'=>6]);
        if($approval)
        {
            $barangkeluar = Barangkeluar::find($id);
            foreach ($barangkeluar->barangkeluardetails as $key => $value) {
                # code...
                $inventory = Inventory::create([
                                'item_id' => $value->item_id,
                                //'rekanan_id' => null,
                                'warehouse_id' => $value->warehouse_id,
                                'sumber_id' => $value->id,
                                'sumber_type' => 'App\BarangkeluarDetail',
                                'date' => now(),
                                'quantity' =>(int)0-($value->quantity),
                                //'quantity_terpakai' => null,
                                'price' => ($value->price*$value->quantity),
                                'ppn' => 0
                            ]);
            }
            if($inventory)
            {
                $stat = true;

            }
            
        }

        return response()->json(['stat'=>$stat,'id'=>$permintaanbarang_id]);
    }

    public function checkQty(Request $request)
    {
        $warehouse_id = $request->warehouse_id;
        $item_id = $request->item_id;

        $checkQtyItem = Inventory::where([['warehouse_id','=',$warehouse_id],['item_id','=',$item_id]])->sum('quantity');

        return response()->json($checkQtyItem);
    }
}

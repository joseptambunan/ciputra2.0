<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Permintaanbarang;
use Modules\Inventory\Entities\PermintaanbarangDetail;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\Inventory;
use Modules\Project\Entities\Project;

use Modules\Inventory\Http\Requests\RequestPermintaanBarangDetail;
use Modules\Inventory\Http\Requests\RequestPermintaanBarangDetailItem;
use DB;

class PermintaanBarangDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function IsInvetarisasiSource()
    {
        $obj = ['1'=>'Yes','0'=>'No'];

        return response()->json($obj);
    }

    public function ItemSource()
    {
        $items = Item::all();
        $obj = [];
        foreach ($items as $key => $value) {
            # code...
            $obj[$value->id] = $value->name;
        }

        return response()->json($obj);
    }

    
    public function index(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        if($request->id <> null)
        {
            $permintaan = Permintaanbarang::find($request->id);
            $permintaan_barang_details    = $permintaan->details()->get();
        }
        else
        {
           return redirect('/permintaan_barang/index');
        }

        return view('inventory::permintaan_barang_detail.index', compact('permintaan', 'project','permintaan_barang_details','user'));
    }
    
    public function add(Request $request)
    {   
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        $permintaan    = Permintaanbarang::find($request->id);
        //foreach ($items as $key => $value) {
            # code...
            $items = Item::select('id','item_category_id','name','result.*')->leftJoin(DB::raw("((select it.name as satuan_name_terkecil,totaltbl.* from (select tbl1.*,tbl1.stock_afterkonversi - tbl2.sisabookingafterkonversi as stock_avaible from (select cte.item_id,sum(cte.stock_afterkonversi) as stock_afterkonversi,
cte.id_satuan_afterkonversi from (select inv.item_id,sum(inv.quantity) * itns.konversi as stock_afterkonversi,
itns.konversi as nilai_konversi,
            (select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id and st.deleted_at is null) and stn.item_id = inv.item_id and stn.deleted_at is null) as id_satuan_afterkonversi 
            from inventories inv  
            inner join item_satuans itns on inv.item_satuan_id = itns.id where inv.deleted_at is null group by inv.item_id,itns.konversi) as cte  
group by cte.item_id,cte.id_satuan_afterkonversi) as tbl1 
left join (select cte1.id_item, sum(cte1.sisabooking*itsn.konversi) as sisabookingafterkonversi from (select cte.id_item,
cte.id_satuan,
coalesce(sum(bd.quantity),0) as totalkeluar,
cte.totalminta - coalesce(sum(bd.quantity),0) as sisabooking 
from (select pd.item_id as id_item,
pd.item_satuan_id as id_satuan,
sum(pd.quantity) as totalminta,
sum(pd.quantity)*ts.konversi as total_afterkonversi
from 
permintaanbarang_details pd,item_satuans ts 
where pd.item_satuan_id = ts.id and pd.deleted_at is null
group by pd.item_id,pd.item_satuan_id,ts.konversi) as cte left join barangkeluar_details bd on cte.id_item = bd.item_id and cte.id_satuan = bd.item_satuan_id where bd.deleted_at is null group by cte.id_item,cte.id_satuan,cte.totalminta) as cte1 
inner join item_satuans itsn on cte1.id_satuan = itsn.id group by id_item) as tbl2 on tbl1.item_id = tbl2.id_item) as totaltbl, item_satuans it where totaltbl.id_satuan_afterkonversi = it.id)) as result"),'items.id','=','result.item_id')->get();


        return view('inventory::permintaan_barang_detail.add_form_detail', compact('project', 'permintaan', 'items','user'));
    }

    public function addPostItem(RequestPermintaanBarangDetailItem $request)
    {
        $stat = 0;
        $errMsg = '';

        $item_id = $request->item_id;
        $quantity = $request->quantity;
        $idx = $request->rowIdx;

        $checkInventory = Inventory::where('item_id','=',$item_id)->get();

        if(count($checkInventory) >0)
        {
            $getQuantity = $checkInventory->sum('quantity');
            if($getQuantity > $quantity)
            {
                $stat=1;
            }
            else
            {
                $errMsg = 'Kuantiti tidak mencukupi, Kuantiti saat ini = '.$getQuantity;
            }

        }
        else
        {
            $errMsg = 'Item barang tidak ditemukan pada inventory, silahkan lakukan pembelian';
        }

        return response()->json(['stat'=>$stat,'idx'=>$idx,'errMsg'=>$errMsg]);
    }
    
    public function addPost(RequestPermintaanBarangDetail $request)
    {
        $stat = 0;
        $action = '';
        $errMsg = '';
        $information_items =[];

        $permintaanbarang_id = $request->permintaanbarang_id;
        $getAllItem = json_decode($request->allItemStore);
        
        if(count($getAllItem) > 0)
        {
            for($counter =0;$counter < count($getAllItem);$counter++)
            {
                $action = PermintaanbarangDetail::create(
                    [
                        'permintaanbarang_id' => $permintaanbarang_id,
                        'item_id' => $getAllItem[$counter]->id_item,
                        'item_satuan_id'=> $getAllItem[$counter]->satuan_id,
                        'is_inventarisasi' => Permintaanbarang::find($permintaanbarang_id)->status_permintaan_id,
                        'quantity' => $getAllItem[$counter]->qty,
                        'butuh_date' => $getAllItem[$counter]->butuh_date,
                        'description' => $getAllItem[$counter]->description
                    ]
                );

                //check information
                $getItemQuantityStock = Inventory::where('item_id',$getAllItem[$counter]->id_item)->sum('quantity');
                $ItemName = Item::find($getAllItem[$counter]->id_item)->name;

                $arrayInformations = array(
                    'quantity' => $getItemQuantityStock,
                    'item_name' => $ItemName
                );
                array_push($information_items, $arrayInformations);
            }

            if($action)
            {
                $stat=1;
            }
        }
        
        return response()->json(['stat'=>$stat,'id'=>$permintaanbarang_id,'informations'=>$information_items]);
    }

    public function edit(Request $request)
    {
        $permintaan_barang_detail     = PermintaanbarangDetail::find($request->id);
        $permintaan                   = $permintaan_barang_detail->permintaanbarang;
        $items                        = Inventory::get();

        return view('permintaan_barang_detail.edit_form', compact('permintaan_barang_detail', 'permintaan', 'items'));
    }

    public function update(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = PermintaanbarangDetail::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
        
    }
    /*public function update(Request $request)
    {
        $permintaan_barang_detail                                      = PermintaanbarangDetail::find($request->id);
        $permintaan_barang_detail->permintaanbarang_id                 = $request->permintaanbarang_id;
        $permintaan_barang_detail->item_id                             = $request->item_id;
        $permintaan_barang_detail->quantity                            = $request->quantity;
        $permintaan_barang_detail->butuh_date                          = $request->butuh_date;
        $permintaan_barang_detail->description                         = $request->description;
        $permintaan_barang_detail->is_inventarisasi                    = $request->is_inventarisasi;
        $status                                                         = $permintaan_barang_detail->save();

        if($status)
        {
            return redirect($to = 'permintaan_barang_detail/index?id='.$permintaan_barang_detail->permintaanbarang_id, $status = 302, $headers = [], $secure = null);
        }
        else
        {
            return 'Failed';
        }
    }*/

    public function delete(Request $request)
    {
        $permintaan_barang_details                  = PermintaanbarangDetail::find($request->id);
        $status                                     = $permintaan_barang_details->delete();
        $stat = false;

        if ($status) 
        {
            $stat = true;
        }

        return response()->json($stat);
    }
}

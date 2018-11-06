<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Inventory;
use Modules\Inventory\Entities\PermintaanbarangDetail;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\ItemSatuan;
use Modules\Project\Entities\Project;
use datatables;
use DB;
use PDF;

class StockController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getStocks()
    {
        $results = [];
        $stocks = ItemSatuan::select('item_satuans.name as satuan_name','results.*')
        ->join(DB::raw("((select tbl1.*,tbl1.stock_afterkonversi - tbl2.sisabookingafterkonversi as stock_avaible from (select cte.item_id,cte.item_name,sum(cte.stock_afterkonversi) as stock_afterkonversi,cte.id_satuan_afterkonversi,ic.name as category from (select inv.item_id,itms.name as item_name,itms.item_category_id as id_category ,sum(inv.quantity) * itns.konversi as stock_afterkonversi,
            (select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id and st.deleted_at is null) and stn.item_id = inv.item_id and stn.deleted_at is null) as id_satuan_afterkonversi 
            from inventories inv  
            inner join item_satuans itns on inv.item_satuan_id = itns.id 
            inner join items itms on inv.item_id = itms.id where inv.deleted_at is null group by inv.item_id,itms.name,itns.konversi,itms.item_category_id) as cte inner join item_categories ic on cte.id_category = ic.id 
group by cte.item_id,cte.item_name,cte.id_satuan_afterkonversi,ic.name) as tbl1 
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
inner join item_satuans itsn on cte1.id_satuan = itsn.id group by id_item) as tbl2 on tbl1.item_id = tbl2.id_item)) as results"),'item_satuans.id','=','results.id_satuan_afterkonversi')->get();
        //Inventory::select('item_id',DB::raw('sum(quantity) as total_stock'))->groupBy('item_id')->get();
        foreach ($stocks as $key => $value) {
            # code...
            $listResults = array(
                'item_id'=>$value->item_id,
                'category' => $value->category,
                'item_name' => $value->item_name,
                'total_stock_onhand'=>number_format($value->stock_afterkonversi,2,".",","),
                'total_stock_avaible'=>is_null($value->stock_avaible) ? number_format($value->stock_afterkonversi,2,".",",") : number_format($value->stock_avaible,2,".",","),
                'satuan' =>$value->satuan_name,
            );

            array_push($results, $listResults);
        }

        return datatables()->of($results)->toJson();
    }

    public function viewStock(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        return view('inventory::stock_view.index',compact('project','user'));
    }

    public function detailsStock(Request $request,$id)
    {
        $project = Project::find($request->session()->get('project_id'));
        $user = \Auth::user();
        $stockResults = [];
        $arrsatuans = [];
        if($id > 0)
        {
            $item = Item::find($id);

            foreach ($item->satuans as $key => $value) {
                # code...
                $allsatuans = array(
                    'no' =>$key+1,
                    'satuan_name' => $value->name
                );
                array_push($arrsatuans, $allsatuans);
            }
            $results = array(
                'name' => $item->name,
                'item_category' => $item->category->name,
                'satuan_warning' => $item->satuan_warning,
                'stock_min' => $item->stock_min,
                'is_inventory' => $item->is_inventory,
                'is_consumable' => $item->is_consumable,
                'description' => $item->description,
                'default_warehouse' => is_null($item->warehouse) ? '' : $item->warehouse->name
            );
        }

        $booking = PermintaanbarangDetail::select('item_id',DB::raw('sum(quantity) as booking'))->where('item_id',$id)->groupBy('item_id')->first();

        $getItemStockByWarehouse =  Inventory::select('item_id','item_satuan_id','warehouse_id',DB::raw('sum(quantity) as total_stock'))->where('item_id',$id)->groupBy('item_id','warehouse_id','item_satuan_id')->get();

        foreach ($getItemStockByWarehouse as $key => $value) {
            # code...
            $sub_data = array(
                'warehouse_name'=> $value->warehouse->name,
                'total_stock' => $value->total_stock,
                'satuan' =>$value->satuan->name
            );

            array_push($stockResults, $sub_data);
        }
        
        $stockResults = json_encode($stockResults);
        $results = json_encode($results);
        $resultSatuans = json_encode($arrsatuans);
        return view('inventory::stock_view.details',compact('results','stockResults','resultSatuans','booking','project','user'));
       // return response()->json($results);
    }

    public function print()
    {
        $projectname = Project::find(session('project'))->name;
        $results = [];

        $stocks = ItemSatuan::select('item_satuans.name as name_satuan','results.*')
        ->join(DB::raw("((select tbl1.satuan_beforekonversi,tbl1.item_name,tbl1.stock_afterkonversi/tbl1.nilai_konv_inv as stock_afterkonversi,tbl1.id_satuan_afterkonversi,tbl1.category,
(tbl1.stock_afterkonversi - tbl2.sisabookingafterkonversi)/tbl1.nilai_konv_inv as stock_avaible from 
(select cte.nilai_konv_inv,cte.satuan_beforekonversi,cte.item_id,cte.item_name,sum(cte.stock_afterkonversi) as stock_afterkonversi,cte.id_satuan_afterkonversi,ic.name as category from 
(select itns.konversi as nilai_konv_inv,itns.name as satuan_beforekonversi,inv.item_id,itms.name as item_name,itms.item_category_id as id_category ,sum(inv.quantity) * itns.konversi as stock_afterkonversi,
            (select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id) and stn.item_id = inv.item_id) as id_satuan_afterkonversi 
            from inventories inv  
            inner join item_satuans itns on inv.item_satuan_id = itns.id 
            inner join items itms on inv.item_id = itms.id where inv.deleted_at is null group by itns.name,itns.konversi,inv.item_id,itms.name,itns.konversi,itms.item_category_id) as cte inner join item_categories ic on cte.id_category = ic.id 
group by cte.nilai_konv_inv,cte.satuan_beforekonversi,cte.item_id,cte.item_name,cte.id_satuan_afterkonversi,ic.name) as tbl1 
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
inner join item_satuans itsn on cte1.id_satuan = itsn.id group by id_item) as tbl2 on tbl1.item_id = tbl2.id_item)) as results"),'item_satuans.id','=','results.id_satuan_afterkonversi')->orderBy('category')->get();

        /*$stocks = ItemSatuan::select('item_satuans.name as name_satuan','results.*')
        ->join(DB::raw("((select ic.name as category_name,cte.* from (select itm.item_category_id,itm.name as item_name,(select itsn.id from item_satuans as itsn where itsn.konversi = (select min(ims.konversi) from item_satuans as ims where ims.item_id = itsn.item_id) and itsn.item_id = inv.item_id) as id_satuan_min,
sum(inv.quantity) as total_stock,
isn.name as satuan_name,
sum(inv.quantity)*isn.konversi as total_stock_konversi
from inventories inv, item_satuans isn,items itm where inv.item_satuan_id = isn.id and inv.item_id = itm.id group by itm.item_category_id,itm.name,isn.name,isn.konversi,inv.item_id) as cte,item_categories ic where cte.item_category_id = ic.id)) as results"),'item_satuans.id','=','results.id_satuan_min')->get();*/
        $pdf = PDF::loadView('stock_view.print',compact('stocks','projectname'))->setPaper('a4','potrait');
        return $pdf->stream('laporan_persediaan.pdf');
        //return view('stock_view.print',compact('stocks','projectname'));

    }

    public function printMinimumStock()
    {
        $projectname = Project::find(session('project'))->name;
        $results = [];
        $stocks = ItemSatuan::select('item_satuans.name as name_satuan','results.*')
        ->join(DB::raw("((select ic.name as category_name,cte.* from (select itm.item_category_id,itm.stock_min,itm.name as item_name,
(select itsn.id from item_satuans as itsn where itsn.konversi = (select min(ims.konversi) from item_satuans as ims where ims.item_id = itsn.item_id) and itsn.item_id = inv.item_id) as id_satuan_min,
sum(inv.quantity) as total_stock,
isn.name as satuan_name,
isn.konversi,
sum(inv.quantity)*isn.konversi as total_stock_konversi
from inventories inv, item_satuans isn,items itm where inv.item_satuan_id = isn.id and inv.item_id = itm.id group by itm.item_category_id,itm.stock_min,itm.name,isn.name,isn.konversi,inv.item_id,isn.konversi) as cte,item_categories ic where cte.item_category_id = ic.id)) as results"),'item_satuans.id','=','results.id_satuan_min')->get();

        $pdf = PDF::loadView('stock_view.print_stokminimum',compact('stocks','projectname'))->setPaper('a4','potrait');
        return $pdf->stream('laporan_stokminimum.pdf');
    }

    public function printInventoryTransaction(Request $request)
    {
        $projectname = Project::find(session('project'))->name;
        $query = ItemSatuan::select('item_satuans.name as name_satuan','results.*')
        ->join(DB::raw("((select 
    cte_masuk.item_name,
    cte_masuk.item_id,
    cte_masuk.id_satuan_afterkonversi,
    cte_masuk.total_masuk,
    coalesce(cte_keluar.total_keluar,0) as total_keluar,
    coalesce(cte_masuk.total_masuk-cte_keluar.total_keluar,cte_masuk.total_masuk) as saldo from 
(select 
    itms.name as item_name,
    inv.item_id,
    (select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id) and stn.item_id = inv.item_id) as id_satuan_afterkonversi,
    sum(inv.quantity*itns.konversi) as total_masuk 
    from inventories inv inner join item_satuans itns on inv.item_satuan_id = itns.id inner join items itms on inv.item_id = itms.id where sumber_type not like '%BarangkeluarDetail%' 
    group by itms.name,inv.item_id,itns.konversi order by inv.item_id) as cte_masuk 
left join (
select 
    inv.item_id,
    (select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id) and stn.item_id = inv.item_id) as id_satuan_afterkonversi,
    sum(quantity*itns.konversi *(-1)) as total_keluar 
    from inventories inv inner join item_satuans itns on inv.item_satuan_id = itns.id where  sumber_type like '%BarangkeluarDetail%' 
    group by inv.item_id,itns.konversi order by inv.item_id
) as cte_keluar on cte_masuk.item_id = cte_keluar.item_id and cte_masuk.id_satuan_afterkonversi = cte_keluar.id_satuan_afterkonversi 
group by cte_masuk.item_id,cte_masuk.item_name,cte_masuk.total_masuk,cte_keluar.total_keluar,cte_masuk.id_satuan_afterkonversi)) as results"),'item_satuans.id','=','results.id_satuan_afterkonversi')->get();
        $pdf = PDF::loadView('stock_view.printArusBarang',compact('query','projectname'))->setPaper('a4','potrait');
        return $pdf->stream('laporan_arusbarang.pdf');
        
    }

}

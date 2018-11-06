<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Entities\Inventory;
use Modules\Inventory\Entities\Pengembalianbarang;
use Modules\Inventory\Entities\PermintaanbarangDetail;
use Modules\Inventory\Entities\Permintaanbarang;
use Modules\Inventory\Entities\Barangkeluar;
use Modules\Inventory\Entities\BarangMasukHibah;
use Modules\Inventory\Entities\BarangMasukHibahDetail;
use Modules\Approval\Entities\Approval;
use Modules\Inventory\Entities\MutasiOut;
use Modules\Inventory\Entities\Asset;
use Modules\Inventory\Entities\MutasiIn;
use Modules\Inventory\Entities\ItemSatuan;
use Modules\Inventory\Entities\PengembalianbarangDetail;
//history
use Modules\Approval\Entities\HistoryApprovalPermintaanbarang;
use datatables;
use DB;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDataTables()
    {
        $inventories = Inventory::select('item_id','warehouse_id',DB::raw('sum(quantity) as total_quantity'))->groupBy('item_id','warehouse_id')->get();
        /*foreach ($inventories as $key => $value) {
            # code...
            $arrInventories = array(
                'item_id'
            );
        }*/

        return datatables()->of($inventories)->toJson();
    }

    public function approvalPermintaan(Request $request)
    {
        $stat = false;
        $permintaanbarang_id = $request->id;
        $item_id = $request->item_id;
        $item_satuan_id = $request->item_satuan_id;
        $stock_on_hand = $request->stock_on_hand;
        $quantity_butuh = $request->quantity_butuh;
        $stock_avaible = $request->stock_avaible;
        $tanggal_butuh = $request->tanggal_butuh;
        $updateApproval = Permintaanbarang::find($permintaanbarang_id)->update(['status_persetujuan'=>1]);

        if($updateApproval)
        {
            $insertHistory = HistoryApprovalPermintaanbarang::create(['permintaanbarang_id'=>$permintaanbarang_id,
                'item_id'=>$item_id,
                'item_satuan_id'=>$item_satuan_id,
                'stock_on_hand'=>$stock_on_hand,
                'quantity_butuh'=>$quantity_butuh,
                'stock_avaible'=>$stock_avaible,
                'tanggal_butuh'=>$tanggal_butuh]);

            if($insertHistory)
            {
                $stat = true;
            }
            
        }

        return response()->json($stat);
    }

    public function detailsPermintaan($id)
    {
        $permintaan = Permintaanbarang::find($id);
        $permintaan_barang_details = PermintaanbarangDetail::where('permintaanbarang_id',$id)->get();
        return view('inventory::hod_inventory.detailsPermintaanBarang',compact('permintaan','permintaan_barang_details'));
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

    public function daftarBarangKeluar()
    {
        return view('inventory::hod_inventory.daftar_barang_keluar');
    }

    public function approval_barangkeluar()
    {
        return view('inventory::hod_inventory.approval_barang_keluar');
    }

    public function getBarangSudahKeluar()
    {
        $results = [];
        $barangkeluars = Barangkeluar::all();

        foreach ($barangkeluars as $key => $value) {
            # code...
            $arrresults = array(
                'no'=>$key+1,
                'id'=>$value->id,
                'nomor_barangkeluar'=>$value->no,
                'nomor_permintaan' => $value->permintaanbarang->no,
                'confirm_by_requester'=> $value->confirmed_by_requester ? 'Sudah' : 'Belum',
                'confirm_by_warehouse'=> $value->confirmed_by_warehouseman ? 'Sudah' : 'Belum',
                'tangal_barang_keluar'=> date('d-m-Y',strtotime($value->date))
            );

            array_push($results, $arrresults);

        }

        return datatables()->of($results)->toJson();
    }

    public function getListApprovalBarangKeluar()
    {
        $lists = ItemSatuan::select('item_satuans.name as satuan_name','result.*')
        ->join(DB::raw("((select brk.tglkeluar,brk.item_name,brk.barangkeluar_id,brk.no,
brk.confirmed_by_warehouseman,
brk.total_barangkeluar_afterkonversi,
inven.stock_afterkonversi,
inven.stock_avaible-brk.total_barangkeluar_afterkonversi as stock_avaible,
brk.id_satuan_akhir 
from (select ps.date as tglkeluar,items.name as item_name,
            pd.barangkeluar_id,
            ps.no,
            ps.confirmed_by_warehouseman,
            pd.item_id,sum(pd.quantity) * stuan.konversi as total_barangkeluar_afterkonversi,
       (select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id and st.deleted_at is null) and stn.item_id = pd.item_id and stn.deleted_at is null) as id_satuan_akhir 
            from barangkeluar_details pd 
            inner join item_satuans stuan on pd.item_satuan_id = stuan.id 
            inner join items on pd.item_id = items.id 
            inner join barangkeluars ps on pd.barangkeluar_id = ps.id where pd.deleted_at is null and ps.deleted_at is null
            group by ps.confirmed_by_warehouseman,ps.no,items.name,ps.date ,pd.barangkeluar_id ,pd.item_id,stuan.konversi) as brk 
left join (select tbl1.*,tbl1.stock_afterkonversi - tbl2.sisabookingafterkonversi as stock_avaible from 
(select cte.item_id,cte.item_name
,sum(cte.stock_afterkonversi) as stock_afterkonversi
,cte.id_satuan_afterkonversi,ic.name as category from 
(select inv.item_id,itms.name as item_name,itms.item_category_id as id_category ,sum(inv.quantity) * itns.konversi as stock_afterkonversi,
(select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id and st.deleted_at is null) 
and stn.item_id = inv.item_id and stn.deleted_at is null) as id_satuan_afterkonversi 
            from inventories inv  
            inner join item_satuans itns on inv.item_satuan_id = itns.id 
            inner join items itms on inv.item_id = itms.id where inv.deleted_at is null 
            group by inv.item_id,itms.name,itns.konversi,itms.item_category_id) as cte inner join item_categories ic on cte.id_category = ic.id 
group by cte.item_id,cte.item_name,cte.id_satuan_afterkonversi,ic.name) as tbl1 
left join (select cte1.id_item, sum(cte1.sisabooking*itsn.konversi) as sisabookingafterkonversi from 
(select cte.id_item,
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
group by pd.item_id,pd.item_satuan_id,ts.konversi) as 
cte left join barangkeluar_details bd on cte.id_item = bd.item_id and cte.id_satuan = bd.item_satuan_id 
where bd.deleted_at is null group by cte.id_item,cte.id_satuan,cte.totalminta) as cte1 
inner join item_satuans itsn on cte1.id_satuan = itsn.id group by id_item) 
as tbl2 on tbl1.item_id = tbl2.id_item) as inven on brk.item_id = inven.item_id)) as result"),'item_satuans.id','=','result.id_satuan_akhir')
                ->where('result.confirmed_by_warehouseman',0)->get();

        return datatables()->of($lists)->toJson();
    }

    public function getDaftarBarangKeluar()
    {
        $lists = ItemSatuan::select('item_satuans.name as satuan_name','result.*')
        ->join(DB::raw("((select brk.tglkeluar,brk.item_name,brk.barangkeluar_id,brk.no,
brk.confirmed_by_warehouseman,
brk.total_barangkeluar_afterkonversi,
inven.stock_afterkonversi,
inven.stock_avaible,
brk.id_satuan_akhir 
from (select ps.date as tglkeluar,items.name as item_name,
            pd.barangkeluar_id,
            ps.no,
            ps.confirmed_by_warehouseman,
            pd.item_id,sum(pd.quantity) * stuan.konversi as total_barangkeluar_afterkonversi
            ,(select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) 
            from item_satuans st where st.item_id = stn.item_id and st.deleted_at is null) and stn.item_id = pd.item_id and stn.deleted_at is null) as id_satuan_akhir 
            from barangkeluar_details pd 
            inner join item_satuans stuan on pd.item_satuan_id = stuan.id 
            inner join items on pd.item_id = items.id 
            inner join barangkeluars ps on pd.barangkeluar_id = ps.id
            group by ps.confirmed_by_warehouseman,ps.no,items.name,ps.date ,pd.barangkeluar_id ,pd.item_id,stuan.konversi) as brk 
left join (select tbl1.*,tbl1.stock_afterkonversi - tbl2.sisabookingafterkonversi as stock_avaible from 
(select cte.item_id,cte.item_name
,sum(cte.stock_afterkonversi) as stock_afterkonversi
,cte.id_satuan_afterkonversi,ic.name as category from 
(select inv.item_id,itms.name as item_name,itms.item_category_id as id_category ,sum(inv.quantity) * itns.konversi as stock_afterkonversi,
(select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id and st.deleted_at is null) 
and stn.item_id = inv.item_id and stn.deleted_at is null) as id_satuan_afterkonversi 
            from inventories inv  
            inner join item_satuans itns on inv.item_satuan_id = itns.id 
            inner join items itms on inv.item_id = itms.id where inv.deleted_at is null 
            group by inv.item_id,itms.name,itns.konversi,itms.item_category_id) as cte inner join item_categories ic on cte.id_category = ic.id 
group by cte.item_id,cte.item_name,cte.id_satuan_afterkonversi,ic.name) as tbl1 
left join (select cte1.id_item, sum(cte1.sisabooking*itsn.konversi) as sisabookingafterkonversi from 
(select cte.id_item,
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
group by pd.item_id,pd.item_satuan_id,ts.konversi) as 
cte left join barangkeluar_details bd on cte.id_item = bd.item_id and cte.id_satuan = bd.item_satuan_id 
where bd.deleted_at is null group by cte.id_item,cte.id_satuan,cte.totalminta) as cte1 
inner join item_satuans itsn on cte1.id_satuan = itsn.id group by id_item) 
as tbl2 on tbl1.item_id = tbl2.id_item) as inven on brk.item_id = inven.item_id)) as result"),'item_satuans.id','=','result.id_satuan_akhir')
                ->where('result.confirmed_by_warehouseman',1)->get();

        return datatables()->of($lists)->toJson();
    }

    public function detailsBarangkeluar($id)
    {
        $barangkeluar = Barangkeluar::find($id)->first();
        $permintaanbarang_id = $barangkeluar->permintaanbarang_id;
        $permintaan = Permintaanbarang::find($permintaanbarang_id)->first();
        return view('inventory::hod_inventory.details_barang_keluar',compact('barangkeluar','permintaan'));
    }

    public function approveBarangKeluar(Request $request)
    {
        $stat =0 ;
        $barangkeluar_id = $request->id;
        $execute = Barangkeluar::find($barangkeluar_id)->update(['confirmed_by_warehouseman' => true]);        

        if($execute)
        {
            $getBarangKeluar = Barangkeluar::find($barangkeluar_id);
            foreach ($getBarangKeluar->barangkeluardetails as $key => $value) {
                # code...
                $action = Inventory::create([
                    'item_id'=> $value->item_id,
                    'sumber_id' => $value->id,
                    'sumber_type' => 'App\BarangkeluarDetail',
                    'warehouse_id' => $value->warehouse_id,
                    'quantity' => 0-$value->quantity,
                    'item_satuan_id'=>$value->item_satuan_id,
                    'date'=>date('Y-m-d'),
                    'description'=>'barang keluar'
                ]);

            }
            if($action)
            {
                $stat = 1;
            }
        }

        return response()->json($stat);
    }

    public function daftar_barangmasukHibah()
    {
        return view('inventory::hod_inventory.daftar_barang_masuk_hibah');
    }

    public function getDaftarBarangMasukHibah()
    {
        $getHeader = BarangMasukHibah::where('status',2)->get();
        $arrHearBarangMasuk =[];
        $no =0;
        foreach ($getHeader as $key => $value) {
            # code...
            $no+=1;
            $total_acuan = $value->details->where('status',1)->sum('quantity_acuan');
            $total_diisi = $value->details->where('status','<>',1)->sum('quantity');
            $reject = $value->details->where('status','<>',1)->sum('quantity_reject');
            $arrGetHeader = array(
                'nomor' =>$no,
                'id'=> $value->id,
                /*'from_project_id' => $value->from_project_id,
                'from_pt_id'=>$value->from_pt_id,
                'to_project_id'=>$value->to_project_id,
                'to_pt_id'=>$value->to_pt_id,*/
                'from_project_name'=>is_null($value->from_project) ? $value->from_project_id : $value->from_project->name,
                'from_pt_name'=> is_null($value->from_pt) ? $value->from_pt_id : $value->from_pt->name,
                'to_project_name'=>$value->to_project->name,
                'to_pt_name'=>$value->to_pt->name,
                'tanggal_hibah'=>date('d-m-Y',strtotime($value->tanggal_hibah)),
                'no'=>$value->no,
                'description'=>$value->description,
                'total' => $total_acuan,
                'diisi' => $total_diisi,
                'reject'=>$reject,
                'selisih' => $total_acuan-($total_diisi+$reject),
                'status'=>$value->status
            );

            array_push($arrHearBarangMasuk, $arrGetHeader);
        }

        return datatables()->of($arrHearBarangMasuk)->toJson();
    }

    public function barangmasuk_approve(Request $request)
    {
        $boolRet = false;
        $execute_inventory ='';
        $id = $request->id;
        $objBarangMasukHibah = BarangMasukHibah::find($id);

        $action = $objBarangMasukHibah->update(
            ['status'=>2]
        );
        $details =$objBarangMasukHibah->details->where('status','<>',1);
        if($action)
        {
            //add to inventory
            foreach ($details as $key => $value) {
                # code...
                $execute_inventory = Inventory::create([
                    'item_id'=> $value->item_id,
                    'warehouse_id'=>$value->warehouse_id,
                    'sumber_id'=> $value->id,
                    'sumber_type'=>'Modules\Inventory\Entities\BarangMasukHibahDetail',
                    'date' => date('Y-m-d'),
                    'quantity'=>$value->quantity,
                    'item_satuan_id'=>$value->item_satuan_id,
                    'price'=>$value->price,
                    'description'=>$value->description
                ]);
            }
            if($execute_inventory)
            {
                $boolRet = true;
            }
        }

        return response()->json(['return'=>$boolRet]);
    }

    public function barangmasuk_unapprove(Request $request)
    {
        $boolRet = false;
        $id = $request->id;
        $objBarangMasukHibah =BarangMasukHibah::find($id);
        $action = $objBarangMasukHibah->update(
            ['status'=>0]
        );
        if($action)
        {
            foreach ($objBarangMasukHibah->details as $key => $value) {
                # code...
                $deleteInventory = Inventory::where(
                    [
                        ['sumber_type','=','App\BarangMasukHibahDetail'],
                        ['sumber_id','=',$value->id]
                    ]
                )->delete();
            }
            if(isset($deleteInventory) && $deleteInventory)
            {
                $boolRet = true;
            }
        }
        return response()->json(['return'=>$boolRet]);
    }

    public function barangmasuk_hibah_details($id)
    {
        $BarangMasukHibah = BarangMasukHibah::find($id);
        $buttonApprove ="<button class='approve btn btn-success btn-xs'>Approved</button>";
        $buttonOpen ="<button class='unapprove btn btn-info btn-xs'>Open</button>";
        return view('inventory::hod_inventory.barangmasuk_hibah_details',compact('BarangMasukHibah','buttonApprove','buttonOpen'));
    }

    //pengembalian barang
    public function DaftarPengembalianBarang()
    {
        return view('inventory::hod_inventory.daftar_pengembalianbarang');
    }

    public function getDaftarPengembalianbarang()
    {
        $arrdata = [];
        $getDatas = PengembalianbarangDetail::select('id','pengembalianbarang_id','item_satuan_id','item_id',DB::raw('sum(quantity_kembali) as total_kembali'))->groupBy('id','pengembalianbarang_id','item_id','item_satuan_id')->where('approval_status',1)->get();

        foreach ($getDatas as $key => $value) {
            # code...
            /*$quantity_pinjam = Pengembalianbarang::where([['barangkeluar_id','=',$value->barangkeluar_id],
                        ['item_id','=',$value->item_id],['status','=',null]])->first()->quantity_pinjam;*/
            $list = array('nomor'=>$key+1,
                'id'=>$value->id,
                'barangkeluar_id'=>$value->pengembalianbarang->barangkeluar_id,
                'item_name'=>$value->items->name,
                'no'=>$value->pengembalianbarang->barangkeluar->no,
                'qty_pinjam'=>$value->pengembalianbarang->quantity_pinjam,
                'item_satuan'=>is_null($value->satuan) ? '-' : $value->satuan->name,
                'qty_kembali'=>$value->total_kembali);

            array_push($arrdata, $list);
        }

        return datatables()->of($arrdata)->toJson();

    }
    public function approval_pengembalianbarang()
    {
        return view('inventory::hod_inventory.approval_pengembalian_barang');
    }
    public function getListApprovalPengembalianbarang()
    {
        $arrdata = [];
        $getDatas=PengembalianbarangDetail::where('approval_status',null)->get();
        foreach ($getDatas as $key => $value) {
            # code...
            $list = array('nomor'=>$key+1,
            'nomor_pengembalian'=>$value->pengembalianbarang->no,
            'id'=>$value->id,
            'barangkeluar_id'=>$value->pengembalianbarang->barangkeluar_id,
            'item_name'=>$value->items->name,
            'no'=>is_null($value->pengembalianbarang->Barangkeluar) ? '----' : $value->pengembalianbarang->Barangkeluar->no,
            'qty_pinjam'=>$value->pengembalianbarang->quantity_pinjam,
            'item_satuan'=>is_null($value->satuan) ? '-' : $value->satuan->name,
            'qty_kembali'=>$value->quantity_kembali
        );

            array_push($arrdata, $list);
        }
        return datatables()->of($arrdata)->toJson();

    }

    public function approvePengembalianBarang(Request $request)
    {
        $stat = false;
        $id = $request->id;
        $pengembalian = PengembalianbarangDetail::find($id);
        $update = $pengembalian->update(['approval_status'=>1]);
        if($update)
        {
            $createInventory = Inventory::create([
                'item_id'=>$pengembalian->item_id,
                //'rekanan_id',
                'warehouse_id'=>$pengembalian->warehouse_id,
                'sumber_id'=>$pengembalian->id,
                'sumber_type'=>'App\PengembalianbarangDetail',
                'item_satuan_id'=>$pengembalian->item_satuan_id,
                'date'=>date('Y-m-d'),
                'quantity'=>$pengembalian->quantity_kembali,
                //'quantity_terpakai',
                //'price',
                'description'=>'Pengembalianbarang'
            ]);

            if($createInventory)
            {
                $stat = true;
            }
        }

        return response()->json($stat);

    }

    public function daftar_pengembalianbarang()
    {
        return view('inventory::hod_inventory.daftar_pengembalian_barang');
    }

    //approval permintaan barang
    public function approval_permintaan()
    {
        return view('inventory::hod_inventory.approval_permintaanbarang');
    }

    public function getListApprovalPermintaanbarang(Request $request)
    {
        $lists = ItemSatuan::select('item_satuans.name as satuan_name','result.*')
        ->join(DB::raw("((select tblminta.butuh_date,tblminta.item_id,tblminta.item_name,tblminta.permintaanbarang_id,tblminta.no,tblminta.status_persetujuan,
tblminta.total_permintaan_afterkonversi,
tblminta.id_satuan_akhir,
tblstock.stock_afterkonversi,
tblstock.stock_avaible from (select pd.butuh_date,items.name as item_name,
            pd.permintaanbarang_id,
            ps.no,
            ps.status_persetujuan,
            pd.item_id,
    sum(pd.quantity) * stuan.konversi as total_permintaan_afterkonversi
            ,(select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id and st.deleted_at is null) and stn.item_id = pd.item_id and stn.deleted_at is null) as id_satuan_akhir 
            from permintaanbarang_details pd 
            inner join item_satuans stuan on pd.item_satuan_id = stuan.id 
            inner join items on pd.item_id = items.id 
            inner join permintaanbarangs ps on pd.permintaanbarang_id = ps.id where pd.deleted_at is null and ps.confirm_by_requester = 1 and ps.status_persetujuan is null
            group by ps.status_persetujuan,ps.no,items.name,pd.butuh_date ,pd.permintaanbarang_id ,pd.item_id,stuan.konversi) as tblminta left join 

(select tbl1.*,tbl1.stock_afterkonversi - tbl2.sisabookingafterkonversi as stock_avaible from (select cte.item_id,cte.item_name,sum(cte.stock_afterkonversi) as stock_afterkonversi,cte.id_satuan_afterkonversi,ic.name as category from (select inv.item_id,itms.name as item_name,itms.item_category_id as id_category ,sum(inv.quantity) * itns.konversi as stock_afterkonversi,
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
inner join item_satuans itsn on cte1.id_satuan = itsn.id group by id_item) as tbl2 on tbl1.item_id = tbl2.id_item) as tblstock on tblminta.item_id = tblstock.item_id)) as result"),'item_satuans.id','=','result.id_satuan_akhir')->get();

        return datatables()->of($lists)->toJson();
    }

    public function getListPermintaan()
    {
        /*$lists = ItemSatuan::select('item_satuans.name as satuan_name','result.*')
        ->join(DB::raw("((select tblminta.butuh_date,tblminta.item_name,tblminta.permintaanbarang_id,tblminta.no,tblminta.status_persetujuan,
tblminta.total_permintaan_afterkonversi,
tblminta.id_satuan_akhir,
tblstock.stock_afterkonversi,
tblstock.stock_avaible from (select pd.butuh_date,items.name as item_name,
            pd.permintaanbarang_id,
            ps.no,
            ps.status_persetujuan,
            pd.item_id,
    sum(pd.quantity) * stuan.konversi as total_permintaan_afterkonversi
            ,(select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id) and stn.item_id = pd.item_id) as id_satuan_akhir 
            from permintaanbarang_details pd 
            inner join item_satuans stuan on pd.item_satuan_id = stuan.id 
            inner join items on pd.item_id = items.id 
            inner join permintaanbarangs ps on pd.permintaanbarang_id = ps.id where pd.deleted_at is null 
            group by ps.status_persetujuan,ps.no,items.name,pd.butuh_date ,pd.permintaanbarang_id ,pd.item_id,stuan.konversi) as tblminta left join 

(select tbl1.*,tbl1.stock_afterkonversi - tbl2.sisabookingafterkonversi as stock_avaible from (select cte.item_id,cte.item_name,sum(cte.stock_afterkonversi) as stock_afterkonversi,cte.id_satuan_afterkonversi,ic.name as category from (select inv.item_id,itms.name as item_name,itms.item_category_id as id_category ,sum(inv.quantity) * itns.konversi as stock_afterkonversi,
            (select stn.id from item_satuans stn where stn.konversi = (select min(st.konversi) from item_satuans st where st.item_id = stn.item_id) and stn.item_id = inv.item_id) as id_satuan_afterkonversi 
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
inner join item_satuans itsn on cte1.id_satuan = itsn.id group by id_item) as tbl2 on tbl1.item_id = tbl2.id_item) as tblstock on tblminta.item_id = tblstock.item_id)) as result"),'item_satuans.id','=','result.id_satuan_akhir')
            ->join('approvals',function($join){ 
                    $join->on('result.permintaanbarang_id','=','approvals.document_id');
                })
                ->where([
                ['approvals.document_type','=','App\Permintaanbarang'],
                ['approvals.approval_action_id','=',6],
                ['result.status_persetujuan','=',1]
            ])->get();*/
        $lists = [];
        $getHistory = HistoryApprovalPermintaanbarang::all();
        foreach ($getHistory as $key => $value) {
            # code...
            $arr = array(
                'no'=>is_null($value->permintaan) ? 'kosong' : $value->permintaan->no,
                'item_name'=>is_null($value->item) ? 'kosong' : $value->item->name,
                'permintaanbarang_id'=>$value->permintaanbarang_id,
                'butuh_date'=>$value->tanggal_butuh,
                'qty_butuh'=>$value->quantity_butuh,
                'stock_on_hand'=>$value->stock_on_hand,
                'stock_avaible'=>$value->stock_avaible,
                'satuan_name'=>is_null($value->satuan) ? 'kosong' : $value->satuan->name
            );

            array_push($lists, $arr);
        }

        return datatables()->of($lists)->toJson();
    }
    public function daftar_permintaanbarang()
    {
        return view('inventory::hod_inventory.daftar_permintaanbarang');
    }

    public function approval_barangmasuk()
    {

        return view('inventory::hod_inventory.approval_barang_masuk');
    }

    public function getListApprovalBarangMasuk(Request $request)
    {
        $getHeader = BarangMasukHibah::where('status',1)->get();
        $arrHearBarangMasuk =[];
        $no =0;
        foreach ($getHeader as $key => $value) {
            # code...
            $no+=1;
            $total_acuan = $value->details->where('status',1)->sum('quantity_acuan');
            $total_diisi = $value->details->where('status','<>',1)->sum('quantity');
            $reject = $value->details->where('status','<>',1)->sum('quantity_reject');
            $arrGetHeader = array(
                'nomor' =>$no,
                'id'=> $value->id,
                /*'from_project_id' => $value->from_project_id,
                'from_pt_id'=>$value->from_pt_id,
                'to_project_id'=>$value->to_project_id,
                'to_pt_id'=>$value->to_pt_id,*/
                'from_project_name'=>is_null($value->from_project) ? $value->from_project_id : $value->from_project->name,
                'from_pt_name'=> is_null($value->from_pt) ? $value->from_pt_id : $value->from_pt->name,
                'to_project_name'=>$value->to_project->name,
                'to_pt_name'=>$value->to_pt->name,
                'tanggal_hibah'=>date('d-m-Y',strtotime($value->tanggal_hibah)),
                'no'=>$value->no,
                'description'=>$value->description,
                'total' => $total_acuan,
                'diisi' => $total_diisi,
                'reject'=>$reject,
                'selisih' => $total_acuan-($total_diisi+$reject),
                'status'=>$value->status
            );

            array_push($arrHearBarangMasuk, $arrGetHeader);
        }

        return datatables()->of($arrHearBarangMasuk)->toJson();
    }

    public function approveMutasiOut(Request $request)
    {
        $stat = false;
        $MutasiOutId = $request->id;
        $MutasiOut = MutasiOut::find($MutasiOutId);
        $confirmed = $MutasiOut->update(['confirm_by_warehouseman'=>1]);
        if($confirmed)
        {
            if($MutasiOut->is_inventory)
            {
                $actionInventory = Inventory::create(['item_id'=>$MutasiOut->item_id,
                        'warehouse_id'=>$MutasiOut->id_destination,
                        'sumber_id'=>$MutasiOut->id,
                        'sumber_type'=>'App\MutasiOut',
                        'item_satuan_id'=>$MutasiOut->item_satuan_id,
                        'date'=>date('Y-m-d'),
                        'quantity'=>1,
                        'description'=>'labeled'
                    ]);
                if($actionInventory)
                {
                    //$stat = true;
                    //delete from asset
                    $deleteAsset = Asset::find($MutasiOut->asset_id)->delete();
                    if($deleteAsset)
                    {
                        $stat = true;
                    }

                }
            }
            else
            {
                $stat = true;
            }
            
        }

        return response()->json($stat);


    }

    public function approvalMutasiOut()
    {

        return view('inventory::hod_inventory.approval_mutasi_out');
    }

    public function getListApprovalMutasiOut(Request $request)
    {
        $results = [];
        $getLists = MutasiOut::where('confirm_by_warehouseman',0)->get();

        foreach ($getLists as $key => $value) {
            # code...
            $arr = array(
                'id'=>$value->id,
                'item_name'=>$value->item->name,
                'barcode'=>$value->barcode,
                'destination'=>is_null($value->destination) ? $value->warehouse->name : $value->destination,
                'pic_recipient'=>$value->pic_recipient,
                'pic_giver'=>$value->name_pic_giver,
                'date'=>date('d-m-Y',strtotime($value->created_at))
            );

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();

    }

    public function daftarMutasiOut()
    {
        return view('inventory::hod_inventory.daftar_mutasi_out');
    }

    public function getListMutasiOut()
    {
        $results = [];
        $getLists = MutasiOut::where('confirm_by_warehouseman',1)->get();

        foreach ($getLists as $key => $value) {
            # code...
            $arr = array(
                'id'=>$value->id,
                'item_name'=>$value->item->name,
                'barcode'=>$value->barcode,
                'destination'=>is_null($value->destination) ? $value->warehouse->name : $value->destination,
                'pic_recipient'=>$value->pic_recipient,
                'pic_giver'=>$value->name_pic_giver,
                'date'=>date('d-m-Y',strtotime($value->created_at))
            );

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();
    }

    public function approvalMutasiIn()
    {
        return view('inventory::hod_inventory.approval_mutasi_in');
    }

    public function getApprovalMutasiIn(Request $request)
    {
        $lists = MutasiIn::where('confirm_by_warehouseman',0)->get();
        $is_from = '';
        $source ='';
        $results = [];
        foreach ($lists as $key => $value) {
            # code...
            if($value->is_from_employee)
            {
                $is_from = 'Individu';
                $source =is_null($value->user_giver) ? $value->name_pic_giver : $value->user_giver->user_name;
            }
            else if($value->is_from_rekanan)
            {
                $is_from = 'Rekanan';
                $source = $value->source_rekanan->name;

            }
            else if($value->is_from_project)
            {
                $is_from = "Proyek";
                $source = $value->source_project->name;
            }
            else
            {
                $is_from = "Pihak Luar";
                $source = $value->source_other->name;
            }
            $arr = [
                'is_from'=>$is_from,
                'id'=>$value->id,
                'source'=>$source,
                'item_name'=>is_null($value->item) ? $value->item_tidak_terdefinisi : $value->item->name,
                'qty'=>$value->qty,
                'giver'=>is_null($value->user_giver) ? $value->name_pic_giver : $value->user_giver->user_name,
                'recipient'=>is_null($value->user_recipient) ? $value->pic_recipient : $value->user_recipient->user_name,
                'satuan'=>is_null($value->satuan) ? $value->satuan_item_tidak_terdefinisi : $value->satuan->name,
                'date'=>date('d-m-Y',strtotime($value->created_at))
            ];

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();
    }

    public function approveMutasiIn(Request $request)
    {
        $id = $request->id;
        $stat = false;
        $approved = MutasiIn::find($id)->update(['confirm_by_warehouseman'=>1]);
        if($approved)
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function daftarMutasiIn()
    {

        return view('inventory::hod_inventory.daftar_mutasi_in');
    }

    public function getDaftarMutasiIn()
    {
        $lists = MutasiIn::where('confirm_by_warehouseman',1)->get();
        $results = [];

        foreach ($lists as $key => $value) {
            # code...
            $arr = array(
                'item_name'=>is_null($value->item) ? '-' : $value->item->name,
                'qty'=>$value->qty,
                'satuan_name'=>is_null($value->satuan) ?  '-' : $value->satuan->name,
                'pic_giver' => is_null($value->user_giver) ? $value->name_pic_giver : $value->user_giver->user_name,
                'pic_recipient'=>is_null($value->user_recipient) ? $value->pic_recipient : $value->user_recipient->user_name,
                'source' => is_null($value->source_giver) ? $value->source : $value->source_giver->member_name
            );

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();
    }

    public function getDataDetailsBarangMasukHibah($id)
    {
        /*$getDetails = DB::select(DB::raw("
            select item_satuans.name as item_satuan,items.name as item_name,warehouses.name as warehouse_name,barang_masuk_hibah_id,warehouse_id,barang_masuk_hibah_details.item_id as id_item,item_satuan_id,sum(quantity) as total_diisi,quantity_acuan,quantity_reject,price from barang_masuk_hibah_details,items,warehouses,item_satuans where barang_masuk_hibah_details.item_id = items.id and barang_masuk_hibah_details.warehouse_id =warehouses.id and barang_masuk_hibah_details.item_satuan_id = item_satuans.id group by barang_masuk_hibah_id,warehouse_id,barang_masuk_hibah_details.item_id,item_satuan_id,quantity_acuan,price,items.name,warehouses.name,item_satuans.name,quantity_reject order by items.name"
        ))->where('barang_masuk_hibah_details.barangmasuk_hibah_id',$id);*/
        $getDetails = ItemSatuan::select('item_satuans.name as item_satuan','result.*')->
        join(DB::raw("((select items.name as item_name,warehouses.name as warehouse_name,barang_masuk_hibah_id,warehouse_id,barang_masuk_hibah_details.item_id,item_satuan_id,sum(quantity) as total_diisi,quantity_acuan,sum(quantity_reject) as quantity_reject,price from barang_masuk_hibah_details,items,warehouses where barang_masuk_hibah_details.item_id = items.id and warehouses.id = barang_masuk_hibah_details.warehouse_id group by barang_masuk_hibah_id,warehouse_id,barang_masuk_hibah_details.item_id,item_satuan_id,quantity_acuan,price,items.name,warehouses.name)) as result"),'item_satuans.id','=','result.item_satuan_id')
        ->where('result.barang_masuk_hibah_id',$id)->get();

        /*$getDetails = BarangMasukHibah::find($id)->details;*/
        $results =[];
        foreach ($getDetails as $key => $value) {
            # code...
            $arrdata = [
                'nomor' => $key+1,
                'warehouse_id' => $value->warehouse_id,
                'warehouse_name' =>$value->warehouse_name,
                'item_id' => $value->item_id,
                'item_name'=>$value->item_name,
                'item_satuan'=> $value->item_satuan,
                'item_satuan_id' => $value->item_satuan_id,
                'quantity_acuan' => $value->quantity_acuan,
                'quantity_sisa'=>$value->quantity_acuan - ($value->total_diisi+$value->quantity_reject),
                'quantity_reject'=>is_null($value->quantity_reject) ? 0 : $value->quantity_reject,
                'quantity' => $value->total_diisi,
                'price' => number_format($value->price,2,".",","),
                'total' => number_format($value->price*$value->total_diisi,2,".",",")
            ];

            array_push($results,$arrdata);
        }

        return datatables()->of($results)->toJson();
    }

    public function barangmasuk_hibah_details_items($barangmasukhibah_id,$warehouse_id,$item_id,$item_satuan_id)
    {
        $BarangMasukHibah = BarangMasukHibah::find($barangmasukhibah_id);
        $detailsbarangmasuk = BarangMasukHibahDetail::where([
            ['barang_masuk_hibah_id','=',$barangmasukhibah_id],
            ['warehouse_id','=',$warehouse_id],
            ['item_id','=',$item_id],
            ['item_satuan_id','=',$item_satuan_id],
            ['status','=',null]
        ])->orderBy('created_at','DESC')->get();
        return view('inventory::hod_inventory.details_per_item_barangmasukhibah',compact('BarangMasukHibah','detailsbarangmasuk'));
    }

    public function undeliveredBarangMasuk(Request $request)
    {
        $boolRet = false;
        $id = $request->id;
        $objBarangMasukHibah =BarangMasukHibah::find($id);
        $action = $objBarangMasukHibah->update(
            ['status'=>0]
        );

        if($action)
        {
            $boolRet = true;
        }

        return response()->json($boolRet);
    }
}

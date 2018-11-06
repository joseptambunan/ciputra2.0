<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Http\Requests\RequestBarangMasukHibah;
use Modules\Inventory\Http\Requests\RequestItemBarangMasukHibah;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\ItemSatuan;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectPtUser;
use Modules\Pt\Entities\Pt;
use Modules\Inventory\Entities\BarangMasukHibah;
use Modules\Inventory\Entities\BarangMasukHibahDetail;
use Modules\Department\Entities\Department;
use Modules\User\Entities\User;
use Modules\Inventory\Entities\Warehouse;
use Modules\Inventory\Entities\CreateDocument;
use datatables;
use DB;
use PDF;
use Auth;
class BarangMasukHibahController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $user_id = Auth::user()->id;
        $pt = ProjectPtUser::where('user_id',$user_id)->first()->pt->name;

        return view('inventory::barangmasuk_hibah.index',compact('project','pt','user'));
    }

    public function warehouseSource()
    {
        $warehouses = Warehouse::select('id','name')->get();
        $obj = [];
        foreach ($warehouses as $key => $value) {
            # code...
            $obj[$value->id] = $value->name;
        }
        return response()->json($obj);
    }

    public function satuanSource()
    {
        $itemSatuans = ItemSatuan::select('id','name')->get();
        $obj = [];
        foreach ($itemSatuans as $key => $value) {
            # code...
            $obj[$value->id] = $value->name;
        }
        return response()->json($obj);
    }

    public function projectSource()
    {
        $projects = Project::select('id','name')->get();
        $obj = [];
        foreach ($projects as $key => $value) {
            # code...
            $obj[$value->id] = $value->name;
        }
        return response()->json($obj);
    }

    public function ptSource()
    {
        $pts = Pt::select('id','name')->get();
        $retObj = [];
        foreach ($pts as $key => $value) {
            # code...
            $retObj[$value->id] = $value->name;
        }

        return response()->json($retObj);
    }

    public function addHeader()
    {
        return view('inventory::barangmasuk_hibah.add_connect_form');
    }

    public function add(Request $request)
    {
        $wareHouses = Warehouse::all();
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $items = Item::all();
        return view('inventory::barangmasuk_hibah.add_form_header', compact('items','wareHouses','project','user'));
    }

    public function addDetails(Request $request,$id_barangmasukhibah)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $BarangMasukHibah = BarangMasukHibah::find($id_barangmasukhibah);
        $Details = $BarangMasukHibah->details->where('status',0);
        $wareHouses = Warehouse::all();
    	$itemsSatuan = ItemSatuan::all();
    	$items = Item::all();
        return view('inventory::barangmasuk_hibah.add_details_form', compact('itemsSatuan', 'items','wareHouses','BarangMasukHibah','Details','project','user'));
    }

    public function changeSatuan(Request $request)
    {
		$term = $request->get('term');
		$results = array();
		$queries = ItemSatuan::where('item_id',$term)->get();
        /*if(count($queries) > 0)
        {
            $results['id'] = $queries->id;
            $results['name'] = $queries->name;
        }*/
        
		return response()->json($queries);
    }

    /*public function storeHeader(RequestBarangMasukHibah $request)
    {
        $stat = 0;

        $from_project_id = $request->mfrom_project_id;
        $from_pt_id = $request->mfrom_pt_id;
        if($from_pt_id == null)
        {
            $from_pt_id = $request->from_pt_id;
        }
        $to_project_id = $request->session()->get('project_id');
        $to_pt_id =  User::find(\Auth::user()->id)->project_pt_users->where('project_id',$to_project_id)->first()->pt_id;
        $no = \Document::new_number('BM', Department::where('code','HRD')->first()->id);
        $tanggal_hibah = $request->tanggal_hibah;
        $description = $request->description;
        $no_refrensi = $request->no_refrensi;
        $quantity_acuan = $request->quantity_acuan;
        $executeBarangMasukHibah = BarangMasukHibah::create(
                                    [
                                        'from_project_id'=>$from_project_id,
                                        'from_pt_id'=>$from_pt_id,
                                        'to_project_id'=>$to_project_id,
                                        'to_pt_id'=>$to_pt_id,
                                        'tanggal_hibah'=>$tanggal_hibah,
                                        'status' => 0,
                                        'no'=>$no,
                                        'no_refrensi'=>$no_refrensi,
                                        'quantity_acuan'=>$quantity_acuan,
                                        'description'=>$description
                                    ]);
        if($executeBarangMasukHibah)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat,'id'=>$executeBarangMasukHibah->id]);
    }*/

    public function addItem(RequestItemBarangMasukHibah $request)
    {
    	$stat=1;
        return response()
			->json(['return'=>$stat,'idx'=>$request->input('rowIdx')]);
    }

    public function addPost(RequestBarangMasukHibah $request)
    {
        $stat = 0;
        $action ='';
        //header
        $pic_recipient_id = $request->pic_id;
        $from_project_id = $request->mfrom_project_id;
        $from_pt_id = $request->from_pt_id;
        $no_refrensi = $request->no_refrensi;
        if($from_project_id == 0)
        {
            $from_project_id = $request->from_project_id;
        }
        $to_project_id = $request->session()->get('project_id');
        //$to_pt_id =  User::find(\Auth::user()->id)->project_pt_users->where('project_id',$to_project_id)->first()->pt_id;
        $user_id = Auth::user()->id;
        $project_id = $request->session()->get('project_id');
        $to_pt_id = ProjectPtUser::where('user_id',$user_id)->first()->pt_id;
        $department_id = Department::where('code','HRD')->first()->id;
        $no = CreateDocument::createDocumentNumber('BM',$department_id,$project_id,$user_id);
        $tanggal_hibah = $request->tanggal_hibah;
        $description = $request->description;
        $status = 1;
        $allItemStore = json_decode($request->allItemStore);
        $datavalidation = [ 'data' => $request->all() ];
        
        if(count($allItemStore) > 0)
        {
            $executeBarangMasukHibah = BarangMasukHibah::create(
                                [
                                    'from_project_id'=>$from_project_id,
                                    'from_pt_id'=>$from_pt_id,
                                    'to_project_id'=>$to_project_id,
                                    'to_pt_id'=>$to_pt_id,
                                    'tanggal_hibah'=>$tanggal_hibah,
                                    'status' => 0,
                                    'no'=>$no,
                                    'no_refrensi' => $no_refrensi,
                                    'description'=>$description,
                                    'pic_recipient_id'=>$pic_recipient_id
                                ]);
            if($executeBarangMasukHibah)
            {
                for($i =0;$i < count($allItemStore);$i++)
                {
                        $action = BarangMasukHibahDetail::create([
                                    'barang_masuk_hibah_id' => $executeBarangMasukHibah->id,
                                    'warehouse_id' => $allItemStore[$i]->warehouse_id,
                                    'item_id' => $allItemStore[$i]->item_id,
                                    'item_satuan_id' => $allItemStore[$i]->item_satuan_id,
                                    'quantity_acuan' => $allItemStore[$i]->quantity,
                                    'price' => $allItemStore[$i]->price,
                                    'description'=> $allItemStore[$i]->description,
                                    'status'=>$status
                                ]);
                }
            }
            if($action)
            {
                $stat = 1;
            }
        }

        return response()->json(['return'=>$stat]);  
    }

    public function getPtExists($projectid)
    {
        $allPT = null;
        if($projectid>0)
        {
            $allPT = Pt::select('id','code','name')->get();
        }
        return response()->json($allPT);
    }

    public function project_autocomplete(Request $request)
    {
		$term = $request->term;
        $current_project_id = $request->current_project_id;
		$results = array();
		$queries = Project::where([['name', 'LIKE', '%'.$term.'%'],['id','<>',$current_project_id]])->take(10)->get();
		foreach ($queries as $query){
			$results[] = ['id' => $query->id, 'name' => $query->name,'code'=>$query->code];
		}
		
		return response()->json($results);
    }

    public function getData(Request $request)
    {
        $getHeader = BarangMasukHibah::all();
        $arrHearBarangMasuk =[];
        $no =0;
        foreach ($getHeader as $key => $value) {
            # code...
            $no+=1;
            $total_acuan = $value->details->where('status',1)->sum('quantity_acuan');
            $total_diisi = $value->details->where('status','<>',1)->sum('quantity');
            $total_reject = $value->details->where('status','<>',1)->sum('quantity_reject');
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
                'reject'=>$total_reject,
                'selisih' => $total_acuan-($total_diisi+$total_reject),
                'status'=>$value->status
            );

            array_push($arrHearBarangMasuk, $arrGetHeader);
        }

        return datatables()->of($arrHearBarangMasuk)->toJson();
    }

    public function printReport()
    {
        $getHeader = BarangMasukHibah::all();
        $arrHearBarangMasuk =[];
        $no =0;
        foreach ($getHeader as $key => $value) {
            # code...
            $no+=1;
            $total_acuan = $value->details->where('status',1)->sum('quantity_acuan');
            $total_diisi = $value->details->where('status','<>',1)->sum('quantity');
            $total_reject = $value->details->where('status','<>',1)->sum('quantity_reject');
            $arrGetHeader = array(
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
                'reject'=>$total_reject,
                'selisih' => $total_acuan-($total_diisi+$total_reject),
                'satuan'=>$value->status
            );

            array_push($arrHearBarangMasuk, $arrGetHeader);
        }

        $pdf = PDF::loadview('inventory::barangmasuk_hibah.printReport',compact('arrHearBarangMasuk'))->setPaper('a4','potrait');
        //$pdf = PDF::loadView('barangmasuk_hibah.printRejectItems',compact('BarangMasukHibah'))->setPaper('a4','potrait');
        return $pdf->stream('LaporanBarangMasuk.pdf');

        //return view('barangmasuk_hibah.printReport',compact('arrHearBarangMasuk'));

    }

    public function storeItem(RequestItemBarangMasukHibah $request)
    {
        $stat = 0;
        $action ='';
        $id = $request->id;
        $barang_masuk_hibah_id = $request->barang_masuk_hibah_id;
        $objBarangMasuk = BarangMasukHibah::find($barang_masuk_hibah_id);
        $warehouse_id = $request->warehouse_id;
        $item_id = $request->item_id;
        $item_satuan_id = $request->item_satuan_id;
        $quantity = $request->quantity;
        $price = $request->mprice;
        $description = $request->description;
        $status = 1;

        $validatequantity = $objBarangMasuk->details->where('item_id',$item_id)->where('status',0)->sum('quantity_acuan');
        //return $vali
        if($quantity <= $validatequantity)
        {
            $execute = BarangMasukHibahDetail::create([
                                'barang_masuk_hibah_id' => $executeBarangMasukHibah->id,
                                'warehouse_id' => $allItemStore[$i]->warehouse_id,
                                'item_id' => $allItemStore[$i]->id,
                                'item_satuan_id' => $allItemStore[$i]->item_satuan_id,
                                'quantity' => $allItemStore[$i]->quantity,
                                'price' => $allItemStore[$i]->price,
                                'description'=> $allItemStore[$i]->description,
                                'status'=>$status
                            ]);
            if($execute)
            {
                $stat = 1;
            }
        }

        return response()->json(['return'=>$stat]);
    }

    public function getDataDetails($id)
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
                'price' => $value->price,
                'total' => $value->price*$value->total_diisi
            ];

            array_push($results,$arrdata);
        }

        return datatables()->of($results)->toJson();
    }

    public function details(Request $request,$id)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $BarangMasukHibah = BarangMasukHibah::find($id);
        $detailsbarangmasuk = BarangMasukHibahDetail::where([
            ['barang_masuk_hibah_id','=',$id],
            ['status','=',null]
        ])->orderBy('created_at','DESC')->get();
        $buttonApprove ="<button class='approve btn btn-success btn-xs'>Approved</button>";
        $buttonOpen ="<button class='unapprove btn btn-info btn-xs'>Open</button>";
        return view('inventory::barangmasuk_hibah.details',compact('BarangMasukHibah','buttonApprove','buttonOpen','detailsbarangmasuk','project','user'));
    }

    public function pt_autocomplete(Request $term)
    {
    	$stat=0;
		$term = $term->get('term');
		$results = array();
		$queries = Pt::where('name', 'LIKE', '%'.$term.'%')->take(10)->get();
		foreach ($queries as $query){
			$results[] = ['id' => $query->id, 'name' => $query->name];
		}
		
		return response()->json($results);
    }


    public function updateQuantity(Request $request)
    {
        $stat = 0;
        $errMsg ='';

        $id = $request->id;
        $barangmasuk_hibah_id = $request->barangmasuk_hibah_id;
        $description = $request->description;
        $quantity = $request->quantity;
        $warehouse_id = $request->warehouse_id;
        $item_id = $request->item_id;
        $price = $request->mprice;
        $quantity_reject = $request->quantity_reject;
        $objBarangMasuk = BarangMasukHibahDetail::where([
            ['item_id','=',$item_id],
            ['barang_masuk_hibah_id','=',$barangmasuk_hibah_id],
            ['warehouse_id','=',$warehouse_id]
        ])->first();
        $validate = $objBarangMasuk->quantity_acuan;
        $checkTotal = BarangMasukHibahDetail::where([
            ['barang_masuk_hibah_id','=',$barangmasuk_hibah_id],
            ['item_id','=',$item_id],
            ['warehouse_id','=',$warehouse_id]
        ])->sum('quantity');

        $total = $checkTotal + $quantity;
        //$checkQuantity = BarangMasukHibahDetail::find($id)->where('item_id',$item_id)->sum('quantity');
        if($total <= $validate)
        {
                $createNew = BarangMasukHibahDetail::create([
                            'barang_masuk_hibah_id'=>$barangmasuk_hibah_id,
                            'warehouse_id'=>$warehouse_id,
                            'item_id'=>$item_id,
                            'item_satuan_id'=>$objBarangMasuk->item_satuan_id,
                            'quantity'=>$quantity,
                            'quantity_acuan'=>$objBarangMasuk->quantity_acuan,
                            'quantity_reject'=>$quantity_reject,
                            'price'=>$price,
                            //'no',
                            'description'=>$description
                ]);
                if($createNew)
                {
                    $stat = 1;
                }
            
        }
        else{
            $errMsg = 'jumlah yang diinput melebihi batas = '.$validate;
        }   
        
        return response()->json(['return'=>$stat,'errMsg'=>$errMsg]);
    }

    public function delivery(Request $request)
    {
        $stat = 0;
        $barangmasuk_hibah_id = $request->id;
        $checkQty = BarangMasukHibahDetail::where('barang_masuk_hibah_id',$barangmasuk_hibah_id)->sum('quantity');
        $chekQtyReject =BarangMasukHibahDetail::where('barang_masuk_hibah_id',$barangmasuk_hibah_id)->sum('quantity_reject');

        $checkQtyAcuan = BarangMasukHibahDetail::where([
            ['barang_masuk_hibah_id','=',$barangmasuk_hibah_id],
            ['status','=',1]
        ])->sum('quantity_acuan');


        $total_realisasi = (is_null($checkQty) ? 0 : $checkQty) + (is_null($chekQtyReject) ? 0 : $chekQtyReject);
        $resultQty = $total_realisasi - $checkQtyAcuan;


        if($resultQty == 0)
        {
            $delivered = BarangMasukHibah::find($barangmasuk_hibah_id)
            ->update(['status'=>1]);
            if($delivered)
            {
                $stat = 1;
            }
        }
        
        return response()->json($stat);
    }

    public function delete(Request $request)
    {
        $stat=0;
        $id = $request->id;
        $execute_delete = BarangMasukHibah::find($id)->delete();
        if($execute_delete)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
    }

    public function update(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = BarangMasukHibah::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
        
    }

    public function updateDetails(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        $value = $request->value;
        $updated = BarangMasukHibahDetail::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
    }

    public function detailsReject(Request $request,$id)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $BarangMasukHibah = BarangMasukHibah::find($id);
        $detailsbarangmasuk = BarangMasukHibahDetail::select('price','description','warehouse_id','item_id','item_satuan_id',DB::raw('sum(quantity_reject) as total_reject'))->where([
            ['barang_masuk_hibah_id','=',$id],
            ['status','=',null]
        ])->groupBy('price','description','warehouse_id','item_id','item_satuan_id')->get();
        return view('inventory::barangmasuk_hibah.details_reject',compact('user','project','BarangMasukHibah','detailsbarangmasuk'));
    }

    public function cetakReject($id)
    {
        $BarangMasukHibah = BarangMasukHibah::find($id);
        $detailsbarangmasuk = BarangMasukHibahDetail::select('price','description','item_id','item_satuan_id',DB::raw('sum(quantity_reject) as total_reject'))->where([
            ['barang_masuk_hibah_id','=',$id],
            ['status','=',null]
        ])->groupBy('price','description','item_id','item_satuan_id')->get();

       // return view('barangmasuk_hibah.printRejectItems',compact('BarangMasukHibah','detailsbarangmasuk'));

        $pdf = PDF::loadview('inventory::barangmasuk_hibah.printRejectItems',compact('BarangMasukHibah','detailsbarangmasuk'))->setPaper('a4','potrait');
        //$pdf = PDF::loadView('barangmasuk_hibah.printRejectItems',compact('BarangMasukHibah'))->setPaper('a4','potrait');
        return $pdf->stream('cetakan_reject.pdf');
    }

    public function cetakBarangMasuk(Request $request,$id)
    {
        $BarangMasukHibah = BarangMasukHibah::find($id);
        $detailsbarangmasuk = BarangMasukHibahDetail::select('quantity_acuan',
            'price',
            'description',
            'item_id',
            'item_satuan_id',
            'warehouse_id',
            DB::raw('sum(quantity_reject) as total_reject')
            ,DB::raw('sum(quantity) as total_terima'))->where([
            ['barang_masuk_hibah_id','=',$id],
            ['status','=',null]
        ])->groupBy('quantity_acuan','price','description','item_id','item_satuan_id','warehouse_id')->get();

       // return view('barangmasuk_hibah.printRejectItems',compact('BarangMasukHibah','detailsbarangmasuk'));

        $pdf = PDF::loadview('inventory::barangmasuk_hibah.printBuktiBarangMasuk',compact('BarangMasukHibah','detailsbarangmasuk'))->setPaper('a4','potrait');
        //$pdf = PDF::loadView('barangmasuk_hibah.printRejectItems',compact('BarangMasukHibah'))->setPaper('a4','potrait');
        return $pdf->stream('cetakan_barangmasuk.pdf');
    }

}

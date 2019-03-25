<?php

namespace Modules\TenderPurchaseRequest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequest;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupDetail;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaranDetail;

use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaranPembayaranCoD;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaranPembayaranTermin;


use Modules\PurchaseRequest\Entities\PurchaseRequestDetail;
use Modules\Rab\Entities\RabPekerjaan;
use Modules\Approval\Entities\Approval;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectPtUser;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\ItemPrice;
use Modules\Inventory\Entities\ItemProject;
use Modules\Inventory\Entities\CreateDocument;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestRekanan;
use Modules\Rekanan\Entities\Rekanan;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekananDetails;

use Modules\TenderPurchaseRequest\Entities\PurchaseOrder;
use Modules\TenderPurchaseRequest\Entities\PemenangTenderPurchaseRequest;
use Modules\TenderPurchaseRequest\Entities\PemenangTenderPurchaseRequestDetail;
use Modules\TenderPurchaseRequest\Entities\TenderMenangPR;
use Modules\Approval\Entities\ApprovalHistory;

use Auth;
use datatables;
use DB;

class TenderPurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->middleware(['auth','project_session']);
    }


    public function pr_belum_kelompok(Request $request)
    {
        $project_id = $request->session()->get('project_id');
        $itemSiapKelompok = PurchaseRequestDetail::select("items.kode as kodeitem","items.name as itemName","ic.name as categori","purchaserequests.no as prNo","departments.name as departmentName","brands.name as brandName","purchaserequest_details.quantity", "item_satuans.name as satuanName")
                ->orderBy("purchaserequest_details.id","desc")
                ->distinct()
                ->join("purchaserequests","purchaserequests.id","purchaserequest_details.purchaserequest_id")
                ->join("approvals","purchaserequest_details.id","=","approvals.document_id")
                ->where('approvals.document_type','=',"Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                ->where('approvals.approval_action_id','=',6)
                ->where('purchaserequests.project_for_id',$project_id)
                ->join("item_projects","purchaserequest_details.item_id","item_projects.id")
                ->join("items","item_projects.item_id","items.id")
                ->join('item_categories as ic','items.sub_item_category_id','ic.id')
                ->orderBy("purchaserequest_details.item_id","asc")
                ->leftJoin("tender_purchase_request_group_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                ->whereNull("tender_purchase_request_group_details.id_purchase_request_detail")
                ->join("departments","departments.id","purchaserequests.department_id")
                ->join("brands","brands.id","purchaserequest_details.brand_id")
                ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
                ->get();
                
        // return $itemSiapKelompok;

        return datatables()->of($itemSiapKelompok)->toJson();
    }

    public function pr_sudah_kelompok(Request $request)
    {
        $project_id = $request->session()->get('project_id');
        $item_sudah_kelompok = ItemProject::select("approval_actions.description as status","item_id","result1.*")->join(DB::raw("((select results.id as idgroup,results.nomor_pengelompokkan,results.total,results.iditem,isn.name as satuan_name,br.name as brand_name from (select cte.id,cte.nomor_pengelompokkan
,sum(prd.quantity) as total
,prd.item_id as iditem
,prd.item_satuan_id
,prd.brand_id from 
    (select tprg.id,tprg.no as nomor_pengelompokkan,tprgd.id_purchase_request_detail as id_pr_detail from 
        tender_purchase_request_groups tprg, tender_purchase_request_group_details as tprgd where tprg.id = tprgd.tender_purchase_request_groups_id) as cte,
purchaserequest_details as prd where cte.id_pr_detail= prd.id group by cte.id,cte.nomor_pengelompokkan,prd.item_id,prd.item_satuan_id,prd.brand_id) as results 
inner join item_satuans as isn on results.item_satuan_id = isn.id
inner join brands as br on results.brand_id = br.id 
group by  results.total,results.id,results.nomor_pengelompokkan,results.iditem,isn.name,br.name order by results.id)) as result1"),"item_projects.id","=","result1.iditem")
        ->join("approvals","result1.idgroup","=","approvals.document_id")
        ->join("approval_actions","approval_actions.id","=","approvals.approval_action_id")
        ->where('item_projects.project_id',$project_id)
        /*->whereNotIn('result1.idgroup',DB::table("tender_purchase_request_group_rekanans")->select("tender_purchase_request_group_id"))*/
        ->where('approvals.document_type','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup')
        ->distinct()
        ->get();


        $result = [];
        foreach ($item_sudah_kelompok as $key => $value) {
            # code...
            $arr = [
                'item_name'=>$value->item->name,
                'category'=>$value->item->sub_category->name,
                'no'=>$value->nomor_pengelompokkan,
                'satuan'=>$value->satuan_name,
                'brand'=>$value->brand_name,
                'kode_barang'=>$value->item->kode,
                'qty'=>$value->total,
                'status'=>$value->status
            ];
            array_push($result, $arr);
        }

        return datatables()->of($result)->toJson();
    }

    public function pengelompokan(Request $request)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));

        return view('tenderpurchaserequest::pengelompokan',compact("user","project"));
    }

    public function pengelompokanDetail(Request $request){
        $id = $request->id;
        $project_id = $request->session()->get('project_id');
        $project = Project::find($project_id);
        $user = Auth::user();

        $header = TenderPurchaseRequestGroup::where('no',$id)->first();

        $itemDetil = TenderPurchaseRequestGroup::select(
            "purchaserequests.no as nopr","items.name as itemName",
            "brands.name as brandName",
            DB::raw("sum(purchaserequest_details.quantity) as totalqty"),
            "item_satuans.name as satuanName")
        ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id",
            "tender_purchase_request_groups.id")
        ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
        ->join('purchaserequests','purchaserequests.id','purchaserequest_details.purchaserequest_id')
        ->join("brands","brands.id","purchaserequest_details.brand_id")
        ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
        ->join("item_projects","item_projects.id","purchaserequest_details.item_id")
        ->join("items","items.id","item_projects.item_id")
        ->join("approvals","tender_purchase_request_groups.id","=","approvals.document_id")
        ->join("approval_actions","approval_actions.id","=","approvals.approval_action_id")
        ->groupBy("purchaserequests.no","items.name","brands.name","item_satuans.name")
        ->where('tender_purchase_request_groups.id',$header->id)
        ->where('tender_purchase_request_groups.project_for_id',$project_id)
        ->where('approvals.document_type','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup')
        ->distinct()
        ->get();

        return view('tenderpurchaserequest::pengelompokanDetail',compact("user","project","itemDetil","header"));
    }


    public function pengelompokanAdd(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $po_s = PurchaseOrder::all();

        return view('tenderpurchaserequest::pengelompokanAdd',compact("user","project","po_s"));
    }

    public function getItemSiapKelompok(Request $request)
    {
        $project_id = $request->session()->get('project_id');
        $itemSiapKelompok = PurchaseRequestDetail::select("items.name as itemName","purchaserequest_details.item_id","purchaserequest_details.id","purchaserequests.no as prNo","departments.name as departmentName","brands.name as brandName","purchaserequest_details.quantity", "item_satuans.name as satuanName",DB::raw("(select min(st.konversi) from item_satuans st where st.id = item_satuans.id and st.deleted_at is null) as konversi"),"r1.name as rekanan1","r2.name as rekanan2","r3.name as rekanan3",DB::raw("(select ics.name from item_categories as ics where ics.id = item_categories.parent_id) as category_name"))
                ->orderBy("purchaserequest_details.id","desc")
                ->join("purchaserequests","purchaserequests.id","purchaserequest_details.purchaserequest_id")
                ->join("approvals","purchaserequest_details.id","=","approvals.document_id")
                ->where('approvals.document_type','=',"Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                ->where('approvals.approval_action_id','=',6)
                ->where('purchaserequests.project_for_id',$project_id)
                ->join("item_projects","purchaserequest_details.item_id","item_projects.id")
                ->join("items","item_projects.item_id","items.id")
                ->leftJoin('rekanans as r1','r1.id','purchaserequest_details.rec_1')
                ->leftJoin('rekanans as r2','r2.id','purchaserequest_details.rec_2')
                ->leftJoin('rekanans as r3','r3.id','purchaserequest_details.rec_3')
                ->orderBy("purchaserequest_details.item_id","asc")
                ->leftJoin("tender_purchase_request_group_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                ->whereNull("tender_purchase_request_group_details.id_purchase_request_detail")
                ->join("departments","departments.id","purchaserequests.department_id")
                ->join("brands","brands.id","purchaserequest_details.brand_id")
                ->join('brand_of_categories','brand_of_categories.brand_id','brands.id')
                ->join('item_categories','item_categories.id','brand_of_categories.category_id')
                ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
                ->distinct()
                ->get();

        /*$results = [];
        foreach ($itemSiapKelompok as $key => $value) {
            # code...
            $nama_category = 
            $arr = [
                'itemName'=>$value->itemName,
                'item_id'=>$value->item_id,
                'id'=>$value->id,
                'prNo'=>$value->prNo,
                'departmentName'=>$value->departmentName,
                'brandName'=>$value->brandName,
                'quantity'=>$value->quantity,
                'satuanName'=>$value->satuanName,
                'konversi'=>$value->konversi,

            ];

        }*/

         return datatables()->of($itemSiapKelompok)->toJson();
    }

    public function pengelompokanStore(Request $request){

        $url = "/tenderpurchaserequest/pengelompokan/";
        $project_id = $request->session()->get('project_id');

        $user_id = Auth::user()->id; 
        
        $pt_id = ProjectPtUser::where([['user_id','=',$user_id],['project_id','=',$project_id]])->first()->pt_id;
        $arr_pr_details = json_decode($request->all_send);

        /*$cek_data_sama = 0;
        for ($count=0;$count<count($arr_pr_details);$count++) {
            $tmp = TenderPurchaseRequestGroupDetail::where("id_purchase_request_detail",$arr_pr_details[$count])->count();
            if($tmp>0)
                $cek_data_sama++;
        }*/

        //if($cek_data_sama == 0){

            $tender_purchase_request_groups = new TenderPurchaseRequestGroup;
            $tender_purchase_request_groups->no = CreateDocument::createDocumentNumber('TPRG',2,$project_id,$user_id);
            $tender_purchase_request_groups->project_for_id = $project_id;
            $tender_purchase_request_groups->description = $request->description;
            $tender_purchase_request_groups->id_po_lampiran = $request->id_po_lampiran;
            $tender_purchase_request_groups->save();
            
            for ($count=0;$count<count($arr_pr_details);$count++) {
                $tender_purchase_request_group_details = new TenderPurchaseRequestGroupDetail;
                $tender_purchase_request_group_details->tender_purchase_request_groups_id = $tender_purchase_request_groups->id;
                $tender_purchase_request_group_details->id_purchase_request_detail = $arr_pr_details[$count];
                $tender_purchase_request_group_details->save();
            }

            CreateDocument::make_approval('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup',$tender_purchase_request_groups->id,$project_id,$pt_id);
            Approval::where('document_id',$tender_purchase_request_groups->id)->where('document_type','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup')->update(['approval_action_id'=>6]);

            
       // }

       return redirect($url);
    }

    public function create(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        
            $result_pengelompokan = [];
            $pengelompokanTender =  TenderPurchaseRequestGroup::select("tender_purchase_request_groups.*")->leftJoin("tender_purchase_requests","tender_purchase_requests.tender_pr_groups_id","tender_purchase_request_groups.id")
            ->where("tender_purchase_requests.tender_pr_groups_id",NULL)->get();

        
            foreach ($pengelompokanTender as $key => $value) {
                # code...
                if($value->approval[0]->approval_action_id == 6)
                {
                    $arr = [
                        'id'=>$value->id,
                        'desc'=>$value->description,
                        'no'=>$value->no
                    ];

                    array_push($result_pengelompokan, $arr);
                }
            }
            
        $auto_date_create_tender = DB::table("globalsettings")->where("parameter","auto_date_create_tender")->first();
        if(isset($auto_date_create_tender))
            $auto_date_create_tender = $auto_date_create_tender->value;
        $auto_date_create_tender = (int)$auto_date_create_tender;

        return view('tenderpurchaserequest::create',compact("user","project","result_pengelompokan","auto_date_create_tender"));
    }


    public function rekanan(Request $request){
        $user = \Auth::user();
        //auth,
        date_default_timezone_set("Asia/Jakarta");
        foreach($request->rekanan as $value){
            $tmp = DB::table('tender_purchase_request_rekanans')->select('id')->where('tender_purchase_request_id','=',$request->id)->where('rekanan_id','=',$value)->first();
            if(!isset($tmp)){
                $TPRR = new \Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestRekanan;
                $TPRR->tender_purchase_request_id   = $request->id;
                $TPRR->rekanan_id                   = $value;
                $TPRR->save();

                $TPRP                       = new \Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran;
                $TPRP->tender_rekanan_id    = $TPRR->id;
                $TPRP->no                   = \App\Helpers\Document::new_number('TPRP', 2);//2 karna penambahan rekanan hanya oleh c&d
                $TPRP->date                 = date("Y-m-d");            
                $TPRP->save();
                
                for($j=1;$j<=3;$j++){
                    $TPRPD                      = new \Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaranDetail;
                    $TPRPD->tender_penawaran_id = $TPRP->id;
                    $TPRPD->keterangan          = "Penawaran ".$j;
                    $TPRPD->save();
                }
            }
        }
        return redirect("/tenderpurchaserequest/detail/?id=". $request->id);
    }
    public function detail(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $TPR  = TenderPurchaseRequest::where("id",$request->id)->first();
        $jumlahPR = DB::table("tender_purchase_request_group_details")->where("tender_purchase_request_groups_id",$TPR->tender_pr_groups_id)->count();


        //kurang optimal PRD
        $PRD =  DB::table("tender_purchase_request_group_details")
                ->where("tender_purchase_request_groups_id",$TPR->tender_pr_groups_id)
                ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                ->join("purchaserequests","purchaserequests.id","purchaserequest_details.purchaserequest_id")
                ->leftJoin("rekanans as rekanan1","rekanan1.id","purchaserequest_details.rec_1")
                ->leftJoin("rekanans as rekanan2","rekanan2.id","purchaserequest_details.rec_2")
                ->leftJoin("rekanans as rekanan3","rekanan3.id","purchaserequest_details.rec_3")
                ->join("items","items.id","purchaserequest_details.item_id")
                ->join("brands","brands.id","purchaserequest_details.brand_id")
                ->select("purchaserequests.no","rekanan1.name as rekanan1Name","rekanan2.name as rekanan2Name","rekanan3.name as rekanan3Name","purchaserequest_details.delivery_date","items.name as itemName","brands.name as brandName","purchaserequest_details.item_id")
                ->get();  
        

        $TPRItem =  DB::table("tender_purchase_request_group_details")
                    ->where("tender_purchase_request_groups_id",$TPR->tender_pr_groups_id)
                    ->join("tender_purchase_request_groups","tender_purchase_request_groups.id","tender_purchase_request_group_details.tender_purchase_request_groups_id")
                    ->join('purchaserequest_details','purchaserequest_details.id','tender_purchase_request_group_details.id_purchase_request_detail')
                    ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
                    ->select("item_satuans.name as satuanName","purchaserequest_details.quantity","tender_purchase_request_groups.description")
                    ->first();
        $TMPrekanan =  DB::table("tender_purchase_request_rekanans")
                    ->where("tender_purchase_request_rekanans.tender_purchase_request_id",$TPR->id)
                    ->join("rekanans","rekanans.id","tender_purchase_request_rekanans.rekanan_id");
        $rekanan =  $TMPrekanan
                    ->select("rekanans.name","tender_purchase_request_rekanans.is_pemenang","rekanans.id","tender_purchase_request_rekanans.id as tprrId")
                    ->get();
        $pemenang = DB::table("tender_purchase_request_rekanans")
                    ->where("tender_purchase_request_rekanans.tender_purchase_request_id",$TPR->id)
                    ->sum("is_pemenang");

        $rekananArray = [];
        $idPemenang = 0;
        foreach ($rekanan as $v){
            if($v->id and !in_array($v->id, $rekananArray))
                array_push($rekananArray, $v->id);
            if($v->is_pemenang == 1)
                $idPemenang = $v->id;
        }

        $idPemenang = DB::table("tender_purchase_request_rekanans")
                            ->where("rekanan_id",$idPemenang)
                            ->where("tender_purchase_request_id",$request->id)
                            ->first();
        if($idPemenang != null)
            $idPemenang = $idPemenang->id;
        else
            $idPemenang = 0;
            
        $rekananList = DB::table("rekanans")->get();
        $apporve =  DB::table("approvals")
                    ->where("document_id",$idPemenang)
                    ->where("document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestRekanan")
                    ->join("approval_actions","approval_actions.id","approvals.approval_action_id")
                    ->select("approval_actions.description as status")
                    ->first();
         if($apporve == NULL)
            $apporve = (object)[
                        'status' => 0
                        ];
        $tender_approve =   DB::table("approvals")
                            ->where("document_id",$TPR->id)
                            ->where("document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequest")
                            ->select("approval_action_id")
                            ->first()
                            ->approval_action_id;

        if(isset($request->back))
            $back = $request->back;

        
        return view('tenderpurchaserequest::detail',compact("user","project","TPR","jumlahPR","PRD","TPRItem","rekanan","pemenang","penawaran","rekananList","rekananArray","idPemenang","apporve","tender_approve","back"));    
    }
    

    public function add_pemenang(Request $request){
        $approval = new Approval;
        $approval->approval_action_id   = 1;
        $approval->document_id          = $request->id;
        $approval->document_type        = "Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestRekanan";
        $approval->save();

        DB::table('tender_purchase_request_rekanans')
            ->where('id', $request->id)
            ->update([
                "is_pemenang" => 1
            ]);

        return redirect("/tenderpurchaserequest/detail/?id=". $request->tpr_id);
    }
    

    public function approve_tender(Request $request){
        DB::table("approvals")
        ->where('document_id', $request->id)
        ->where('document_type', "Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequest")
        ->update([
            'approval_action_id' => 6
        ]);
        return redirect("/tenderpurchaserequest/detail/?id=". $request->id);
    }
    public function approve_pemenang(Request $request){
        DB::table("approvals")
        ->where('document_id', $request->id)
        ->where('document_type', "Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestRekanan")
        ->update([
            'approval_action_id' => 6
        ]);
        DB::table("approvals")
        ->where('document_id', $request->tpr_id)
        ->where('document_type', "Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequest")
        ->update([
            'approval_action_id' => 6
        ]);
        
        return redirect("/tenderpurchaserequest/detail/?id=". $request->tpr_id);
    }

   

    public function getSupplierPenawaran(Request $request)
    {
        $id = $request->id;
        $result_rekanan = [];
        $getRekanans = TenderPurchaseRequestGroupRekananDetails::where('tender_purchase_request_group_rekanan_id',$id)->get();

        $counter_penawaran = 0;
        foreach ($getRekanans as $key => $value) {
            # code...
            $arr = [
                'id'=>$value->id,
                'rekanan_name'=>$value->rekanan->name
            ];

            array_push($result_rekanan, $arr);

            $checkPenawaran = TenderPurchaseRequestPenawaran::where([['id_tender_purchase_request_group_rekanan','=',$id],['rekanan_id','=',$value->id]])->first();
            if($checkPenawaran != null)
            {
                $counter_penawaran +=1;
            }
        }

        return response()->json(['result'=>$result_rekanan,'indexPenawaran'=>$counter_penawaran]);
    }

    public function add_nilai_penawaran(Request $request)
    {
        $project_id = $request->session()->get('project_id');
        $user = Auth::user();
        $project = Project::find($project_id);
        //$result_penawaran = [];
        $result_penawaran = DB::table("tender_purchase_request_group_rekanans as tpr")->select("tpr.id","tpr.no")->where('status_pemenang',0)
        ->where('project_for_id',$project_id)
        ->whereNotIn('tpr.id',DB::table("tender_menang_pr")->select('tender_purchase_group_rekanan_id'))->where('deleted_at',null)->get();
        $metode_pembayaran = DB::table("metode_pembayarans")->select("*")->get();

        return view('tenderpurchaserequest::createPenawaran',compact("user","project","result_penawaran","metode_pembayaran"));
    }

    public function getItemSupplierPenawaran(Request $request)
    {
        $trgr_id = $request->id;
        $supplier_id = $request->supplier_id;
        $item_tenders = TenderPurchaseRequestGroupRekanan::select(
            "items.sub_item_category_id",
            "items.id as itemid",
            "items.kode",
            "items.name as itemName",
            "brands.name as brandName",
            "brands.id as brandId",
            "purchaserequest_details.description",
            DB::raw("(sum(purchaserequest_details.quantity)) as totalqty"),
            "item_satuans.name as satuanName",
            "item_satuans.id as satuan_id")
            ->join('tender_purchase_request_groups','tender_purchase_request_group_rekanans.tender_purchase_request_group_id','tender_purchase_request_groups.id')
            ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
            ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
            ->join("brands","brands.id","purchaserequest_details.brand_id")
            ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
            ->join("item_projects","item_projects.id","purchaserequest_details.item_id")
            ->join("items","items.id","item_projects.item_id")
            ->join("approvals","tender_purchase_request_group_rekanans.id","=","approvals.document_id")
            ->join("approval_actions","approval_actions.id","=","approvals.approval_action_id")
            ->where('approvals.document_type','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan')
            ->where('tender_purchase_request_group_rekanans.id',$trgr_id)
            ->groupBy("items.id","items.sub_item_category_id","items.kode","tender_purchase_request_group_rekanans.no","items.name","brands.name","item_satuans.name","item_satuans.id","brands.id","purchaserequest_details.description")
            ->get();

        $pajak_rekanan = DB::table('rekanans')->select('pkp_status')->where('id',$supplier_id)->first();

        
        $brand_ditawarkan = [];
        
        foreach ($item_tenders as $key => $value) {
            # code...
            $result = [];
            $getItem = Item::find($value->itemid)->sub_category;
            if($getItem != null)
            {

                $getItem = $getItem->brands_category;
                foreach ($getItem as $key => $v) {
                    # code...
                    $arr = [
                        'brand_name'=>$v->brand->name,
                        'id'=>$v->brand_id
                    ];
                    array_push($result, $arr);
                }


            }
            else
            {
                $newItem = Item::find($value->itemid)->category->brands_category;
                if(count($newItem) > 0)
                {
                    foreach ($newItem as $key => $v) {
                    # code...
                        $arr = [
                            'brand_name'=>$v->brand->name,
                            'id'=>$v->brand_id
                        ];

                        array_push($result, $arr);
                    }
                }
                
            }

            $brand_ditawarkan[] = [$value->itemid=>$result];
        }

        $penawaran = TenderPurchaseRequestPenawaran::where('id_tender_purchase_request_group_rekanan',$trgr_id)->where('rekanan_id',$supplier_id)->max('penawaran');

        $brand_vendor = TenderPurchaseRequestPenawaranDetail::join('tender_purchase_request_penawarans','tender_purchase_request_penawarans.id','tender_purchase_request_penawarans_details.tender_penawaran_id')->join('brands','brands.id','tender_purchase_request_penawarans_details.brand_id')->where('tender_purchase_request_penawarans.id_tender_purchase_request_group_rekanan',$trgr_id)->where('tender_purchase_request_penawarans.rekanan_id',$supplier_id)->select('tender_purchase_request_penawarans_details.brand_id as brand','brands.name as brand_name')->distinct()->get();
        $brand_dari_vendor = [];
        foreach ($brand_vendor as $key => $v) {
                    # code...
                        $arr = [
                            'brandVendor_id'=>$v->brand,
                            'brandVendor_name'=>$v->brand_name
                        ];

                        array_push($brand_dari_vendor, $arr);
        }
        $pkp_status = is_null($pajak_rekanan) ? 0 : $pajak_rekanan->pkp_status;

        return response()->json(['data'=>$item_tenders,'pkp_status'=>$pkp_status,'brand_ditawarkan'=>$brand_ditawarkan,'penawaran_ke'=>$penawaran+1,'brand_vendor'=>$brand_dari_vendor]);
    }
    

    public function storePenawaran(Request $request){

        $createHeader = '';
        $project_id = $request->session()->get('project_id');
        $user_id = Auth::user()->id;
        date_default_timezone_set('asia/jakarta');
        $date = date("Y-m-d");

        $id_tender_penawaran = $request->penawaran;
        $rekanan_id = $request->supplier;
        $metode_pembayaran = $request->cara_bayar;
        $lama_cicilan = $request->termin;
        $DP = $request->percentage_dp;
        $penawaran = $request->penawaran_ke;

        $total_nilai = 0;
        $department_id = 2;
        $terminCicil = json_decode($request->termin_cicil);

        $all_detail = json_decode($request->all_send);

        $tpr = TenderPurchaseRequestGroupRekanan::find($id_tender_penawaran);
        $no_tender = $tpr->no;
        $no_document = CreateDocument::createDocumentNumber('TDR',2,$project_id,$user_id);

        // $check_if_record_exist = TenderPurchaseRequestPenawaran::where([['id_tender_purchase_request_group_rekanan','=',$id_tender_penawaran],['rekanan_id','=',$rekanan_id]])->first();
        if($penawaran == 1){
            $penawaran_date = TenderPurchaseRequestGroupRekanan::where('id',$id_tender_penawaran)->select('penawaran1_date as penawaran_date','klarifikasi1_date as klarifikasi_date')->first();
        }elseif($penawaran == 2){
            $penawaran_date = TenderPurchaseRequestGroupRekanan::where('id',$id_tender_penawaran)->select('penawaran2_date as penawaran_date','klarifikasi2_date as klarifikasi_date')->first();
        }elseif($penawaran == 3){
            $penawaran_date = TenderPurchaseRequestGroupRekanan::where('id',$id_tender_penawaran)->select('penawaran3_date as penawaran_date','negosiasi_date as klarifikasi_date')->first();
        }

        // var_dump($date);
        // return $penawaran_date;

        $nilai = 0;
        if($penawaran == 4){
            $nilai = 1;
        }elseif(($penawaran_date->penawaran_date < $date)&&($date < $penawaran_date->klarifikasi_date)){
            $nilai = 1;
        }

        if($nilai == 1)
        {
            if($penawaran == 1 ){
                $createHeader = TenderPurchaseRequestPenawaran::create(['no'=>$no_document,
                    'id_tender_purchase_request_group_rekanan'=>$id_tender_penawaran,
                    'project_for_id'=>$project_id,
                    'rekanan_id'=>$rekanan_id,
                    'date'=>date('Y-m-d'),
                    'id_metode_pembayaran'=>$metode_pembayaran,
                    'DP'=>$DP,
                    'lama_cicilan'=>$lama_cicilan,
                    'penawaran'=>$penawaran
                ]);
                

                //save pembayaran
                if(count($terminCicil) > 0)
                {
                    //termin
                    for ($counter=0; $counter < count($terminCicil); $counter++) { 
                        # code...
                       
                        TenderPurchaseRequestPenawaranPembayaranTermin::create([
                            'project_for_id'=>$project_id,
                            'tender_purchase_request_penawaran_id'=>$createHeader->id,
                            'termin_date'=>$terminCicil[$counter]->tanggal_cicil,
                            'percentage'=>$terminCicil[$counter]->percentage_cicil
                        ]);
                    }
                    
                }
                

              if($createHeader)
              {

                  for($count = 0;$count < count($all_detail); $count++)
                  {
                      $createDetail = TenderPurchaseRequestPenawaranDetail::create([
                          'item_id'=>$all_detail[$count]->item_id,
                          'item_satuan_id'=>$all_detail[$count]->item_satuan_id,
                          'brand_id'=>$all_detail[$count]->brand_id,
                          'tender_penawaran_id'=>$createHeader->id,
                          'nilai'=>$all_detail[$count]->nilai,
                          'volume'=>$all_detail[$count]->volume,
                          'ppn'=>$all_detail[$count]->ppn,
                          /*,
                          'disc'=>$all_detail[$count]->disc*/
                          'description'=>$all_detail[$count]->deskripsi
                      ]);

                      if(count($terminCicil) ==0)
                      {
                        for ($i=0; $i < count($all_detail[$count]->cod_value) ; $i++) { 
                           
                            $createCOD = TenderPurchaseRequestPenawaranPembayaranCoD::create([
                                'project_for_id'=>$project_id,
                                'tender_purchase_request_penawaran_id'=>$createHeader->id,
                                'tanggal_cod'=>$all_detail[$count]->cod_value[$i]->tanggal_cod,
                                'quantity'=>$all_detail[$count]->cod_value[$i]->qty,
                                'item_id'=>$all_detail[$count]->item_id,
                                'item_satuan_id'=>$all_detail[$count]->item_satuan_id,
                                'brand_id'=>$all_detail[$count]->brand_id,
                                'cod_ke'=>$all_detail[$count]->cod_value[$i]->cod_ke]);
                        }
                        
                      }

                      $total_nilai +=$all_detail[$count]->nilai;
                  }

                  $createapproval_open = Approval::create(['approval_action_id'=>1,
                      'document_id'=>$createHeader->id,
                      'document_type'=>"Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran",
                      'total_nilai'=>$total_nilai
                  ]);

                  if($createapproval_open){
                      return redirect("/tenderpurchaserequest/index_penawaran");
                  }
              }
            }else{
                $penetapan_pembayaran = DB::table('tender_purchase_request_penawaran_pembayarans')->where('tender_purchase_request_group_rekanan_id',$tpr->id)->get();
                // return $penetapan_pembayaran;
                // for ($counter=0; $counter < count($terminCicil); $counter++) 

                $proses_max = DB::table('tender_purchase_request_penawaran_pembayarans')->where('tender_purchase_request_group_rekanan_id',$tpr->id)->max('proses_ke');

                // $penawaran = TenderPurchaseRequestPenawaran::where('id_tender_purchase_request_group_rekanan',$trgr_id)->where('rekanan_id',$supplier_id)->max('penawaran');

                $createHeader = TenderPurchaseRequestPenawaran::create(['no'=>$no_document,
                    'id_tender_purchase_request_group_rekanan'=>$id_tender_penawaran,
                    'project_for_id'=>$project_id,
                    'rekanan_id'=>$rekanan_id,
                    'date'=>date('Y-m-d'),
                    'id_metode_pembayaran'=>$penetapan_pembayaran[0]->id_metode_pembayaran,
                    'DP'=>$penetapan_pembayaran[0]->DP,
                    'lama_cicilan'=>$proses_max,
                    'penawaran'=>$penawaran
                ]);


                if($penetapan_pembayaran[0]->id_metode_pembayaran == 2 ){

                    foreach ($penetapan_pembayaran as $key => $value) {
                        # code...
                        TenderPurchaseRequestPenawaranPembayaranTermin::create([
                            'project_for_id'=>$project_id,
                            'tender_purchase_request_penawaran_id'=>$createHeader->id,
                            'termin_date'=>$value->date,
                            'percentage'=>$value->besar
                        ]);
                    }
                }
                

                //save pembayaran
                // if(count($terminCicil) > 0)
                // {
                    //termin
                    
                // }

                if($createHeader)
                {

                    for($count = 0;$count < count($all_detail); $count++)
                    {
                        $createDetail = TenderPurchaseRequestPenawaranDetail::create([
                            'item_id'=>$all_detail[$count]->item_id,
                            'item_satuan_id'=>$all_detail[$count]->item_satuan_id,
                            'brand_id'=>$all_detail[$count]->brand_id,
                            'tender_penawaran_id'=>$createHeader->id,
                            'nilai'=>$all_detail[$count]->nilai,
                            'volume'=>$all_detail[$count]->volume,
                            'ppn'=>$all_detail[$count]->ppn,
                            /*,
                            'disc'=>$all_detail[$count]->disc*/
                            'description'=>$all_detail[$count]->deskripsi
                        ]);

                        if($penetapan_pembayaran[0]->id_metode_pembayaran == 1 )
                        {

                            foreach ($penetapan_pembayaran as $key => $value){ 
                               
                                $createCOD = TenderPurchaseRequestPenawaranPembayaranCoD::create([
                                    'project_for_id'=>$project_id,
                                    'tender_purchase_request_penawaran_id'=>$createHeader->id,
                                    'tanggal_cod'=>$value->date,
                                    'quantity'=>$value->besar,
                                    'item_id'=>$value->item_id,
                                    'item_satuan_id'=>$value->item_satuan_id,
                                    'brand_id'=>$value->brand_id,
                                    'cod_ke'=>$value->proses_ke]);
                            }
                            
                        }

                          $total_nilai +=$all_detail[$count]->nilai;
                    }

                    $createapproval_open = Approval::create(['approval_action_id'=>1,
                          'document_id'=>$createHeader->id,
                          'document_type'=>"Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran",
                          'total_nilai'=>$total_nilai
                    ]);

                    if($createapproval_open){
                          return redirect("/tenderpurchaserequest/index_penawaran");
                    }
                }
            }
        }
        else
        {
            return back()->withErrors(['Tidak dalam jadwal Penawaran']);
        }
        
    }


   public function checkFase(Request $request)
   {
        $result = [];
        $id_penawaran_group = $request->id_penawaran_group;
        $today = now();
        return $today;
        $getfase = TenderPurchaseRequest::select('fase_penawaran')->where('penawaran_group',$id_penawaran_group)->get();

        return $getfase;
        foreach ($getfase as $key => $value) {
            # code...
            $arr = [
                'fase'=>$value->fase_penawaran
            ];

            array_push($result,$arr);
        }

        return response()->json($result);
   }

   public function getSatuan($data)
   {
        $jumlahData = substr_count($data,',')+1;
        $data = [(int)$data];
        if($jumlahData>1){
            for($i=1;$i<$jumlahData;$i++){
                $data = substr($data,strpos($data,",")+1);
                array_push($data,(int)$data);
            }
        }
        $itemId = \Modules\PurchaseRequest\Entities\PurchaseRequestDetail::where("id",$data[0])->select("item_id")->first()->item_project->item_id;

        $itemSatuanTerkecil = DB::table("item_satuans")->where("item_id",$itemId)->orderBy("konversi","asc")->select("id","name","konversi")->first();
        $jumlahItem= 0;
        for($i=0;$i<$jumlahData;$i++){
            $PRD = DB::table("purchaserequest_details")->where("id",$data[$i])->select("quantity","item_satuan_id")->first();
            $jumlahItem += $PRD->quantity
                        * DB::table("item_satuans")->where("id",$PRD->item_satuan_id)->orderBy("konversi","asc")->select("konversi")->first()->konversi
                        / $itemSatuanTerkecil->konversi;
        }
        $hasil = [
            "jumlah" => $jumlahItem,
            "satuan" => $itemSatuanTerkecil->name,
            "satuan_id" => $itemSatuanTerkecil->id  
        ];
        return response()->json($hasil);
   }

   public function indexPenawaran(Request $request)
   {
        $project = Project::find($request->session()->get('project_id'));
        $user = Auth::user();
        return view('tenderpurchaserequest::indexPenawaran',compact('user','project'));
   }

   public function getDataPenawaran(Request $request)
   {
        $project_id = $request->session()->get('project_id');
        $result = [];
        $getDataPenawarans = TenderPurchaseRequestPenawaran::where('project_for_id',$project_id)->select('id_tender_purchase_request_group_rekanan')->distinct()->get();
        foreach ($getDataPenawarans as $key => $value) {
            # code...
            // $total = 0;
            // $detail = TenderPurchaseRequestPenawaranDetail::where('tender_penawaran_id',$value->id)->get();

            // foreach ($detail as $k => $v) {
            //     # code...
            //     $result_total = $v->volume*$v->nilai;
            //     $total += $result_total;
            // }
            $MAXgetDataPenawarans = TenderPurchaseRequestPenawaran::where('id_tender_purchase_request_group_rekanan',$value->id_tender_purchase_request_group_rekanan)->max('penawaran');
            for ($i=1; $i <= $MAXgetDataPenawarans ; $i++) { 
          # code...
                $arr = [
                    'no_tender'=>$value->tender_purchase_request_group_rekanan->no,
                    'penawaran'=> $i
                ];
            // $arr = [
            //     'id'=>$value->id,
            //     'no_tender'=>$value->tender_purchase_request_group_rekanan->no,
            //     'no'=>$value->no,
            //     'rekanan'=>$value->tender_purchase_request_group_rekanan_detail->rekanan->name,
            //     'total'=>$total
            //     ''
            // ];
            
                array_push($result, $arr);
            }
        }

        return datatables()->of($result)->toJson();
   }

   public function detailTender(Request $request)
   {
        
        $user = Auth::user();
        $project_id = $request->session()->get('project_id');
        $project = Project::find($project_id);
        $all_data = [];
        $data_rekanan = [];
        
        $id = $request->id;
        $penawaran = $request->penawaran;
        // var_dump($id);
        // var_dump($penawaran);
        // return 0;
        $getDataTender = TenderPurchaseRequestGroupRekanan::where('no',$id)->first();

        $details_tawar = TenderPurchaseRequestPenawaran::select('r.name as rekanan_name',
            'ims.name as item_name',
            'tprps.volume',
            'isn.name as satuan_name',
            DB::raw("((select price from item_prices where item_prices.item_id = ips.id order by item_prices.created_at desc limit 1)) as oe_price"),
            'tprps.nilai',
            'r.ppn',
            'rg.pph_percent')
        ->join('tender_purchase_request_penawarans_details as tprps','tender_purchase_request_penawarans.id','tprps.tender_penawaran_id')
        ->join('tender_purchase_request_group_rekanan_details as tprgrd','tender_purchase_request_penawarans.rekanan_id','tprgrd.id')
        ->join('rekanans as r','tprgrd.rekanan_id','r.id')
        ->join('rekanan_groups as rg','r.rekanan_group_id','rg.id')
        ->join('items as ims','tprps.item_id','ims.id')
        ->join('item_satuans as isn','isn.id','tprps.item_satuan_id')
        ->join('item_projects as ips','ips.item_id','ims.id')
        ->where('tender_purchase_request_penawarans.id_tender_purchase_request_group_rekanan',$getDataTender->id)
        ->where('ips.project_id',$project_id)
        ->where('tender_purchase_request_penawarans.penawaran',$penawaran)
        ->distinct()
        ->get();

        $group_item = TenderPurchaseRequestGroupRekanan::select(
            "items.id as item_id",
            "items.name as item_name",
            DB::raw("(sum(purchaserequest_details.quantity)) as volume"),
            "item_satuans.name as satuan_name","item_satuans.id as satuan_id")
        ->join('tender_purchase_request_groups','tender_purchase_request_group_rekanans.tender_purchase_request_group_id','tender_purchase_request_groups.id')
        ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
        ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
        ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
        ->join("item_projects","item_projects.id","purchaserequest_details.item_id")
        ->join("items","items.id","item_projects.item_id")
        ->where('tender_purchase_request_group_rekanans.id',$getDataTender->id)
        ->where('item_projects.project_id',$project_id)
        ->groupBy("items.id","items.name","item_satuans.name","item_satuans.id")
        ->get();

        /*$group_item = TenderPurchaseRequestPenawaran::select('br.id as brand_id'
            ,'br.name as brand_name','tprps.item_id','ims.name as item_name',
            'tprps.volume',
            'isn.name as satuan_name')
        ->join('tender_purchase_request_penawarans_details as tprps','tender_purchase_request_penawarans.id','tprps.tender_penawaran_id')
        ->join('items as ims','tprps.item_id','ims.id')
        ->join('item_satuans as isn','isn.id','tprps.item_satuan_id')
        ->join('item_projects as ips','ips.item_id','ims.id')
        ->join('brands as br','br.id','tprps.brand_id')
        ->where('tender_purchase_request_penawarans.id_tender_purchase_request_group_rekanan',$getDataTender->id)
        ->where('ips.project_id',$project_id)
        ->distinct()
        ->get();*/

        $get_data_penawaran = TenderPurchaseRequestPenawaran::select('id')->where('tender_purchase_request_penawarans.id_tender_purchase_request_group_rekanan',$getDataTender->id)->where('tender_purchase_request_penawarans.penawaran',$penawaran)->get();

        $arr_data_penawaran = [];
        foreach ($get_data_penawaran as $key => $value) {
            # code...
            array_push($arr_data_penawaran, $value->id);
        }
        array_splice($arr_data_penawaran, 0, 0, "oe");

       $join_get_data_penawaran = array_merge($arr_data_penawaran,$arr_data_penawaran);
       $join_get_data_penawaran = array_merge($join_get_data_penawaran,$arr_data_penawaran);

        $result = [];
        $result_total = [];
        $total_oe =0;
        $total_per_supplier = 0;
        foreach ($group_item as $key => $value) {
            # code...
            $arr_satuan_price = [];
            
            foreach ($join_get_data_penawaran as $k => $v) {
                # code...
                if($v == 'oe')
                {
                    if($k==0 || $k == count($get_data_penawaran)+1 || $k == (count($get_data_penawaran)+1)*2)
                    {
                        $oe_price = TenderPurchaseRequestPenawaran::select(DB::raw("((select price from item_prices where item_prices.item_id = ips.id order by item_prices.created_at desc limit 1)) as oe_price"))
                        ->join('tender_purchase_request_penawarans_details as tprps','tender_purchase_request_penawarans.id','tprps.tender_penawaran_id')
                        ->join('item_projects as ips','ips.item_id','tprps.item_id')
                        ->where('tender_purchase_request_penawarans.id_tender_purchase_request_group_rekanan',$getDataTender->id)
                        ->where('ips.project_id',$project_id)
                        ->where('tprps.item_id',$value->item_id)
                        ->where('tender_purchase_request_penawarans.penawaran',$penawaran)
                        ->first();

                        if($oe_price == null)
                        {
                            $oe_price = 0;
                        }
                        else
                        {
                            $oe_price = $oe_price->oe_price;
                            if($k == count($get_data_penawaran)+1)
                            {
                                $oe_price = $oe_price*$value->volume;
                                $total_oe +=$oe_price;
                            }
                            
                        }

                        if($k == (count($get_data_penawaran)+1)*2)
                        {

                            $brand_oe = TenderPurchaseRequestGroupRekanan::select('br.name as brand_name')
                            ->join('tender_purchase_request_groups','tender_purchase_request_group_rekanans.tender_purchase_request_group_id','tender_purchase_request_groups.id')
                            ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                            ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                            ->join("item_projects","item_projects.id","purchaserequest_details.item_id")
                            ->join("items","items.id","item_projects.item_id")
                            ->join('brands as br','br.id','purchaserequest_details.brand_id')
                            ->where('tender_purchase_request_group_rekanans.id',$getDataTender->id)
                            ->where('item_projects.project_id',$project_id)
                            ->where('items.id',$value->item_id)
                            ->first();

                            if($brand_oe == null)
                            {
                                $brand_oe = 'kosong';
                            }
                            else
                            {
                                $brand_oe = $brand_oe->brand_name;
                            }

                            $oe_price = $brand_oe;
                        }


                        array_push($arr_satuan_price, $oe_price); 
                    }

                    
                    
                }
                else
                {
                    $satuan_price = TenderPurchaseRequestPenawaranDetail::select('nilai')
                    ->where([['tender_penawaran_id','=',$v],['item_id','=',$value->item_id]])
                    ->first();

                    if($satuan_price == null)
                    {
                        $satuan_price = 0;
                    }
                    else
                    {
                        $satuan_price = $satuan_price->nilai;
                         if($k > count($get_data_penawaran))
                        {
                            $satuan_price = $satuan_price*$value->volume;
                            $total_per_supplier += $satuan_price;
                        }

                        if($k > (count($get_data_penawaran)+1)*2)
                        {
                            $brand_rekanan = TenderPurchaseRequestPenawaran::select('br.name as brand_name')
                            ->join('tender_purchase_request_penawarans_details','tender_purchase_request_penawarans.id','tender_purchase_request_penawarans_details.tender_penawaran_id')
                            ->join('brands as br','br.id','tender_purchase_request_penawarans_details.brand_id')
                            ->where('tender_purchase_request_penawarans.id_tender_purchase_request_group_rekanan',$getDataTender->id)
                            ->where('tender_purchase_request_penawarans_details.item_id',$value->item_id)
                            ->where('tender_purchase_request_penawarans_details.tender_penawaran_id',$v)
                            ->where('tender_purchase_request_penawarans.penawaran',$penawaran)
                            ->first();

                            if($brand_rekanan == null)
                            {
                                $brand_rekanan = 'kosong';
                            }
                            else
                            {
                                $brand_rekanan = $brand_rekanan->brand_name;
                            }

                            $satuan_price = $brand_rekanan;
                        }
                    }

                    array_push($arr_satuan_price,$satuan_price);
                    
                }
            }

            $arr = [
                'item_name'=>$value->item_name,
                'volume'=>$value->volume,
                'satuan_name'=>$value->satuan_name,
                'satuan_price'=>$arr_satuan_price,
            ];

            $result[]=$arr;


        }

        $checkStatus = [];
        $getDataPenawarans = TenderPurchaseRequestPenawaran::where('id_tender_purchase_request_group_rekanan',$getDataTender->id)->where('tender_purchase_request_penawarans.penawaran',$penawaran)->get();
        foreach ($getDataPenawarans as $key => $value) {
            # code...
            $status_approval = Approval::where([['document_id','=',$value->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran']])->first();
            
            if($status_approval->approval_action_id == 2)
            {
                array_push($checkStatus,0);
            }
            if($status_approval->approval_action_id == 6)
            {
                $check_pemenang_tender = TenderMenangPR::where('id_penawaran',$value->id)->first();
                if($check_pemenang_tender != null)
                {
                    $pemenang_tender = $check_pemenang_tender->tender_purchase_request_group_rekanan_detail->rekanan->name;
                    array_push($checkStatus, 1);
                }
            }


            $rekanan_name = $value->tender_purchase_request_group_rekanan_detail->rekanan->name;
            $ppn = $value->tender_purchase_request_group_rekanan_detail->rekanan->ppn;
            $data_rekanan[]=$rekanan_name."-".$value->rekanan_id.'-'.$ppn;
            foreach ($value->details as $kunci => $each) {
                $arr = [
                    $rekanan_name => number_format($each->nilai,2,".",",")
                ];
                $all_data[$each->item->name.'-'.$each->brand->name.'-'.$each->volume.'-'.$each->satuan->name][] = $arr;
            }
        }
        
        array_splice($data_rekanan, 0, 0, "OE-0-10");

        $join_data_rekanan = array_merge($data_rekanan,$data_rekanan);       
        $join_data_rekanan = array_merge($join_data_rekanan,$data_rekanan);

        $checkPemenang = TenderMenangPR::where('tender_purchase_group_rekanan_id',$getDataTender->id)->orderBy("id","desc")->first();

        // $penawaran_id = TenderPurchaseRequestGroupR::where('no',$id)->first();

        $tenderPembayaran = TenderPurchaseRequestPenawaran::rightJoin('metode_pembayarans','metode_pembayarans.id','tender_purchase_request_penawarans.id_metode_pembayaran')->where('penawaran', $penawaran)->where('id_tender_purchase_request_group_rekanan', $getDataTender->id)->select('tender_purchase_request_penawarans.id as id_penawaran','tender_purchase_request_penawarans.rekanan_id','tender_purchase_request_penawarans.id_metode_pembayaran','metode_pembayarans.name as name_pembayaran','tender_purchase_request_penawarans.lama_cicilan','tender_purchase_request_penawarans.DP')->get();

        $metode_pembayaran = DB::table("metode_pembayarans")->select("*")->get();
        $item_tender = TenderPurchaseRequestGroupDetail::where('tender_purchase_request_groups_id',$getDataTender->tender_purchase_request_group_id)->get();
        // return $item_tender[0]->detail_pr->item_project->item->name;
        // return $tenderPembayaran;
        $description_reject_approval_history = [];
        foreach ($tenderPembayaran as $key => $value) {
            # code...
            $description_approval_history = ApprovalHistory::where("document_id",$value->id_penawaran)->where("document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran")->get();

            // return $description_approval_history[0]->document->tender_purchase_request_group_rekanan_detail->rekanan->name;

            foreach ($description_approval_history as $key => $nilai) {
                # code...
                if($nilai->description != NULL){
                    $arr = [
                            "name_supplier" => $nilai->document->tender_purchase_request_group_rekanan_detail->rekanan->name,
                            "description" => $nilai->description,
                            "tanggal" => $nilai->created_at,
                    ];

                    $description_reject_approval_history[]=$arr;
                }

                // return $arr;

            }
        }

        // foreach ($description_reject_approval_history as $key => $row) {
        //     $name_supplier[$key]  = $row['name_supplier'];
        //     $description[$key] = $row['description'];
        //     $tanggal[$key] = $row['tanggal'];
        // }

        // $name_supplier  = array_column($description_reject_approval_history, 'name_supplier');
        // $description = array_column($description_reject_approval_history, 'description');
        // $tanggal = array_column($description_reject_approval_history, 'tanggal');



        // $description_reject_approval_history = array_multisort($tanggal, SORT_DESC, $name_supplier, SORT_ASC, $description, SORT_ASC, $description_reject_approval_history);

        // return $description_reject_approval_history;

        return view('tenderpurchaserequest::detailPenawaran',compact('result','data_rekanan','join_data_rekanan','user','project','getDataTender','checkStatus','checkPemenang','penawaran','tenderPembayaran','metode_pembayaran','item_tender','getDataTender','description_reject_approval_history'));
   }

   public function tunjuk_pemenang(Request $request)
   {
        $stat = false;
        
        
        return response()->json($stat);
   }


   public function approvePenawaran(Request $request)
   {
        $stat = false;
        $id_penawaran = $request->id;
        $updateApproved = Approval::where([['document_id','=',$id_penawaran],['document_type','LIKE','%TenderPurchaseRequestPenawaran']])->update(['approval_action_id'=>6]);

        if($updateApproved)
        {
            //$stat = true;

            $tender_penawaran = TenderPurchaseRequestPenawaran::find($id_penawaran);
            $department_id = TenderPurchaseRequest::where('penawaran_no',$tender_penawaran->no_tender)->get()[0]->tender_group->detail->detail_pr->pr->department_id;

            $no_po = Document::new_number('PO', $department_id);
            $rekanan_id = $tender_penawaran->rekanan_id;

            //buat po
            $createPO = PurchaseOrder::create([
                "no"=>$no_po,"rekanan_id"=>$rekanan_id,"rekanan_name"=>"","description"=>""
            ]);

            if($createPO)
            {
                //buat detail po
                foreach ($tender_penawaran->details as $key => $value) {
                    # code...
                    $checkItemProject = ItemProject::where([['item_id','=',$value->item_id],['project_id','=',$request->session()->get('project_id')]])->first();
                    if($checkItemProject != null)
                    {
                        //buat detail po
                       /* $createDetail = PurchaseOrderDetail::create([
                            "purchaseorder_id"=>$createPO->id,
                            "item_id"=>$value->item_id,
                            "brand_id"=>$value->brand_id,
                            "quantity"=>,
                            "satuan_id"=>$value->item_satuan_id,
                            "harga_satuan"=>$value->nilai,
                            "ppn",
                            "pph",
                            "description"
                        ]);*/
                    }
                    else
                    {
                        //buat item proyek dan buat po
                    }
                }
            }
            
        }

        return response()->json($stat);
   }

   public function lanjutTawar(Request $request)
   {
        $stat = false;
        $id_penawaran = $request->id;
        $updateApproved = Approval::where([['document_id','=',$id_penawaran],['document_type','LIKE','%TenderPurchaseRequestPenawaran']])->update(['approval_action_id'=>4]);

        if($updateApproved)
        {
            $stat = true;
        }

        return response()->json($stat);
   }

   public function request_approval(Request $itemUmum){
            $id = $itemUmum->id;

            $checkifopen = Approval::where([['document_id','=',$id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup']])->first();
            if($checkifopen != null && $checkifopen->approval_action_id == 1)
            {
                $approval = Approval::where([['document_id','=',$id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup']])->update(['approval_action_id'=>2]);
                return redirect("/tenderpurchaserequest/pengelompokanDetail/?id=". $id);
            }
            else
            {
                return back()->withErrors(['Status Sudah Berubah '.$checkifopen->status->description]);
            }

    }

    public function request_approval_penawaran(Request $request)
    {
        $project_id = $request->session()->get('project_id');
        $idtender = $request->tenderid;
        $idrekanan = $request->rekananid;
        $penawaran = $request->penawaran_ke;

        $tender = TenderPurchaseRequestGroupRekanan::find($idtender);
        $getDataPenawarans = TenderPurchaseRequestPenawaran::where('id_tender_purchase_request_group_rekanan',$idtender)->get();

         // foreach ($getDataPenawarans as $key => $value) {
         //     # code...
         //    $approval = Approval::where([['document_id','=',$value->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran']])->update(['approval_action_id'=>2]);
         // }

        $project_id = $request->session()->get('project_id');

        $penawaran_id = TenderPurchaseRequestPenawaran::where([['rekanan_id','=',$idrekanan],['id_tender_purchase_request_group_rekanan','=',$idtender],['penawaran','=',$penawaran]])->first();

        $approval = Approval::where([['document_id','=',$penawaran_id->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran']])->update(['approval_action_id'=>2]);

        $approval = Approval::where([['document_id','=',$penawaran_id->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran']])->first();

        ApprovalHistory::where("approval_id",$approval->id)
                                   ->where("approval_action_id",1)
                                   ->delete();

        CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran',$project_id);

        TenderMenangPR::where('tender_purchase_group_rekanan_id',$idtender)->delete();

        $check_if_record_exist = TenderMenangPR::where('tender_purchase_group_rekanan_id',$idtender)->first();

        // return $check_if_record_exist;
       
        if($check_if_record_exist == null)
        {
            $createTenderMenang = TenderMenangPR::create([
                'rekanan_id'=>$idrekanan,
                'no'=>'TENDER MENANG',
                'project_for_id'=>$project_id,
                'tender_purchase_group_rekanan_id'=>$idtender,
                'id_penawaran'=>$penawaran_id->id,
                'description'=>'Usulan Pemenang',
                'status_usulan'=>1,
                'status_pemenang'=>0
            ]);

            if($createTenderMenang)
            {
                return redirect("/tenderpurchaserequest/detailTender/?id=". $tender->no."&penawaran=".$penawaran)->withErrors(['Usulan Berhasil Di Simpan']);
            }
        }

         return redirect("/tenderpurchaserequest/detailTender/?id=". $tender->no."&penawaran=".$penawaran);
    }

    public function add_oe_pr(Request $request)
    {   
        $results = [];
        $id = $request->id;
        $project_id = $request->session()->get('project_id');
        $project = Project::find($project_id);
        $user = Auth::user();
        $itemSiapTender =   TenderPurchaseRequestGroup::select("tender_purchase_request_groups.id","tender_purchase_request_groups.no","items.name as itemName","brands.name as brandName","purchaserequest_details.item_id","purchaserequest_details.brand_id",DB::raw("sum(purchaserequest_details.quantity) as totalqty"),"item_satuans.id as satuan_id","item_satuans.name as satuanName", "tender_purchase_request_groups.description")
        ->groupBy("tender_purchase_request_groups.id","tender_purchase_request_groups.no","items.name","brands.name","purchaserequest_details.item_id","purchaserequest_details.brand_id","item_satuans.id","item_satuans.name", "tender_purchase_request_groups.description")
        ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
        ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
        ->join("brands","brands.id","purchaserequest_details.brand_id")
        ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
        ->join("item_projects","item_projects.id","purchaserequest_details.item_id")
        ->join("items","items.id","item_projects.item_id")
        ->join("approvals","tender_purchase_request_groups.id","=","approvals.document_id")
        ->whereNotIn("tender_purchase_request_groups.id",DB::table("tender_purchase_request_group_rekanans")->select("tender_purchase_request_group_id"))
        ->where('tender_purchase_request_groups.no',$id)
        ->where('tender_purchase_request_groups.project_for_id',$project_id)
        ->where('approvals.approval_action_id',6)
        ->where('item_projects.project_id',$project_id)
        ->orderBy('items.name')
        ->get();

        foreach ($itemSiapTender as $key => $value) {
            # code...
            $objprice = ItemPrice::where([['item_id','=',$value->item_id],['item_satuan_id','=',$value->satuan_id]])->orderBy('created_at','desc')->first();
            $harga_satuan = 0;
            $status_ppn = 0;
            if($objprice != null)
            {
                $harga_satuan = $objprice->price;
                $status_ppn = $objprice->ppn;
            }

            $max_price = ItemPrice::where('item_id',$value->item_id)->max('price');
            $max_price = is_null($max_price) ? 0 : $max_price;
            $min_price = ItemPrice::where('item_id',$value->item_id)->min('price');
            $min_price = is_null($min_price) ? 0 : $min_price;
            $arr = [
                'tprg_id'=>$value->id,
                'tprg_no'=>$value->no,
                'tprg_itemname'=>$value->itemName,
                'tprg_totalqty'=>$value->totalqty,
                'tprg_brand'=>$value->brandName,
                'tprg_item_id'=>$value->item_id,
                'tprg_satuan'=>$value->satuanName,
                'tprg_brand_id'=>$value->brand_id,
                'status_ppn'=>$status_ppn,
                'tprg_price'=>$harga_satuan,
                'range'=>number_format($min_price,2,".",",").' - '.number_format($max_price,2,".",",")
            ];

            array_push($results, $arr);
        }


        //rekanan
        $rekanan_pr =   DB::table("tender_purchase_request_groups")
                            ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                            ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                            ->leftJoin("rekanans as r1","r1.id","purchaserequest_details.rec_1")
                            ->leftJoin("rekanans as r2","r2.id","purchaserequest_details.rec_2")
                            ->leftJoin("rekanans as r3","r3.id","purchaserequest_details.rec_3")
                            ->join("approvals","tender_purchase_request_groups.id","=","approvals.document_id")
                            ->whereNotIn("tender_purchase_request_groups.id",DB::table("tender_purchase_request_group_rekanans")->select("tender_purchase_request_group_id"))
                            ->select("r1.name as rekanan1","r1.id as rec1_id","r2.name as rekanan2","r2.id as rec2_id","r3.id as rec3_id","r3.name as rekanan3")
                            ->groupBy("r1.id","r2.id","r3.id","r1.name","r2.name","r3.name")
                            ->where('tender_purchase_request_groups.no',$id)
                            ->where('approvals.approval_action_id',6)
                            ->orderBy("purchaserequest_details.id")
                            ->get();
                            
        $tender_purchase_request = TenderPurchaseRequestGroup::where('no',$id)->first();
        $all_rekanans = Rekanan::all();

        return view('tenderpurchaserequest::add_oe_pr_group',compact('user','project','results','rekanan_pr','all_rekanans','tender_purchase_request'));
    }

    public function store_oe(Request $request)
    {

        $arr_rekanan_usulan = json_decode($request->_alldatasend);
        $tprg_id = $request->tprg_id;
        $user_id = Auth::user()->id;
        $project_id = $request->session()->get('project_id');
        $pt_id = ProjectPtUser::where([['user_id','=',$user_id],['project_id','=',$project_id]])->first()->pt_id;
        
        $aanwijzing_date = $request->aanwijzing;
        $penawaran1_date = $request->penawaran1;
        $klarifikasi1_date = $request->klarifikasi1;

        $penawaran2_date = $request->penawaran2;
        $klarifikasi2_date = $request->klarifikasi2;
        $penawaran3_date = $request->penawaran3;

        $negosiasi_date = $request->negosiasi_date;
        
        $createTenderPurchaseRequest = TenderPurchaseRequestGroupRekanan::create([
            "project_for_id"=>$project_id,
            "tender_purchase_request_group_id"=>$tprg_id,
            "no"=> CreateDocument::createDocumentNumber('TGR',2,$project_id,$user_id),
            "status_pemenang"=>0,
            'aanwijzing_date'=>$aanwijzing_date,
            'penawaran1_date'=>$penawaran1_date,
            'klarifikasi1_date'=>$klarifikasi1_date,
            'penawaran2_date'=>$penawaran2_date,
            'klarifikasi2_date'=>$klarifikasi2_date,
            'penawaran2_date'=>$penawaran2_date,
            'negosiasi_date'=>$negosiasi_date
        ]);

        //filter rekanan usulan
        if($createTenderPurchaseRequest)
        {

            CreateDocument::make_approval('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan',$createTenderPurchaseRequest->id,$project_id,$pt_id);
            for ($count=0; $count < count($arr_rekanan_usulan) ; $count++) { 
                # code...
                TenderPurchaseRequestGroupRekananDetails::create([
                    'tender_purchase_request_group_rekanan_id'=>$createTenderPurchaseRequest->id,
                    'rekanan_id'=>$arr_rekanan_usulan[$count]
                ]);
            }

            $stat = true;
        }
        return redirect('/tenderpurchaserequest/indexOE');
    }

    public function tambah_rekanan_oe(Request $request)
    {


        $stat = false;
        $id = $request->id;
        $rekanan_id = $request->id_rekanan_usulan;
        $create = TenderPurchaseRequestGroupRekananDetails::create(['tender_purchase_request_group_rekanan_id'=>$id,'rekanan_id'=>         $rekanan_id]);

        if($create)
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function update_rekanan(Request $request)
    {
        $stat =0;
        $name = $request->name;
        $pk = $request->pk;
        // return $pk;
        $value = $request->value;
        $updated = TenderPurchaseRequestGroupRekananDetails::find($pk)->update([$name=>$value]);
        if($updated)
        {
            $stat = 1;
        }

        return response()->json(['return'=>$stat]);
    }

    public function rekananSource()
    {
        // $all_rekanans = Rekanan::all();
        $projects = Rekanan::select('id','name')->get();
        // return $projects;
        $obj = [];
        foreach ($projects as $key => $value) {
            # code...
            $obj[$value->id] = $value->name;
        }
        return response()->json($obj);
    }

    public function indexOE(Request $request)
    {
        $user = Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        return view('tenderpurchaserequest::indexOE',compact("user","project"));
    }

    public function getItemOE(Request $request)
    {
        $project_id = $request->session()->get('project_id');
        $itemSiapTender =   DB::table("tender_purchase_request_group_rekanans")
                            ->join('tender_purchase_request_groups','tender_purchase_request_group_rekanans.tender_purchase_request_group_id','tender_purchase_request_groups.id')
                            ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                            ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                            ->join("brands","brands.id","purchaserequest_details.brand_id")
                            ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
                            ->join("item_projects","item_projects.id","purchaserequest_details.item_id")
                            ->join("items","items.id","item_projects.item_id")
                            ->join("approvals","tender_purchase_request_group_rekanans.id","=","approvals.document_id")
                            ->join("approval_actions","approval_actions.id","=","approvals.approval_action_id")
                            ->where('approvals.document_type','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan')
                            ->where('tender_purchase_request_group_rekanans.deleted_at',null)
                            ->where('tender_purchase_request_group_rekanans.project_for_id',$project_id)
                            ->select("items.kode","tender_purchase_request_group_rekanans.no","items.name as itemName","brands.name as brandName",DB::raw("(sum(purchaserequest_details.quantity)) as totalqty"),"item_satuans.name as satuanName","tender_purchase_request_groups.description", "approval_actions.description as approvDescription")->groupBy("items.kode","tender_purchase_request_group_rekanans.no","items.name","brands.name","item_satuans.name","tender_purchase_request_groups.description","approval_actions.description")->get();

        return datatables()->of($itemSiapTender)->toJson();
    }

    public function detail_oe(Request $request)
    {

        $results = [];
        $id = $request->id;
        // return $id;
        $project = Project::find($request->session()->get('project_id'));
        $user = Auth::user();
        // $tender_purchase_request = TenderPurchaseRequestGroup::where('no',$id)->first();
        
        $itemSiapTender =   TenderPurchaseRequestGroupRekanan::select("items.kode","tender_purchase_request_group_rekanans.no","items.name as itemName","brands.name as brandName","purchaserequest_details.item_id","purchaserequest_details.brand_id",DB::raw("(sum(purchaserequest_details.quantity)) as totalqty"),"item_satuans.name as satuanName", "tender_purchase_request_groups.description")
        ->groupBy("tender_purchase_request_group_rekanans.no","items.name","brands.name","item_satuans.name","tender_purchase_request_groups.description","purchaserequest_details.item_id","purchaserequest_details.brand_id","items.kode")
        ->join("tender_purchase_request_groups",'tender_purchase_request_group_rekanans.tender_purchase_request_group_id','tender_purchase_request_groups.id')
        ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
        ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
        ->join('purchaserequests','purchaserequests.id','purchaserequest_details.purchaserequest_id')
        ->join("brands","brands.id","purchaserequest_details.brand_id")
        ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
        ->join("item_projects","item_projects.id","purchaserequest_details.item_id")
        ->join("items","items.id","item_projects.item_id")
        ->join("approvals","tender_purchase_request_group_rekanans.id","=","approvals.document_id")
        ->where('tender_purchase_request_group_rekanans.no',$id)
        ->where('approvals.document_type','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan')
        ->get();

        // return $itemSiapTender;


        foreach ($itemSiapTender as $key => $value) {
            # code...
            $objprice = is_null(ItemPrice::where('item_id',$value->item_id)->orderBy('created_at','desc')->first()) ? 0 : ItemPrice::where('item_id',$value->item_id)->orderBy('created_at','desc')->first()->price;

            $arr = [
                'tprg_no'=>$value->no,
                'tprg_kode'=>$value->kode,
                'tprg_itemname'=>$value->itemName,
                'tprg_totalqty'=>$value->totalqty,
                'tprg_brand'=>$value->brandName,
                'tprg_item_id'=>$value->item_id,
                'tprg_satuan'=>$value->satuanName,
                'tprg_brand_id'=>$value->brand_id,
                'tprg_price'=>$objprice
            ];

            array_push($results, $arr);
        }

        $rekanans =   DB::table("tender_purchase_request_group_rekanans")
                            ->join('tender_purchase_request_group_rekanan_details','tender_purchase_request_group_rekanans.id','tender_purchase_request_group_rekanan_details.tender_purchase_request_group_rekanan_id')
                            ->join("rekanans as r1","r1.id","tender_purchase_request_group_rekanan_details.rekanan_id")
                            ->join("approvals","tender_purchase_request_group_rekanans.id","=","approvals.document_id")
                            ->select("r1.name as rekanan1", "r1.id as id1","tender_purchase_request_group_rekanan_details.id as id_detail")
                            ->groupBy("r1.name","r1.id","tender_purchase_request_group_rekanan_details.id")
                            ->where('tender_purchase_request_group_rekanans.no',$id)
                            ->where('tender_purchase_request_group_rekanans.deleted_at',null)
                            ->where('tender_purchase_request_group_rekanan_details.deleted_at',null)
                            ->get();
        // return $rekanans;
       

        $tender_purchase_request_group_rekanans = TenderPurchaseRequestGroupRekanan::where('no',$id)->first();
        // return $tender_purchase_request_group_rekanans->id;
        $all_rekanans = Rekanan::all();

        return view('tenderpurchaserequest::detailOE',compact("user","project","results","rekanans",'tender_purchase_request_group_rekanans','all_rekanans'));
    }
        

    public function requestapproveOE(Request $request)
    {
        $project_id = $request->session()->get('project_id');
        $id = $request->id;
        $tender_purchase_request_group_rekanans = TenderPurchaseRequestGroupRekanan::find($id);
        $updateApproval = Approval::where([['document_id','=',$id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']])->update(['approval_action_id'=>2]);

        $approval = Approval::where([['document_id','=',$id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']])->first();

        ApprovalHistory::where("approval_id",$approval->id)
                                   ->where("approval_action_id",1)
                                   ->delete();

        CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan',$project_id);

        if($updateApproval)
        {
            return redirect('/tenderpurchaserequest/detail_oe?id='.$tender_purchase_request_group_rekanans->no);
        }
    }

    public function requestapproveOEfromIndex(Request $request)
    {
        $stat = false;
        $project_id = $request->session()->get('project_id');
        $arr_id = json_decode($request->id);
        if(count($arr_id) > 0)
        {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $tprg = TenderPurchaseRequestGroupRekanan::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']]);

                if($approval_obj->first()->approval_action_id == 1)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>2]);

                    $approval = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']])->first();

                    ApprovalHistory::where("approval_id",$approval->id)
                                               ->where("approval_action_id",1)
                                               ->delete();

                    CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan',$project_id);

                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }


         return response()->json($stat);
    }

    public function approveOEfromIndex(Request $request)
    {
        $stat = false;
         $arr_id = json_decode($request->id);
         if(count($arr_id) > 0)
         {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $tprg = TenderPurchaseRequestGroupRekanan::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']]);

                if($approval_obj->first()->approval_action_id == 2)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>6]);

                    $approval = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']])->first();

                    ApprovalHistory::where("approval_id",$approval->id)
                                               ->where("approval_action_id",2)
                                               ->delete();

                    CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan',$project_id);

                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }


         return response()->json($stat);
    }

    public function undo_request_oe_fromindex(Request $request)
    {
        $stat = false;
        $project_id = $request->session()->get('project_id');
        $arr_id = json_decode($request->id);
         
        $tprg = TenderPurchaseRequestGroupRekanan::where('no',$arr_id[0])->first();
        if(count($arr_id) > 0)
        {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $tprg = TenderPurchaseRequestGroupRekanan::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']]);

                if($approval_obj->first()->approval_action_id == 2)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>1]);

                    $approval = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']])->first();

                    ApprovalHistory::where("approval_id",$approval->id)
                                               ->where("approval_action_id",2)
                                               ->delete();

                    CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan',$project_id);

                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }


         return response()->json($stat);
    }

    public function undo_approve_oe_fromindex(Request $request)
    {
        $stat = false;
         $arr_id = json_decode($request->id);
         
         $tprg = TenderPurchaseRequestGroupRekanan::where('no',$arr_id[0])->first();
         if(count($arr_id) > 0)
         {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $tprg = TenderPurchaseRequestGroupRekanan::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']]);

                if($approval_obj->first()->approval_action_id == 6)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>2]);

                    $approval = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']])->first();

                    ApprovalHistory::where("approval_id",$approval->id)
                                               ->where("approval_action_id",6)
                                               ->delete();

                    CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan',$project_id);

                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }


         return response()->json($stat);
    }

    public function approveOE(Request $request)
    {
        $id = $request->id;
         $tender_purchase_request_group_rekanans = TenderPurchaseRequestGroupRekanan::find($id);
         $approval_obj = Approval::where([['document_id','=',$id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']]);
         if($approval_obj->first()->approval_action_id == 2)
         {
            $updateApproval = $approval_obj->update(['approval_action_id'=>6]);

            $approval = Approval::where([['document_id','=',$id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan']])->first();

            ApprovalHistory::where("approval_id",$approval->id)
                                       ->where("approval_action_id",2)
                                       ->delete();

            CreateDocument::make_approval_history($approval->id,'Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan',$project_id);

            if($updateApproval)
            {
                
                return redirect('/tenderpurchaserequest/detail_oe?id='.$tender_purchase_request_group_rekanans->no);
            }
         }
    }

    // public function approveOEfromIndex(Request $request)
    // {

    // }

    public function requestApprovalPengelompokan(Request $request)
    {
         $id = $request->id;

         $tprg = TenderPurchaseRequestGroup::find($id);
        $req_approval = Approval::where([['document_id','=',$id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup']])->update(['approval_action_id'=>2]);
        if($req_approval)
        {
            return redirect('/tenderpurchaserequest/pengelompokanDetail?id='.$tprg->no);
        }
    }

     public function requestApprovalPengelompokanFromIndex(Request $request)
    {
         $stat = false;
         $arr_id = json_decode($request->id);
         if(count($arr_id) > 0)
         {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $tprg = TenderPurchaseRequestGroup::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup']]);

                if($approval_obj->first()->approval_action_id == 1)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>2]);

                    $PRDApproval = DB::table("approvals")->where("document_id",$tprg->id)
                                                         ->where("document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup")
                                                         ->select('*')
                                                         ->get();

                    $AH = new ApprovalHistory;
                    $AH->user_id = Auth::user()->id;
                    $AH->approval_id = $PRDApproval[0]->id;
                    $AH->approval_action_id = $PRDApproval[0]->approval_action_id;

                    $AH->document_id = $PRDApproval[0]->document_id;
                    $AH->document_type = $PRDApproval[0]->document_type;
                    $status = $AH->save();
                    
                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }


         return response()->json($stat);
    }

    public function ApprovePengelompokanFromIndex(Request $request)
    {
         $stat = false;
         $arr_id = json_decode($request->id);
         if(count($arr_id) > 0)
         {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $tprg = TenderPurchaseRequestGroup::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup']]);

                if($approval_obj->first()->approval_action_id == 2)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>6]);

                    $PRDApproval = DB::table("approvals")->where("document_id",$tprg->id)
                                                         ->where("document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup")
                                                         ->select('*')
                                                         ->get();

                    $AH = new ApprovalHistory;
                    $AH->user_id = Auth::user()->id;
                    $AH->approval_id = $PRDApproval[0]->id;
                    $AH->approval_action_id = $PRDApproval[0]->approval_action_id;

                    $AH->document_id = $PRDApproval[0]->document_id;
                    $AH->document_type = $PRDApproval[0]->document_type;
                    $status = $AH->save();

                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }



         return response()->json($stat);
    }

    public function approve_pengelompokan(Request $request){
        $id = $request->id;
         $tprg = TenderPurchaseRequestGroup::find($id);

         $approved_tprg = Approval::where([['document_id','=',$id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup']])->update(['approval_action_id'=>6]);

        if($approved_tprg)
        {
            return redirect('/tenderpurchaserequest/pengelompokanDetail?id='.$tprg->no);
        }
    }

    public function undo_request_pengelompokan_fromIndex(Request $request)
    {
         $stat = false;
         $arr_id = json_decode($request->id);
         if(count($arr_id) > 0)
         {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $tprg = TenderPurchaseRequestGroup::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup']]);

                if($approval_obj->first()->approval_action_id == 2)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>1]);

                    $PRDApproval = DB::table("approvals")->where("document_id",$tprg->id)
                                                         ->where("document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup")
                                                         ->select('*')
                                                         ->get();

                    $AH = new ApprovalHistory;
                    $AH->user_id = Auth::user()->id;
                    $AH->approval_id = $PRDApproval[0]->id;
                    $AH->approval_action_id = $PRDApproval[0]->approval_action_id;

                    $AH->document_id = $PRDApproval[0]->document_id;
                    $AH->document_type = $PRDApproval[0]->document_type;
                    $status = $AH->save();

                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }


         return response()->json($stat);
    }

    public function undo_approve_pengelompokan_fromIndex(Request $request)
    {
         $stat = false;
         $arr_id = json_decode($request->id);
         if(count($arr_id) > 0)
         {
            $checkInsert = 0;
            for ($i=0; $i < count($arr_id) ; $i++) { 
                # code...
                $tprg = TenderPurchaseRequestGroup::where('no',$arr_id[$i])->first();
                $approval_obj = Approval::where([['document_id','=',$tprg->id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup']]);

                if($approval_obj->first()->approval_action_id == 6)
                {
                    $change_status = $approval_obj->update(['approval_action_id'=>2]);

                    $PRDApproval = DB::table("approvals")->where("document_id",$tprg->id)
                                                         ->where("document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup")
                                                         ->select('*')
                                                         ->get();

                    $AH = new ApprovalHistory;
                    $AH->user_id = Auth::user()->id;
                    $AH->approval_id = $PRDApproval[0]->id;
                    $AH->approval_action_id = $PRDApproval[0]->approval_action_id;

                    $AH->document_id = $PRDApproval[0]->document_id;
                    $AH->document_type = $PRDApproval[0]->document_type;
                    $status = $AH->save();

                    if($change_status)
                    {
                        $checkInsert++;
                    }
                }
            }

            if($checkInsert > 0)
            {
                $stat = true;
            }
         }


         return response()->json($stat);
    }

    public function undo_request_pengelompokan(Request $request)
    {
         $id = $request->id;
         $tprg = TenderPurchaseRequestGroup::find($id);

         $approved_tprg = Approval::where([['document_id','=',$id],['document_type','=','Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup']])->update(['approval_action_id'=>1]);

        if($approved_tprg)
        {
            return redirect('/tenderpurchaserequest/pengelompokanDetail?id='.$tprg->no);
        }
    }

    public function delete_rekanan_oe(Request $request)
    {
        $stat = false;
        $id = $request->id;
        $rekanan_id = $request->id_rekanan;
        // $delete = TenderPurchaseRequestGroupRekananDetails::find($id_detail)->delete();
        $delete = TenderPurchaseRequestGroupRekananDetails::where('tender_purchase_request_group_rekanan_id',$id)
                                                             ->where('rekanan_id',$rekanan_id)
                                                             ->delete();

        if($delete)
        {
            $stat = true;
        }

        return response()->json($stat);
    }

    public function penetapan_pembayaran(Request $request)
    {   
        $id = $request->id;
        $project_id = $request->session()->get('project_id');
        $user = Auth::user();
        $project = Project::find($project_id);
        //$result_penawaran = [];
        $result_penawaran = DB::table("tender_purchase_request_group_rekanans as tpr")->select("tpr.id","tpr.no")->where('id',$id)
        ->where('project_for_id',$project_id)
        ->whereNotIn('tpr.id',DB::table("tender_menang_pr")->select('tender_purchase_group_rekanan_id'))->where('deleted_at',null)->first();
        // return $result_penawaran;
        $metode_pembayaran = DB::table("metode_pembayarans")->select("*")->get();

        return view('tenderpurchaserequest::penetapanMetodePembayaranPenawaran',compact("user","project","result_penawaran","metode_pembayaran","id"));
    }

    public function storePenetapan(Request $request){

        // $createHeader = '';
        $project_id = $request->session()->get('project_id');
        $user_id = Auth::user()->id;
        date_default_timezone_set('asia/jakarta');
        $date = date("Y-m-d");

        $id = $request->id_tender;
        $rekanan_id = $request->supplier;
        $metode_pembayaran = $request->cara_bayar;
        $lama_cicilan = $request->termin;
        $DP = $request->percentage_dp;
        // $penawaran = $request->penawaran_ke;

        // $total_nilai = 0;
        // $department_id = 2;
        $terminCicil = json_decode($request->termin_cicil);

        $all_detail = json_decode($request->all_send);

        // $tpr = TenderPurchaseRequestGroupRekanan::find($id_tender_penawaran);
        // $no_tender = $tpr->no;
        // $no_document = CreateDocument::createDocumentNumber('TDR',2,$project_id,$user_id);

        // $check_if_record_exist = TenderPurchaseRequestPenawaran::where([['id_tender_purchase_request_group_rekanan','=',$id_tender_penawaran],['rekanan_id','=',$rekanan_id]])->first();
        // if($penawaran == 1){
        //     $penawaran_date = TenderPurchaseRequestGroupRekanan::where('id',$id_tender_penawaran)->select('penawaran1_date','klarifikasi1_date')->first();
        // }elseif($penawaran == 2){
        //     $penawaran_date = TenderPurchaseRequestGroupRekanan::where('id',$id_tender_penawaran)->select('penawaran2_date','klarifikasi2_date')->first();
        // }elseif($penawaran == 3){
        //     $penawaran_date = TenderPurchaseRequestGroupRekanan::where('id',$id_tender_penawaran)->select('penawaran3_date','negosiasi_date as klarifikasi3_date')->first();
        // }

        // if(($penawaran_date->penawaran1_date > $date)&&($date < $penawaran_date->klarifikasi1_date))
        // {


            // $createHeader = DB::table('tender_purchase_request_penawaran_pembayarans')->insert(['no'=>$no_document,
            //     'id_tender_purchase_request_group_rekanan'=>$id_tender_penawaran,
            //     'project_for_id'=>$project_id,
            //     'rekanan_id'=>$rekanan_id,
            //     'date'=>date('Y-m-d'),
            //     'id_metode_pembayaran'=>$metode_pembayaran,
            //     'DP'=>$DP,
            //     'lama_cicilan'=>$lama_cicilan,
            //     'penawaran'=>$penawaran
            // ]);
            

            //save pembayaran
            if(count($terminCicil) > 0)
            {
                //termin
                for ($counter=0; $counter < count($terminCicil); $counter++) { 
                    # code...
                   
                    DB::table('tender_purchase_request_penawaran_pembayarans')->insert([
                        'tender_purchase_request_group_rekanan_id'=>$id,
                        'project_for_id'=>$project_id,
                        'id_metode_pembayaran'=> $metode_pembayaran,
                        'date'=>$terminCicil[$counter]->tanggal_cicil,
                        'besar'=>$terminCicil[$counter]->percentage_cicil,
                        'DP'=>$DP,
                        'proses_ke'=>$counter+1
                    ]);
                }
                
            }else{
                    for($count = 0;$count < count($all_detail); $count++)
                      {
                          // $createDetail = TenderPurchaseRequestPenawaranDetail::create([
                          //     'item_id'=>$all_detail[$count]->item_id,
                          //     'item_satuan_id'=>$all_detail[$count]->item_satuan_id,
                          //     'brand_id'=>$all_detail[$count]->brand_id,
                          //     'tender_penawaran_id'=>$createHeader->id,
                          //     'nilai'=>$all_detail[$count]->nilai,
                          //     'volume'=>$all_detail[$count]->volume,
                          //     'ppn'=>$all_detail[$count]->ppn,
                          //     /*,
                          //     'disc'=>$all_detail[$count]->disc*/
                          //     'description'=>$all_detail[$count]->deskripsi
                          // ]);

                          if(count($terminCicil) ==0)
                          {
                            for ($i=0; $i < count($all_detail[$count]->cod_value) ; $i++) { 


                                $createCOD = DB::table('tender_purchase_request_penawaran_pembayarans')->insert([
                                    'tender_purchase_request_group_rekanan_id'=>$id,
                                    'id_metode_pembayaran'=> $metode_pembayaran,
                                    'project_for_id'=>$project_id,
                                    'date'=>$all_detail[$count]->cod_value[$i]->tanggal_cod,
                                    'besar'=>$all_detail[$count]->cod_value[$i]->qty,
                                    'item_id'=>$all_detail[$count]->item_id,
                                    'item_satuan_id'=>$all_detail[$count]->item_satuan_id,
                                    'brand_id'=>$all_detail[$count]->brand_id,
                                    'DP'=>$DP,
                                    'proses_ke'=>$all_detail[$count]->cod_value[$i]->cod_ke]);

                            }
                            
                          }

                          // $total_nilai +=$all_detail[$count]->nilai;
                      }

              // $createapproval_open = Approval::create(['approval_action_id'=>1,
              //     'document_id'=>$createHeader->id,
              //     'document_type'=>"Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran",
              //     'total_nilai'=>$total_nilai
              // ]);

              // if($createapproval_open){
                  // return redirect("/tenderpurchaserequest/index_penawaran");
              // }
          }
        // }
        // else
        // {
        //     return back()->withErrors(['Tidak dalam jadwal Penawaran']);
        // }
          return redirect("/tenderpurchaserequest/index_penawaran");
        
    }

}
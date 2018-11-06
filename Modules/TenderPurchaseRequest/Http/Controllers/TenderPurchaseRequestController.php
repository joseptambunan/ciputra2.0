<?php

namespace Modules\TenderPurchaseRequest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequest;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup;
use Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupDetail;
use Modules\TenderPurchaseRequest\Entities\PurchaseOrder;
use Modules\TenderPurchaseRequest\Entities\PurchaseOrderDetail;
use Modules\Rab\Entities\RabPekerjaan;
use Modules\Approval\Entities\Approval;
use Modules\Project\Entities\Project;


use DB;

class TenderPurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //\App\Helpers\Document::make_approval('Modules\PurchaseRequest\Entities\PurchaseRequest',2);
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));

        $TPR =  DB::table("tender_purchase_requests")
                ->join("approvals","approvals.document_id","tender_purchase_requests.id")
                ->where("approvals.document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequest")
                ->join("approval_actions","approval_actions.id","approvals.approval_action_id")
                ->join("tender_purchase_request_rekanans","tender_purchase_request_rekanans.tender_purchase_request_id","tender_purchase_requests.id")
                ->leftJoin("rekanans","rekanans.id","tender_purchase_request_rekanans.rekanan_id");
        $pemenang = $TPR->select(
                            "tender_purchase_requests.id",
                            "tender_purchase_request_rekanans.is_pemenang",
                            "rekanans.name as rekananName")
                    ->get();
        $TPR = $TPR->select("tender_purchase_requests.id",
                        "tender_purchase_requests.name",
                        "tender_purchase_requests.no",
                        "tender_purchase_requests.final_date",
                        "tender_purchase_requests.description",
                        "approval_actions.description as status",
                        "approvals.approval_action_id")
                ->distinct()
                ->get();
        

        $itemSiapTender =   DB::table("tender_purchase_request_groups")
                            ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                            ->distinct()
                            ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                            ->join("brands","brands.id","purchaserequest_details.brand_id")
                            ->join("item_satuans","item_satuans.id","tender_purchase_request_groups.satuan_id")
                            ->join("items","items.id","purchaserequest_details.item_id") 
                            ->select("tender_purchase_request_groups.id","items.name as itemName","brands.name as brandName","tender_purchase_request_groups.quantity","item_satuans.name as satuanName", "tender_purchase_request_groups.description", "approval_actions.description as approvDescription")
                            ->join("approvals","tender_purchase_request_groups.id","=","approvals.document_id")
                            ->where('approvals.document_type',"Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPengelompokan")
                            ->where('approvals.approval_action_id',6)
                            ->join("approval_actions","approval_actions.id","=","approvals.approval_action_id")
                            ->leftJoin("tender_purchase_requests","tender_purchase_requests.tender_pr_groups_id","tender_purchase_request_groups.id")
                            ->where("tender_purchase_requests.tender_pr_groups_id",NULL)

                            ->get();
        return view('tenderpurchaserequest::index',compact("user","project","TPR","itemSiapTender","pemenang"));
    }
    public function pengelompokan(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));

        $TPR = TenderPurchaseRequest::get();
        //$item = item yang siap di kelompokkan
        $itemSiapKelompok = DB::table("purchaserequest_details")
                ->select("items.name as itemName","purchaserequests.no as prNo","departments.name as departmentName","brands.name as brandName","purchaserequest_details.quantity", "item_satuans.name as satuanName")
                ->orderBy("purchaserequest_details.id","desc")
                ->distinct()
                ->join("approvals","purchaserequest_details.id","=","approvals.document_id")
                ->where('approvals.document_type','=',"Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                ->where('approvals.approval_action_id','=',6)
                ->join("items","purchaserequest_details.item_id","items.id")
                ->orderBy("purchaserequest_details.item_id","asc")
                ->leftJoin("tender_purchase_request_group_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                ->whereNull("tender_purchase_request_group_details.id_purchase_request_detail")
                ->join("purchaserequests","purchaserequests.id","purchaserequest_details.purchaserequest_id")
                ->join("departments","departments.id","purchaserequests.department_id")
                ->join("brands","brands.id","purchaserequest_details.brand_id")
                ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
                ->get();
        $itemSiapTender =   DB::table("tender_purchase_request_groups")
                            ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                            ->distinct()
                            ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                            ->join("brands","brands.id","purchaserequest_details.brand_id")
                            ->join("item_satuans","item_satuans.id","tender_purchase_request_groups.satuan_id")
                            ->join("items","items.id","purchaserequest_details.item_id")
                            ->select("tender_purchase_request_groups.id","items.name as itemName","brands.name as brandName","tender_purchase_request_groups.quantity","item_satuans.name as satuanName", "tender_purchase_request_groups.description", "approval_actions.description as approvDescription")
                            ->join("approvals","tender_purchase_request_groups.id","=","approvals.document_id")
                            ->where('approvals.document_type','=',"Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPengelompokan")
                            ->join("approval_actions","approval_actions.id","=","approvals.approval_action_id")
                            ->get();

        return view('tenderpurchaserequest::pengelompokan',compact("user","project","TPR","itemSiapKelompok","itemSiapTender"));
        
    }public function pengelompokanDetail(Request $request){
        $id = $request->id;
        $project = Project::find($request->session()->get('project_id'));

        $user = \Auth::user();
        $TPR = TenderPurchaseRequest::get();
        //$item = item yang siap di kelompokkan

        $itemUmum =   DB::table("tender_purchase_request_groups")
                            ->where("tender_purchase_request_groups.id",$id)
                            ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                            ->distinct()
                            ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                            ->join("brands","brands.id","purchaserequest_details.brand_id")
                            ->join("item_satuans","item_satuans.id","tender_purchase_request_groups.satuan_id")
                            ->join("items","items.id","purchaserequest_details.item_id")
                            ->select("tender_purchase_request_groups.id","items.name as itemName","items.id as itemId","brands.name as brandName","tender_purchase_request_groups.quantity","item_satuans.name as satuanName", "tender_purchase_request_groups.description")
                            ->get();
                            
        $itemDetil =     DB::table("tender_purchase_request_group_details")
                    ->where("tender_purchase_request_groups_id",$id)
                    ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                    ->join("purchaserequests","purchaserequests.id","purchaserequest_details.purchaserequest_id")
                    ->join("departments","departments.id","purchaserequests.department_id")
                    ->join("itempekerjaans","itempekerjaans.id","purchaserequest_details.itempekerjaan_id")
                    ->join("items","itempekerjaans.id","purchaserequest_details.itempekerjaan_id")
                    ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
                    ->distinct()
                    ->select("purchaserequests.no as prNo","purchaserequest_details.id as prdId","departments.name as dName","itempekerjaans.name as ipName"
                        ,"purchaserequest_details.quantity as prdQuantity","item_satuans.name as isName","item_satuans.id as isId")
                    ->get();
        $itemSatuanTerkecil = DB::table("item_satuans")->where("item_id",$itemUmum[0]->itemId)->orderBy("konversi","asc")->select("id","name","konversi")->first();
        $tmp = [];
        foreach($itemDetil as $v){
            $quantity2 = (int)$v->prdQuantity
            * DB::table("item_satuans")->where("id",$v->isId)->orderBy("konversi","asc")->select("konversi")->first()->konversi
            / $itemSatuanTerkecil->konversi;
            array_push($tmp,$quantity2);
        }
        $itemQuantity = (object)$tmp;
        $status_approve =   DB::table("approvals")
                            ->where("document_id",$id)
                            ->where("document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPengelompokan")
                            ->first()
                            ->approval_action_id;
        $back = $request->back;
        return view('tenderpurchaserequest::pengelompokanDetail',compact("user","project","TPR","itemUmum","itemDetil","id","itemQuantity","itemSatuanTerkecil","status_approve","back"));
    }
    public function pengelompokanAdd(Request $request){
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $TPR = TenderPurchaseRequest::get();
        $idTender = $request->id;
        if(isset($idTender)){
            $itemTender =   DB::table("tender_purchase_request_groups")
                        ->where("tender_purchase_request_groups.id",$idTender)
                        ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                        ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                        ->select("purchaserequest_details.item_id","purchaserequest_details.brand_id")
                        ->first();
            $itemId=$itemTender->item_id;
            $item = DB::table("purchaserequest_details")
                ->select("purchaserequest_details.item_id","items.name")
                ->distinct()
                ->join("approvals","purchaserequest_details.id","=","approvals.document_id")
                ->where('approvals.document_type','=',"Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                ->where('approvals.approval_action_id','=',6)
                ->join("items","purchaserequest_details.item_id","items.id")
                ->where("items.id",$itemId)
                ->orderBy("item_id","asc")
                ->leftJoin("tender_purchase_request_group_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                ->whereNull("tender_purchase_request_group_details.id_purchase_request_detail")
                ->get();
            $description = DB::table("tender_purchase_request_groups")->select("description")->where("id",$idTender)->first()->description;
            $itemBrand = DB::table("brands")->where("id",$itemTender->brand_id)->first()->name;
            return view('tenderpurchaserequest::pengelompokanAdd',compact("user","project","item","itemBrand","itemTender","idTender","description"));
        }else{
            $item = DB::table("purchaserequest_details")
                    ->select("purchaserequest_details.item_id","items.name")
                    ->distinct()
                    ->join("approvals","purchaserequest_details.id","=","approvals.document_id")
                    ->where('approvals.document_type','=',"Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                    ->where('approvals.approval_action_id','=',6)
                    ->join("items","purchaserequest_details.item_id","items.id")
                    ->orderBy("item_id","asc")
                    ->leftJoin("tender_purchase_request_group_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                    ->whereNull("tender_purchase_request_group_details.id_purchase_request_detail")
                    ->get();
            return view('tenderpurchaserequest::pengelompokanAdd',compact("user","project","item"));
        }
    }
    public function pengelompokanStore(Request $request){
        $tender_purchase_request_groups = new TenderPurchaseRequestGroup;
        $cek_data_sama = 0;
        foreach ($request->item_per_description as $v) {
            $tmp = DB::table("tender_purchase_request_group_details")->where("id_purchase_request_detail",$v)->count();
            if($tmp>0)
                $cek_data_sama++;
        } 
        if(isset($request->idTender))   $url = "/tenderpurchaserequest/pengelompokanDetail/?id=$request->idTender";
        else                            $url = "/tenderpurchaserequest/pengelompokan/";

        if($cek_data_sama == 0){
            if(isset($request->idTender)){
                $tenderprg_now =    DB::table("tender_purchase_request_groups")
                                    ->where("id",$request->idTender)->first();
                if($tenderprg_now->satuan_id == (int)$request->satuan)
                    $tender_purchase_request_groups->quantity = $request->jumlah + $tenderprg_now->quantity;
                else{
                    $konversi_now = DB::table("item_satuans")->select("konversi")->where("id",$tenderprg_now->satuan_id)->first()->konversi;
                    $konversi_new = DB::table("item_satuans")->select("konversi")->where("id",(int)$request->satuan)->first()->konversi;
                    $tender_purchase_request_groups->quantity =  $request->jumlah + ($tenderprg_now->quantity*$konversi_new/$konversi_now);
                }
                TenderPurchaseRequestGroup::where("id",$request->idTender)->update([
                    "quantity" => $tender_purchase_request_groups->quantity,
                    "satuan_id" => $tenderprg_now->satuan_id,
                    ]);
            }else{
                $tender_purchase_request_groups->quantity = $request->jumlah;
                $tender_purchase_request_groups->no = \App\Helpers\Document::new_number('TPRG', 2);
                $tender_purchase_request_groups->satuan_id = (int)$request->satuan;
                $tender_purchase_request_groups->description = $request->description ."\n". $request->descriptionSpec;
                $tender_purchase_request_groups->save();
            }
            foreach($request->item_per_description as $v){

                $tender_purchase_request_group_details = new TenderPurchaseRequestGroupDetail;
                if(isset($request->idTender))
                    $tender_purchase_request_group_details->tender_purchase_request_groups_id = $request->idTender;
                else
                    $tender_purchase_request_group_details->tender_purchase_request_groups_id = $tender_purchase_request_groups->id;
                $tender_purchase_request_group_details->id_purchase_request_detail = $v;
                $tender_purchase_request_group_details->save();

            }
                
        //\App\Helpers\Document::make_approval('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPengelompokan',$tender_purchase_request_groups->id);
            $approval = new Approval;
            $approval->approval_action_id   = 1;
            $approval->document_id          = $tender_purchase_request_groups->id;
            $approval->document_type        = "Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPengelompokan";
            $approval->save();
        }
       return redirect($url);
    }
        /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->session()->get('project_id'));
        $id_approve = DB::table("approvals")
                        ->where("document_type","Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                        ->where("approval_action_id","6")
                        ->select("document_id")->get();
        $id_prs = [];
        foreach($id_approve as $v){
            $tmp = DB::table("purchaserequest_details")->select("purchaserequest_id")->where("id",$v->document_id)->first()->purchaserequest_id;
            if(!in_array($tmp,$id_prs))
                array_push($id_prs,$tmp);
        }
        $rekanan_group = DB::table("rekanan_groups")->get();
        $rab_pekerjaan = DB::table("rab_pekerjaans")->select("rab_pekerjaans.id","rab_pekerjaans.itempekerjaan_id","itempekerjaans.name")->join("itempekerjaans","rab_pekerjaans.itempekerjaan_id","=","itempekerjaans.id")->get();
        $pengelompokanTender =  DB::table("tender_purchase_request_groups")
                                ->select("tender_purchase_request_groups.id","tender_purchase_request_groups.quantity","item_satuans.name as itemSatuanName","tender_purchase_request_groups.description","items.name as itemName","brands.name as brandName","tender_purchase_request_groups.description as description")
                                ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                                ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                                ->join("items","items.id","purchaserequest_details.item_id")
                                ->join("brands","brands.id","purchaserequest_details.brand_id")
                                ->join("item_satuans","item_satuans.id","tender_purchase_request_groups.satuan_id")
                                ->join("approvals","approvals.document_id","tender_purchase_request_groups.id")
                                ->where("approvals.document_type","Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPengelompokan")
                                ->where("approvals.approval_action_id","6")
                                ->distinct()
                                ->leftJoin("tender_purchase_requests","tender_purchase_requests.tender_pr_groups_id","tender_purchase_request_groups.id")
                                ->where("tender_purchase_requests.tender_pr_groups_id",NULL)
                                ->get();
        $auto_date_create_tender = DB::table("globalsettings")->where("parameter","auto_date_create_tender")->first();
        if(isset($auto_date_create_tender))
            $auto_date_create_tender = $auto_date_create_tender->value;
        $auto_date_create_tender = (int)$auto_date_create_tender;
        echo($auto_date_create_tender);
        return view('tenderpurchaserequest::create',compact("user","project","rekanan_group","rab_pekerjaan","pengelompokanTender","auto_date_create_tender"));
    }

    /**
     * Store a new
     * ly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $preData = (object)[
            "tender_pr_groups_id" => (int)$request->t_pr_groups_id,
            "rab_id"            => (int)$request->t_pr_rab,
            "name"              => $request->t_pr_name,
            "aanwijzing_type"   => $request->t_pr_aanwijzing_type,
            "aanwijzing_date"   => $request->t_pr_aanwijzing_date,
            "penawaran1_date"   => $request->t_pr_penawaran1_date,
            "klarifikasi1_date" => $request->t_pr_klarifikasi1_date,
            "penawaran2_date"   => $request->t_pr_penawaran2_date,
            "klarifikasi2_date" => $request->t_pr_klarifikasi2_date,
            "penawaran3_date"   => $request->t_pr_penawaran3_date,
            "final_date"        => $request->t_pr_final_date,
            "recommendation_date" => $request->t_pr_recommendation_date,
            "pengumuman_date"   => $request->t_pr_pengumuman_date,
            "sumber"            => $request->t_pr_sumber,
            "description"       => $request->t_pr_description,
            "kelas"             => 1,
        ];
        // echo "<pre>";
        //     print_r($request->t_pr_r_rekanan);
        // echo "</pre>";        
        //$department_id = \Modules\PurchaseRequest\Entities\PurchaseRequest::select('department_id')->where('id',$preData->rab_id)->first()->department_id;
        //input ke table TenderPurchaseRequest
        $TPR = new TenderPurchaseRequest;
        $TPR->tender_pr_groups_id = $preData->tender_pr_groups_id ;
        $TPR->rab_id            = $preData->rab_id ;
        $TPR->kelas_id          = $preData->kelas;
        $TPR->no                = \App\Helpers\Document::new_number('TPR', 2);
        $TPR->name              = $preData->name;
        $TPR->aanwijzing_type   = $preData->aanwijzing_type;
        $TPR->aanwijzing_date   = $preData->aanwijzing_date;
        $TPR->penawaran1_date   = $preData->penawaran1_date;
        $TPR->klarifikasi1_date = $preData->klarifikasi1_date;
        $TPR->penawaran2_date   = $preData->penawaran2_date;
        $TPR->klarifikasi2_date = $preData->klarifikasi2_date;
        $TPR->penawaran3_date   = $preData->penawaran3_date;
        $TPR->final_date        = $preData->final_date;
        $TPR->recommendation_date = $preData->recommendation_date;
        $TPR->pengumuman_date   = $preData->pengumuman_date;
        $TPR->sumber            = $preData->sumber;
        $TPR->description       = $preData->description;
        $TPR->save();
        $rekomendasi_rekanan = DB::table("tender_purchase_request_groups")
                                ->select(
                                        "purchaserequest_details.rec_1",
                                        "purchaserequest_details.rec_2",
                                        "purchaserequest_details.rec_3"                                        
                                        )
                                ->where("tender_purchase_request_groups.id",$TPR->tender_pr_groups_id)
                                ->join("tender_purchase_request_group_details","tender_purchase_request_group_details.tender_purchase_request_groups_id","tender_purchase_request_groups.id")
                                ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                                ->get();
        $rekanan = [];
        foreach ($rekomendasi_rekanan as $v) {
            if(!in_array($v->rec_1, $rekanan) and $v->rec_1!="")
                array_push($rekanan,$v->rec_1);
            if(!in_array($v->rec_2, $rekanan) and $v->rec_2!="")
                array_push($rekanan,$v->rec_2);
            if(!in_array($v->rec_3, $rekanan) and $v->rec_3!="")
                array_push($rekanan,$v->rec_3);



            //array_push($rekanan,$t_pr_r_rekanan->rec_1,$t_pr_r_rekanan->rec_2,$t_pr_r_rekanan->rec_3);
        }


        //input ke table TenderPurchaseRequestRekanan
        // $t_pr_r_rekanan = DB::table("purchaserequest_details")->select("rec_1","rec_2","rec_3")->where("id","=",$request->t_pr_item)->first();
        // $rekanan = [];
        // array_push($rekanan,$t_pr_r_rekanan->rec_1,$t_pr_r_rekanan->rec_2,$t_pr_r_rekanan->rec_3);
        for($i=0;$i<count($rekanan);$i++){
            if(isset($rekanan[$i])){
                $TPRR = new \Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestRekanan;
                $TPRR->tender_purchase_request_id   = $TPR->id ;
                $TPRR->rekanan_id                   = $rekanan[$i];
                $TPRR->save();

                $TPRP = new \Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran;
                $TPRP->tender_rekanan_id   = $TPRR->id;
                $TPRP->no   = \App\Helpers\Document::new_number('TPRP', 2);
                $TPRP->date   = date("Y-m-d");            
                $TPRP->save();
                //for($j=1;$j<=3;$j++){
                    $TPRPD                      = new \Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaranDetail;
                    $TPRPD->tender_penawaran_id = $TPRP->id;
                    //$TPRPD->keterangan          = "Penawaran ".$j;
                    $TPRPD->save();
                //}
            }
        }
        // $TPRD = new \Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestDetail;
        // $TPRD->tender_id = $TPR->id;
        // $TPRD->purchaserequest_detail_id = $request->t_pr_item;
        // $TPRD->save();
        // // echo "<pre>";
        // //     print_r($preData);
        // // echo "</pre>";
        // // echo "<pre>";
        // //     print_r($TPR);
        // // echo "</pre>";
        // // echo "<pre>";
        // //     print_r($TPRD);
        // // echo "</pre>";

        // //$TPRR->save();
        $approval = new Approval;
        $approval->approval_action_id   = 1;
        $approval->document_id          = $TPR->id;
        $approval->document_type        = "Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequest";
        $approval->save();
        return redirect("/tenderpurchaserequest/");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
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
                ->join("rekanans as rekanan1","rekanan1.id","purchaserequest_details.rec_1")
                ->leftJoin("rekanans as rekanan2","rekanan2.id","purchaserequest_details.rec_2")
                ->leftJoin("rekanans as rekanan3","rekanan3.id","purchaserequest_details.rec_3")
                ->join("items","items.id","purchaserequest_details.item_id")
                ->join("brands","brands.id","purchaserequest_details.brand_id")
                ->select("purchaserequests.no","rekanan1.name as rekanan1Name","rekanan2.name as rekanan2Name","rekanan3.name as rekanan3Name","purchaserequest_details.delivery_date","items.name as itemName","brands.name as brandName","purchaserequest_details.item_id")
                ->get();  
        

        $TPRItem =  DB::table("tender_purchase_request_group_details")
                    ->where("tender_purchase_request_groups_id",$TPR->tender_pr_groups_id)
                    ->join("tender_purchase_request_groups","tender_purchase_request_groups.id","tender_purchase_request_group_details.tender_purchase_request_groups_id")
                    ->join("item_satuans","item_satuans.id","tender_purchase_request_groups.satuan_id")
                    ->select("item_satuans.name as satuanName","tender_purchase_request_groups.quantity","tender_purchase_request_groups.description")
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
        $penawaran =    $TMPrekanan
                        ->join("tender_purchase_request_penawarans","tender_purchase_request_penawarans.tender_rekanan_id","tender_purchase_request_rekanans.id")
                        ->join("tender_purchase_request_penawarans_details","tender_purchase_request_penawarans_details.tender_penawaran_id","tender_purchase_request_penawarans.id")
                        ->select("tender_purchase_request_penawarans_details.nilai1","tender_purchase_request_penawarans_details.nilai2","tender_purchase_request_penawarans_details.nilai3","tender_purchase_request_rekanans.id as tprrId")
                        ->get();

        // $rekananList =  DB::table("rekanans")
        //                 ->join()
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
        // $TPRD = \Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestDetail::where("tender_id",$request->id)->first();
        // $PR = \Modules\PurchaseRequest\Entities\PurchaseRequest::where("id",$TPR->rab_id)->first();
        // $PRD = \Modules\PurchaseRequest\Entities\PurchaseRequestDetail::where("id",$TPRD->id)->first();
        // $rekananPRD = DB::table('rekanans')->select('name')->where('id','=',$PRD->rec_1)->orWhere('id','=',$PRD->rec_2)->orWhere('id','=',$PRD->rec_3)->get();
        // $item = DB::table('items')->select('name')->where('id','=',$PRD->item_id)->first();
        // $satuan = DB::table('item_satuans')->select('name')->where('id','=',$PRD->item_satuan_id)->first();
        // $brand = DB::table('brands')->select('name')->where('id','=',$PRD->brand_id)->first();
        
        // $TPRR = \Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestRekanan::select("id","rekanan_id")->where("tender_purchase_request_id",$TPR->id)->get();
        // $rekananTender = (object)[];
        // $TMP = [
        // ];
        // $TMP2 = [
        // ];
        // for($i = 0; $i < count($TPRR); $i++){
        //     $value = DB::table('rekanans')->select('name','id')->where('id','=',$TPRR[$i]->rekanan_id)->first();
        //     array_push($TMP,$value);

        //     $value = DB::table('tender_purchase_request_penawarans')->select('id')->where('tender_rekanan_id','=',$TPRR[$i]->id)->first();    

        //     $value = DB::table('tender_purchase_request_penawarans_details')->select('nilai','volume','tender_penawaran_id')->where('tender_penawaran_id','=',$value->id)->get();
        
        //     array_push($TMP2,$value);
        // }
        // $tenderprpd = (object)$TMP2;
        // $rekananTender = (object)$TMP;

        // $rekanan_group = \App\rekanan_group::get();
        // $i = 0;
        // $j = 0;
        // $nilaiVolume = [];
        // $tmp3 = [];
        
        // foreach($tenderprpd as $value){
        //     $j = 0;
        //     $tmp2=[];
        //     foreach($value as $value2){
        //         $tmp = [
        //             "nilai" => $value2->nilai,
        //             "volume" => $value2->volume,
        //             "tender_penawaran_id" => $value2->tender_penawaran_id
        //         ];
        //         array_push($tmp2,$tmp);
        //         $j++;
        //     }
        //     array_push($tmp3,$tmp2);

        //     $i++;
        // }
        // $nilaiVolume = (object)$tmp3;
        // $a = (array)$nilaiVolume;
        if(isset($request->back))
            $back = $request->back;
        return view('tenderpurchaserequest::detail',compact("user","project","TPR","jumlahPR","PRD","TPRItem","rekanan","pemenang","penawaran","rekananList","rekananArray","idPemenang","apporve","tender_approve","back"));    
    }
    public function ubahVolume(Request $request){
        $tprp_id     = DB::table("tender_purchase_request_penawarans")
                    ->join("tender_purchase_request_rekanans","tender_purchase_request_penawarans.tender_rekanan_id","=","tender_purchase_request_rekanans.id")
                    ->select("tender_purchase_request_penawarans.id")
                    ->where("tender_purchase_request_rekanans.tender_purchase_request_id","=",$request->tpr_id)
                    ->get();
        foreach($tprp_id as $value){
            $tprpd_data = DB::table("tender_purchase_request_penawarans_details")->select("id")->where("tender_penawaran_id","=",$value->id)->get();
            DB::table("tender_purchase_request_penawarans_details")->where("id","=",$tprpd_data[0]->id)->update(["volume" => $request->volume1]);
            DB::table("tender_purchase_request_penawarans_details")->where("id","=",$tprpd_data[1]->id)->update(["volume" => $request->volume2]);
            DB::table("tender_purchase_request_penawarans_details")->where("id","=",$tprpd_data[2]->id)->update(["volume" => $request->volume3]);
            break;
        }
        return redirect("/tenderpurchaserequest/detail/?id=". $request->tpr_id);

    }
    public function tambahPenawaran(Request $request){
        $idPenawaran =  DB::table("tender_purchase_request_penawarans")
                        ->whereIn("tender_rekanan_id",$request->id_rekanan) 
                        ->get();
        $i = 0;
        foreach ($idPenawaran as $v) {
            $tprdUpdate = DB::table("tender_purchase_request_penawarans_details")->where("tender_penawaran_id",$v->id);
            if(isset($request->penawaran1[$i]))
                $tprdUpdate->update([
                    "nilai1" => $request->penawaran1[$i]
                ]);
            if(isset($request->penawaran2[$i]))
                $tprdUpdate->update([
                    "nilai2" => $request->penawaran2[$i]
                ]);
            if(isset($request->penawaran3[$i]))
                $tprdUpdate->update([
                    "nilai3" => $request->penawaran3[$i]
                ]);
            $i++;
        }
        

        // foreach ($request->id_rekanan as $v) {
        //     $id_penawaran_detail =  DB::table("tender_purchase_request_rekanans")
        //                             ->join("tender_purchase_request_penawarans","tender_purchase_request_penawarans.tender_rekanan_id","tender_purchase_request_rekanans.id")
        //                             ->join("tender_purchase_request_penawarans_details","tender_purchase_request_penawarans_details.tender_penawaran_id","tender_purchase_request_penawarans.id")
        //                             ->where("tender_purchase_request_rekanans.tender_purchase_request_id",$request->tpr_id)
        //                             ->where("tender_purchase_request_rekanans.rekanan_id",$v)
        //                             ->get();
        //     echo("foreach <pre>");
        //         print_r($request->tpr_id);
        //     echo("</pre>");

        // }
        // $id_rekanan = DB::table("tender_purchase_request_rekanans")->select("id")
        //                     ->where("tender_purchase_request_id","=",$request->tpr_id)
        //                     ->where("rekanan_id","=",$request->id_rekanan)
        //                     ->first()->id;
        // $id_penawaran = DB::table("tender_purchase_request_penawarans")->select("id")->where("tender_rekanan_id","=",$id_rekanan)->first()->id;
        // var_dump($id_penawaran);
        // $id_penawaran_detail = DB::table("tender_purchase_request_penawarans_details")->select("id")->where("tender_penawaran_id","=",$id_penawaran)->get();
        // var_dump($id_penawaran_detail[0]->id);
        // DB::table("tender_purchase_request_penawarans_details")->where("id","=",$id_penawaran_detail[0]->id)->update([
        //     "nilai" => $request->nilai1
        // ]);
        // DB::table("tender_purchase_request_penawarans_details")->where("id","=",$id_penawaran_detail[1]->id)->update([
        //     "nilai" => $request->nilai2
        // ]);
        // DB::table("tender_purchase_request_penawarans_details")->where("id","=",$id_penawaran_detail[2]->id)->update([
        //     "nilai" => $request->nilai3
        // ]);
        return redirect("/tenderpurchaserequest/detail/?id=". $request->tpr_id);
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
    public function approve_pengelompokan(Request $request){
        if($request->approve = 1)
            DB::table("approvals")
            ->where('document_id', $request->id)
            ->where('document_type', "Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPengelompokan")
            ->update([
                'approval_action_id' => 6
            ]);
        else
            DB::table("approvals")
            ->where('document_id', $request->id)
            ->where('document_type', "Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPengelompokan")
            ->update([
                'approval_action_id' => 1
            ]);
        return redirect("/tenderpurchaserequest/pengelompokan/");
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
            'approval_action_id' => 2
        ]);

        //isi table PO

        date_default_timezone_set("Asia/Jakarta");
        DB::table("purchaseorders");
        $PO = new PurchaseOrder;
        $PO->tender_purchase_request_group_id   = DB::table("tender_purchase_requests")
                                                   ->where("id",$request->tpr_id)
                                                   ->first()->tender_pr_groups_id;
        $PO->rekanan_id                         = DB::table("tender_purchase_request_rekanans")
                                                    ->where("id",$request->id)
                                                    ->first()
                                                    ->rekanan_id;
        $PO->no                                 = \App\Helpers\Document::new_number('PO', 2);
        $PO->date                               = date("Y-m-d");
        $PO->matauang                           = "IDR";
        $PO->kurs                               = 1;
        $PO->description                        = DB::table("tender_purchase_requests")
                                                   ->where("id",$request->tpr_id)
                                                   ->first()
                                                   ->description;
        
        $PO->save();
        $POD = new PurchaseOrderDetail;
        $POD->purchaseorder_id  = $PO->id;
        $POD->item_id           = DB::table("tender_purchase_request_group_details")
                                   ->where("tender_purchase_request_group_details.tender_purchase_request_groups_id",$PO->tender_purchase_request_group_id)
                                   ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                                   ->select("purchaserequest_details.item_id")
                                   ->distinct()
                                   ->first()
                                   ->item_id;
        $POD->brand_id          = DB::table("tender_purchase_request_group_details")
                                   ->where("tender_purchase_request_group_details.tender_purchase_request_groups_id",$PO->tender_purchase_request_group_id)
                                   ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                                   ->select("purchaserequest_details.brand_id")
                                   ->distinct()
                                   ->first()
                                   ->brand_id;
        $POD->item_satuan_id    = DB::table("tender_purchase_request_group_details")
                                   ->where("tender_purchase_request_group_details.tender_purchase_request_groups_id",$PO->tender_purchase_request_group_id)
                                   ->join("purchaserequest_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                                   ->select("purchaserequest_details.item_satuan_id")
                                   ->distinct()
                                   ->first()
                                   ->item_satuan_id;
        $POD->quantity          = DB::table("tender_purchase_request_groups")
                                   ->where("id",$PO->tender_purchase_request_group_id)
                                   ->first()->quantity;
        $POD->price             = DB::table("tender_purchase_request_rekanans")
                                    ->where("tender_purchase_request_rekanans.tender_purchase_request_id",$request->tpr_id)
                                    ->where("tender_purchase_request_rekanans.rekanan_id",$PO->rekanan_id)
                                    ->join("tender_purchase_request_penawarans","tender_purchase_request_penawarans.tender_rekanan_id","tender_purchase_request_rekanans.id")
                                   ->join("tender_purchase_request_penawarans_details","tender_purchase_request_penawarans_details.tender_penawaran_id","tender_purchase_request_penawarans.id")
                                   ->orderBy("tender_purchase_request_penawarans_details.id","desc")
                                   ->first()
                                   ->nilai3;
        $POD->ppn               = DB::table("rekanans")
                                   ->where("rekanans.id",$PO->rekanan_id)
                                   ->first()
                                   ->ppn;
        $POD->pph               = DB::table("rekanans")
                                   ->where("rekanans.id",$PO->rekanan_id)
                                   ->join("rekanan_groups","rekanan_groups.id","rekanans.rekanan_group_id")
                                   ->first()
                                   ->pph_percent;
        $POD->description       = DB::table("tender_purchase_request_groups")
                                   ->where("id",$PO->tender_purchase_request_group_id)
                                   ->first()->description;
        
        $POD->save();
        // echo("<pre>");
        //     print_r($PO);
        // echo("</pre>");
        // echo("<pre>");
        //     print_r($POD);
        // echo("</pre>");
        // echo("<pre>");
        //     print_r($valuePOD);
        // echo("</pre>");

        
        return redirect("/tenderpurchaserequest/detail/?id=". $request->tpr_id);
    }
    public function getData(){
        return view('tenderpurchaserequest::test');
    }
    public function show()
    {
        return view('tenderpurchaserequest::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('tenderpurchaserequest::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}




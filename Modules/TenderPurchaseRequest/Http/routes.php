<?php

Route::group(['middleware' => 'web', 'prefix' => 'tenderpurchaserequest', 'namespace' => 'Modules\TenderPurchaseRequest\Http\Controllers'], function()
{
    Route::get('/', 'TenderPurchaseRequestController@index');
    Route::get('/add', 'TenderPurchaseRequestController@create');
    Route::post('/add-tpr','TenderPurchaseRequestController@store');
    Route::get('/getRab/{data?}',function($data){
        //$task = Task::find($data);
        $PRD =  DB::table("purchaserequest_details")
                ->join("approvals","purchaserequest_details.id","=","approvals.document_id")
                ->select('purchaserequest_details.purchaserequest_id','purchaserequest_details.id','purchaserequest_details.description')
                ->where('purchaserequest_details.purchaserequest_id','=',$data)
                ->where('approvals.document_type','=',"Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                ->where('approvals.approval_action_id','=',6)
                ->get();
        return Response::json($PRD);
    });
    Route::get('/getPengelompokanBrand/{data?}',function($data){
        //$task = Task::find($data);
        $PRD =  DB::table("purchaserequest_details")
                ->join("approvals","purchaserequest_details.id","=","approvals.document_id")
                ->select('purchaserequest_details.brand_id',"brands.name")
                ->where('purchaserequest_details.item_id','=',$data)
                ->where('approvals.document_type','=',"Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                ->where('approvals.approval_action_id','=',6)
                ->distinct()
                ->join("brands","purchaserequest_details.brand_id","brands.id")
                ->leftJoin("tender_purchase_request_group_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                ->whereNull("tender_purchase_request_group_details.id_purchase_request_detail")
                ->get();
        return Response::json($PRD);
    });
    Route::get('/getPengelompokanItemD/{data?}',function($data){
        //$task = Task::find($data);
        $brand_id= (int)$data;
        $item_id= (int)substr($data,strpos($data,"-")+1);        
        $PRD =  DB::table("purchaserequest_details")
                ->join("approvals","purchaserequest_details.id","=","approvals.document_id")
                ->where('purchaserequest_details.item_id','=',$item_id)
                ->where('purchaserequest_details.brand_id','=',$brand_id)
                ->where('approvals.document_type','=',"Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
                ->where('approvals.approval_action_id','=',6)
                //->distinct()
                ->join("purchaserequests","purchaserequest_details.purchaserequest_id","purchaserequests.id")
                ->join("departments","departments.id","purchaserequests.department_id")
                ->select("purchaserequests.no","departments.code","purchaserequest_details.description","purchaserequest_details.id","purchaserequest_details.quantity","item_satuans.name as satuan")
                ->join("item_satuans","item_satuans.id","purchaserequest_details.item_satuan_id")
                ->leftJoin("tender_purchase_request_group_details","purchaserequest_details.id","tender_purchase_request_group_details.id_purchase_request_detail")
                ->whereNull("tender_purchase_request_group_details.id_purchase_request_detail")
                ->get();
        return Response::json($PRD);
    });
    Route::get('/getPengelompokanJumlah/{data?}',function($tmpData){
        $jumlahData = substr_count($tmpData,',')+1;
        $data = [(int)$tmpData];
        if($jumlahData>1){
            for($i=1;$i<$jumlahData;$i++){
                $tmpData = substr($tmpData,strpos($tmpData,",")+1);
                array_push($data,(int)$tmpData);
            }
        }
        $itemId = DB::table("purchaserequest_details")->where("id",$data[0])->select("item_id")->first()->item_id;
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
        return Response::json($hasil);

        //$task = Task::find($data);
        // $brand_id= (int)$data;
        // $item_id= (int)substr($data,strpos($data,"-")+1);        
        // $PRD =  DB::table("purchaserequest_details")
        //         ->join("approvals","purchaserequest_details.id","=","approvals.document_id")
        //         ->where('purchaserequest_details.item_id','=',$item_id)
        //         ->where('purchaserequest_details.brand_id','=',$brand_id)
        //         ->where('approvals.document_type','=',"Modules\PurchaseRequest\Entities\PurchaseRequestDetail")
        //         ->where('approvals.approval_action_id','=',6)
        //         //->distinct()
        //         ->join("purchaserequests","purchaserequest_details.purchaserequest_id","purchaserequests.id")
        //         ->join("departments","departments.id","purchaserequests.department_id")
        //         ->select("purchaserequests.no","departments.name","purchaserequest_details.description","purchaserequest_details.id")
        //         ->leftJoin("tender_purchase_request_groups","purchaserequest_details.id","tender_purchase_request_groups.id_purchase_request_detail")
        //         ->whereNull("tender_purchase_request_groups.id_purchase_request_detail")
        //         ->get();
        //return Response::json($PRD);
    });

    Route::get('/detail','TenderPurchaseRequestController@detail');
    Route::get('/add-rekanan','TenderPurchaseRequestController@rekanan');
    Route::get('/ubah-volume','TenderPurchaseRequestController@ubahVolume');
    Route::get('/tambah-penawaran','TenderPurchaseRequestController@tambahPenawaran');
    Route::get('/pengelompokan','TenderPurchaseRequestController@pengelompokan');
    Route::get('/pengelompokanAdd','TenderPurchaseRequestController@pengelompokanAdd');
    Route::post('/add-pengelompokan','TenderPurchaseRequestController@pengelompokanStore');
    Route::get('/pengelompokanDetail','TenderPurchaseRequestController@pengelompokanDetail');
    Route::get('/add-pemenang/','TenderPurchaseRequestController@add_pemenang');
    Route::get('/approve-pemenang/','TenderPurchaseRequestController@approve_pemenang');
    Route::get('/approve-tender/','TenderPurchaseRequestController@approve_tender');
    Route::get('/approve-pengelompokan/','TenderPurchaseRequestController@approve_pengelompokan');

});

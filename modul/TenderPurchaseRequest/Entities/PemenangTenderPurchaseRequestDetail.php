<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;

class PemenangTenderPurchaseRequestDetail extends CustomModel
{
    protected $table = 'pemenang_tender_purchase_request_details';
    protected $fillable = ['id_pemenang_tender_pr','tender_penawaran_id','item_id','item_satuan_id','brand_id','nilai','volume','ppn'];
}

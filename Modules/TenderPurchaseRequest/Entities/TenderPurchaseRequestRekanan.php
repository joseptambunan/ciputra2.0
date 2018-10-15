<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestRekanan extends CustomModel
{
    public $table = "tender_purchase_request_rekanans";
    
    protected $fillable = ['id','tender_purchase_request_id','rekanan_id','sipp_no','sipp_date','doc_ambil_date','doc_ambil_by','is_pemenang','doc_bayar_status','doc_bayar_date','description'];
}

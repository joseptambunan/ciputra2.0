<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestPenawaranDetail extends CustomModel
{
    public $table = "tender_purchase_request_penawarans_details";
    
    protected $fillable = ['id','tender_penawaran_id','keterangan','nilai1','nilai2','nilai3','volume'];

}

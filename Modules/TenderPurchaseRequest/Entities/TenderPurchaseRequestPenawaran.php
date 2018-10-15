<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestPenawaran extends CustomModel
{
    public $table = "tender_purchase_request_penawarans";
    
    protected $fillable = ['id','tender_rekanan_id','no','date','name_file','file_attachment'];

}

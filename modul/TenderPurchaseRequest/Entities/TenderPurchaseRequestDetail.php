<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestDetail extends CustomModel
{
    public $table = "tender_purchase_request_details";

    protected $fillable = ['id','tender_id','purchaserequest_detail_id'];

}

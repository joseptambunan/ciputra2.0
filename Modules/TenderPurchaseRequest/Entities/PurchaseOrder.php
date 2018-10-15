<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class PurchaseOrder extends CustomModel
{
    public $table = "purchaseorders";

    protected $fillable = ['id',"tender_purchase_request_group_id",'rekanan_id','location_id','no','date','matauang','kurs','term_pengiriman','cara_pembayaran','status','description'];

}

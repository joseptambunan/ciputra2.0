<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class PurchaseOrderDetail extends CustomModel
{
    public $table = "purchaseorder_details";

    protected $fillable = ['id',"purchaseorder_id",'item_id','brand_id','item_satuan_id','quantity','price','ppn','pph','description'];

}

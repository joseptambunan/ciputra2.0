<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestGroup extends CustomModel
{
    public $table = "tender_purchase_request_groups";
    protected $fillable = ['id','quantity','satuan_id','description'];
    


}

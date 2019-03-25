<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestGroupDetail extends CustomModel
{
    public $table = "tender_purchase_request_group_details";
    protected $fillable = ['id','tender_purchase_request_groups_id','id_purchase_request_detail'];

    public function detail_pr()
    {
    	return $this->hasOne('Modules\PurchaseRequest\Entities\PurchaseRequestDetail','id','id_purchase_request_detail');
    }

    
}

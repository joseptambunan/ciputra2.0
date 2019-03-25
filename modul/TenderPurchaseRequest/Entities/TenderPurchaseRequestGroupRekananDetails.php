<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;

class TenderPurchaseRequestGroupRekananDetails extends CustomModel
{
	protected $table = 'tender_purchase_request_group_rekanan_details';
    protected $fillable = ['tender_purchase_request_group_rekanan_id','rekanan_id'];

    public function rekanan()
    {
    	return $this->belongsTo('Modules\Rekanan\Entities\Rekanan','rekanan_id');
    }

    public function tender()
    {
    	return $this->belongsTo('Modules\TenderPurchaseRequest\Entities','tender_purchase_request_group_rekanan_id','id');
    }
}

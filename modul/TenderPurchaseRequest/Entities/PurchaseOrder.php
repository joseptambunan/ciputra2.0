<?php

namespace Modules\TenderPurchaseRequest\Entities;

use App\CustomModel;


class PurchaseOrder extends CustomModel
{
    protected $table = "purchaseorders";

    protected $fillable = ["id_tender_menang","no","rekanan_id","description","project_for_id"];

    public function vendor()
    {
    	return $this->belongsTo('Modules\Rekanan\Entities\Rekanan','rekanan_id','id');
    }

    public function details()
    {
    	return $this->hasMany('Modules\TenderPurchaseRequest\Entities\PurchaseOrderDetail','purchaseorder_id','id');
    }

    public function tender_menang()
    {
        return $this->belongsTo('Modules\TenderPurchaseRequest\Entities\TenderMenangPR','id_tender_menang','id');
    }

    public function approval()
    {
        return $this->morphMany('Modules\Approval\Entities\Approval','document','document_type','document_id');
    }
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project','project_for_id');
    }
}

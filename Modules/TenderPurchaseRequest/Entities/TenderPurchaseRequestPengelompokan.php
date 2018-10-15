<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestPengelompokan extends CustomModel
{
    public $table = "tender_purchase_request_groups";

    protected $fillable = ['id','quantity','satuan_id','no','description'];
    
    public function pt()
    {
        return $this->belongsTo('Modules\PurchaseRequest\Entities\PurchaseRequest', 'purchaserequest_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function location()
    {
        return $this->belongsTo('App\Location', 'location_id');
    }

    public function details()
    {
        return $this->hasMany('App\PurchaserequestDetail');
    }

    public function penawarans()
    {
        return $this->hasMany('App\PurchaserequestDetailPenawaran');
    }

    public function cancellations()
    {
        return $this->hasMany('App\PurchaserequestCancellation');
    }

    public function purchaseorders()
    {
        return $this->hasMany('App\Purchaseorder');
    }

    public function getNilaiAttribute()
    {
        return 0;
    }

}

<?php

namespace Modules\PurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;

class PurchaseRequestDetail extends CustomModel
{
    public $table = "purchaserequest_details";
    protected $fillable = ['id','purchaserequest_id','itempekerjaan_id','item_id','item_satuan_id','brand_id','recomended_supplier','quantity','description','rec_1','rec_2','rec_3','delivery_date'];
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

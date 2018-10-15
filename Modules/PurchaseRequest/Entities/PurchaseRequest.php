<?php

namespace Modules\PurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;

class PurchaseRequest extends CustomModel
{
    public $table = "purchaserequests";
    protected $fillable = ['budget_tahunan_id','pt_id','department_id','location_id','no','date','butuh_date','is_urgent','description'];
    public function pt()
    {
        return $this->belongsTo('App\Pt', 'pt_id');
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

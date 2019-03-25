<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestGroup extends CustomModel
{
    public $table = "tender_purchase_request_groups";
    protected $fillable = ['id','no','project_for_id','description','id_po_lampiran'];

    public function detail()
    {
      return $this->hasMany('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupDetail','tender_purchase_request_groups_id','id');
    }

    public function approval()
    {
        return $this->morphMany('Modules\Approval\Entities\Approval','document','document_type','document_id');
    }

    public function collect_rekanan()
    {
        return $this->hasOne('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan','tender_purchase_request_group_id','id');
    }

}
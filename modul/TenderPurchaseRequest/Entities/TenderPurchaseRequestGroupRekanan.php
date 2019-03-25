<?php

namespace Modules\TenderPurchaseRequest\Entities;

use App\CustomModel;
use App\Traits\Approval;
class TenderPurchaseRequestGroupRekanan extends CustomModel
{
	use Approval;
    protected $fillable = ['tender_purchase_request_group_id','no','status_pemenang','project_for_id','aanwijzing_date','penawaran1_date','klarifikasi1_date','penawaran2_date','klarifikasi2_date','penawaran2_date','negosiasi_date'];
    protected $table = 'tender_purchase_request_group_rekanans';

    public function approval()
    {
        return $this->morphMany('Modules\Approval\Entities\Approval','document','document_type','document_id');
    }

    public function details()
    {
    	return $this->hasMany();
    }
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project','project_for_id');
    }
}

<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestPenawaran extends CustomModel
{
    public $table = "tender_purchase_request_penawarans";
    
    protected $fillable = ['id','no','project_for_id','id_tender_purchase_request_group_rekanan','rekanan_id','date','name_file','file_attachment','id_metode_pembayaran','DP','lama_cicilan','penawaran'];

    public function tender_purchase_request_group_rekanan_detail()
    {
    	return $this->belongsTo('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekananDetails','rekanan_id','id');
    }

    public function tender_purchase_request_group_rekanan()
    {
        return $this->belongsTo('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan','id_tender_purchase_request_group_rekanan','id');
    }

    public function details()
    {
    	return $this->hasMany('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaranDetail','tender_penawaran_id','id');
    }

    public function approval()
    {
        return $this->morphMany('Modules\Approval\Entities\Approval','document','document_type','document_id');
    }
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project','project_for_id');
    }
    public function rekanan()
    {
      return $this->belongsTo('Modules\Rekanan\Entities\Rekanan','rekanan_id','id');
    }
}

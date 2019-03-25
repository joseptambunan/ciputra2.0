<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;

class TenderMenangPR extends Model
{
	protected $table = 'tender_menang_pr';
    protected $fillable = ['no','project_for_id','rekanan_id','tender_purchase_group_rekanan_id','id_penawaran','description','status_usulan','status_pemenang'];

    public function getPtAttribute()
    {
        return $this->tender_rekanan->tender->rab->workorder->project->first()->pt_user->first()->pt;
    }


    public function tender_purchase_request_group_rekanan_detail()
    {
        return $this->belongsTo('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekananDetails','rekanan_id','id');
    }

    public function tender()
    {
        return $this->belongsTo('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroupRekanan','tender_purchase_group_rekanan_id','id');
    }

    public function penawaran()
    {
        return $this->belongsTo('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran','id_penawaran','id');
    }
}

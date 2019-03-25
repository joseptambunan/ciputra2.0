<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;

class PemenangTenderPurchaseRequest extends CustomModel
{
	protected $table = 'pemenang_tender_purchase_request';
    protected $fillable = ['id_tpr_penawaran','id_rekanan'];

    public function rekanan()
    {
    	return $this->belongsTo('Modules\Rekanan\Entities\Rekanan','rekanan_id');
    }

    public function penawaran()
    {
    	
    }
}

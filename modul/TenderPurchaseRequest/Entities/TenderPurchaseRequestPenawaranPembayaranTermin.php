<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;

class TenderPurchaseRequestPenawaranPembayaranTermin extends Model
{
	protected $table = 'tender_purchase_request_penawaran_pembayaran_termin';
    protected $fillable = ['project_for_id','tender_purchase_request_penawaran_id','termin_date','percentage'];
}

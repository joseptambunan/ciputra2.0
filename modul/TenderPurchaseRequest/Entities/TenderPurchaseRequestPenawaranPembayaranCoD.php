<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;

class TenderPurchaseRequestPenawaranPembayaranCoD extends Model
{
	protected $table = 'tender_purchase_request_penawaran_pembayaran_cod';
    protected $fillable = ['project_for_id','tender_purchase_request_penawaran_id','tanggal_cod','quantity','item_id','item_satuan_id','brand_id','cod_ke'];
}

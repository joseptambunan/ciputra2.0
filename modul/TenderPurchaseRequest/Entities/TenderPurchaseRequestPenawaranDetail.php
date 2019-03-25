<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequestPenawaranDetail extends CustomModel
{
    protected $table = "tender_purchase_request_penawarans_details";
    
    protected $fillable = ['id','tender_rekanan_id','item_id','item_satuan_id','brand_id','tender_penawaran_id','keterangan','nilai','volume','ppn','disc','description'];

    public function penawaran()
    {
    	return $this->belongsTo('Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestPenawaran','tender_penawaran_id','id');
    }

    public function satuan()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id','id');
    }

    public function item()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Item','item_id','id');
    }

    public function brand()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Brand','brand_id','id');
    }

}

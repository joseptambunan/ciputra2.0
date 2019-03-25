<?php

namespace Modules\TenderPurchaseRequest\Entities;

use App\CustomModel;
class PurchaseOrderDetail extends CustomModel
{
    public $table = "purchaseorder_details";

    protected $fillable = ["purchaseorder_id",'item_id','brand_id','item_satuan_id','quantity','price','ppn','pph','discon','description'];

    public function purchaseorder()
    {
        return $this->belongsTo('Modules\TenderPurchaseRequest\Entities\PurchaseOrder','purchaseorder_id','id');
    }
    public function item()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\ItemProject','item_id','id');
    }

    public function satuan()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','satuan_id','id');
    }

    public function brand()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Brand','brand_id','id');
    }
}

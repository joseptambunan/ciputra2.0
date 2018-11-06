<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class AssetDetailItem extends CustomModel
{
    protected $fillable =['asset_detail_id','barangkeluar_detail_price_id','item_id'];
    public function barangkeluar_detail_price()
    {
        return $this->belongsTo('Modules\Inventory\Entities\BarangkeluarDetailPrice');
    }

    public function asset_detail()
    {
        return $this->belongsTo('Modules\Inventory\Entities\AssetDetail');
    }

    public function transaction_details()
    {
        return $this->hasMany('Modules\Inventory\Entities\AssetTransactionDetail');
    }

    public function item()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Item');
    }

    public function warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Warehouse');
    }
}

<?php

namespace Modules\Asset\Entities;

use App\CustomModel;

class AssetDetailItem extends CustomModel
{
    public function barangkeluar_detail_price()
    {
        return $this->belongsTo('App\BarangkeluarDetailPrice');
    }

    public function asset_detail()
    {
        return $this->belongsTo('Modules\Asset\Entities\AssetDetail');
    }

    public function transaction_details()
    {
        return $this->hasMany('Modules\Asset\Entities\AssetTransactionDetail');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}

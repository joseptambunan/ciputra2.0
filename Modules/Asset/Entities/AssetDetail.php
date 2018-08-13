<?php

namespace Modules\Asset\Entities;

use App\CustomModel;

class AssetDetail extends CustomModel
{
    public function asset()
    {
        return $this->belongsTo('Modules\Asset\Entities\Asset');
    }

    public function barangkeluar_detail()
    {
        return $this->belongsTo('App\BarangkeluarDetail');
    }

    public function barangkeluar()
    {
        return $this->belongsTo('App\BarangkeluarDetail');
    }

    public function barangkeluar_detail_price()
    {
        return $this->belongsTo('App\BarangkeluarDetailPrice', 'barangkeluar_detail_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function items()
    {
        return $this->hasMany('App\AssetDetailItem');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}

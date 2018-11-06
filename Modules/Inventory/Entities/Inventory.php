<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class Inventory extends CustomModel
{
    protected $fillable = ['item_id',
                            'rekanan_id',
                            'warehouse_id',
                            'sumber_id',
                            'sumber_type',
                            'item_satuan_id',
                            'date',
                            'quantity',
                            'quantity_terpakai',
                            'price',
                            'description'];

    public function item()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Item');
    }

    public function rekanan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Rekanan');
    }

    public function warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Warehouse');
    }

    public function sumber()
    {
        return $this->morphTo();
    }

    public function barangkeluar_detail_prices()
    {
        return $this->hasMany('Modules\Inventory\Entities\BarangkeluarDetailPrice');
    }

    public function satuan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
    }
}

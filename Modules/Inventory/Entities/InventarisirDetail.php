<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class InventarisirDetail extends CustomModel
{
    //

    protected $fillable =[
            'inventarisir_id',
            'barangkeluar_detail_id',
            'item_id',
            'item_satuan_id',
            'quantity'
            ];

    public function inventarisir()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Inventarisir');
    }
    public function barangkeluar_detail()
    {
        return $this->belongsTo('Modules\Inventory\Entities\BarangkeluarDetail');
    }

    public function item()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Item');
    }

    public function satuan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
    }

    public function assets()
    {
        return $this->hasMany('Modules\Inventory\Entities\Asset');
    }

    public function assets_morphic()
    {
        return $this->morphMany('Modules\Inventory\Entities\Asset','assetable','sumber_type','sumber_id');
    }
}

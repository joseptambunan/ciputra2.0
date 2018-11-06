<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class BarangkeluarDetail extends CustomModel
{
    protected $fillable =[
                            'barangkeluar_id',
                            'permintaanbarang_detail_id',
                            'inventory_id',
                            'item_id',
                            'warehouse_id',
                            'item_satuan_id',
                            'is_sent',
                            'quantity',
                            'price','ppn'
                        ];
    
    public function barangkeluar()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Barangkeluar');
    }


    public function permintaanbarang_detail()
    {
        return $this->belongsTo('Modules\Inventory\Entities\PermintaanbarangDetail');
    }

    public function item()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Item','item_id');
    }

    public function satuan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Warehouse');
    }

    public function asset_detail()
    {
        return $this->hasOne('Modules\Inventory\Entities\AssetDetail');
    }

    public function prices()
    {
        return $this->hasMany('Modules\Inventory\Entities\BarangkeluarDetailPrice');
    }

    public function inventory()
    {
        return $this->morphOne('Modules\Inventory\Entities\Inventory', 'sumber','sumber_type','sumber_id');
    }

}

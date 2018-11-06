<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class Pengembalianbarang extends CustomModel
{
    //
    protected $fillable = ['no','barangkeluar_id','quantity_pinjam'];

    public function items()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Item','item_id');
    }

    public function barangkeluar()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Barangkeluar');
    }

    public function warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Warehouse');
    }

    public function satuan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
    }

    public function details()
    {
        return $this->hasMany('Modules\Inventory\Entities\PengembalianbarangDetail','pengembalianbarang_id');
    }

}

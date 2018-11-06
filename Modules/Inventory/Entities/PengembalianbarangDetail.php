<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class PengembalianbarangDetail extends CustomModel
{
    //
    protected $fillable = ['pengembalianbarang_id','barangkeluar_id','item_id','warehouse_id','quantity_kembali','approval_status','status','images','remarks','item_satuan_id'];

    public function warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Warehouse');
    }

    public function satuan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
    }
    public function items()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Item','item_id');
    }

    public function pengembalianbarang()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Pengembalianbarang');
    }

    public function barangkeluar()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Barangkeluar');
    }
}

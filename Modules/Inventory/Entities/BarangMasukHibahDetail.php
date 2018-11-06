<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class BarangMasukHibahDetail extends CustomModel
{
    //
    protected $fillable = [
    						'barang_masuk_hibah_id',
						    'warehouse_id',
						    'item_id',
						    'item_satuan_id',
						    'quantity',
						    'quantity_acuan',
						    'quantity_reject',
						    'quantity_sisa',
						    'price',
						    'tanggal_hibah',
						    //'no',
						    'description',
						    'status'
						];

	public function barang_masuk_hibah()
	{
		return $this->belongsTo('Modules\Inventory\Entities\BarangMasukHibah');
	}

	public function items()
	{
		return $this->belongsTo('Modules\Inventory\Entities\Item','item_id');
	}

	public function warehouse()
	{
		return $this->belongsTo('Modules\Inventory\Entities\Warehouse','warehouse_id');
	}

	public function item_satuan()
	{
		return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
	}

	public function inventory()
    {
        return $this->morphOne('Modules\Inventory\Entities\Inventory', 'sumber','sumber_type','sumber_id');
    }
}

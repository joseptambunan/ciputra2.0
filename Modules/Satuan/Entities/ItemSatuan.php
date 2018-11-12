<?php

namespace Modules\Satuan\ItemSatuan;

class ItemSatuan extends CustomModel
{
	protected $fillable = ['item_id','name','konversi'];

    public function item()
    {
        return $this->belongsTo('Modules\Satuan\Entities\Item', 'item_id');
    }
}

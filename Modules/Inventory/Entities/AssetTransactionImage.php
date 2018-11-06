<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class AssetTransactionImage extends CustomModel
{
    //
    protected $fillable = ['asset_transaction_id','path','image_data'];

    public function asset_transaction()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Transaction');
    }
}

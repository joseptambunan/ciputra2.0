<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class AssetTransactionDetailImage extends CustomModel
{
    public function asset_transaction_detail()
    {
        return $this->belongsTo('Modules\Inventory\Entities\AssetTransactionDetail');
    }
}

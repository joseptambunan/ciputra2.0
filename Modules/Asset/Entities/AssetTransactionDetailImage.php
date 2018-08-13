<?php

namespace Modules\Asset\Entities;

use App\CustomModel;

class AssetTransactionDetailImage extends CustomModel
{
    public function asset_transaction_detail()
    {
        return $this->belongsTo('Modules\Asset\Entities\AssetTransactionDetail');
    }
}

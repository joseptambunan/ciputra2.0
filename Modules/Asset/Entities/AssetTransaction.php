<?php

namespace App;

use App\CustomModel;

class AssetTransaction extends CustomModel
{
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project');
    }

    public function pt()
    {
        return $this->belongsTo('Modules\Project\Entities\Pt');
    }

    public function details()
    {
        return $this->hasMany('Modules\Asset\Entities\AssetTransactionDetail');
    }
}

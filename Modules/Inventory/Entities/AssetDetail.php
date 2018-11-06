<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class AssetDetail extends CustomModel
{
    protected $fillable =['asset_id','inventarisir_detail_id','barcode','reuse','reuse_id'];

    public function asset()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Asset');
    }

    public function reuse_parent()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\AssetDetail','reuse_id');
    }

    public function reuse_child()
    {
    	return $this->hasMany('Modules\Inventory\Entities\AssetDetail','reuse_id');
    }

    public function transacation()
    {
        return $this->hasOne('Modules\Inventory\Entities\AssetTransaction','asset_detail_id','id');
    }
}

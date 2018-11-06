<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class Asset extends CustomModel
{
    protected $fillable = ['inventarisir_detail_id','sumber_id','nilai_ekonomis','sumber_type','item_id','quantity','asset_age','item_satuan_id','price','ppn','description','is_labeled'];

    public function inventarisirDetail()
    {
        return $this->belongsTo('Modules\Inventory\Entities\InventarisirDetail');
    }

    
    public function item()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Item','item_id');
    }

    public function satuan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
    }

    public function detail()
    {
        return $this->hasOne('Modules\Inventory\Entities\AssetDetail','asset_id','id');
    }

    public function asset_transactions()
    {
        return $this->hasMany('Modules\Inventory\Entities\AssetTransaction','asset_id');
    }

    public function assetable()
    {
        return $this->morphTo();
    }


}

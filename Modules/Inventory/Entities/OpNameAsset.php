<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;


class OpNameAsset extends CustomModel
{
    //
    protected $table = 'op_name_assets';
    protected $fillable = ['period_op_name_id','barcode','item_id','description'];

    public function item()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Item');    	
    }
}

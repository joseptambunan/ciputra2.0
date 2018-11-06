<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class MutasiInDetail extends CustomModel
{
    //
    protected $fillable = ['mutasi_in_id','item_id','qty','item_satuan_id','image1','image2','image3','description'];

    public function item()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Item','item_id');
    }

    public function satuan()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
    }
    
    public function mutasiin()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\MutasiIn','mutasi_in_id');
    }
}

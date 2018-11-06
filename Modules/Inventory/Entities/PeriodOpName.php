<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class PeriodOpName extends CustomModel
{
    //
    protected $table = 'period_op_names';
    protected $fillable = ['start_opname','end_opname','warehouse_id','description'];

    public function warehouse()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Warehouse');    	
    }

    public function details()
    {
    	return $this->hasMany('Modules\Inventory\Entities\OpNameAsset','period_op_name_id');
    }
}

<?php

namespace Modules\Project\Entities;

use App\CustomModel;

class HppDevCostReport extends CustomModel
{
    public function item(){
    	return $this->belongsTo("Modules\Pekerjaan\Entities\Itempekerjaan","itempekerjaan");
    }
    
    public function cost_report(){
    	return $this->hasMany("Modules\Project\Entities\CostReport","itempekerjaan");
    }
}

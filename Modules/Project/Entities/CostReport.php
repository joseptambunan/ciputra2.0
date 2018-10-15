<?php

namespace App;

use App\CustomModel;

class CostReport extends CustomModel
{
    //
    public function spk(){
    	return $this->belongsTo("App\Spk","spk_id");
    }
}

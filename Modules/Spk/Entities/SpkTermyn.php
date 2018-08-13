<?php

namespace Modules\Spk\Entities;

use Illuminate\Database\Eloquent\Model;

class SpkTermyn extends Model
{
    //
    public function spk(){
    	return $this->belongsTo("Modules\Spk\Entities\Spk");
    }
}

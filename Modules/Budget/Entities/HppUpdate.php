<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class HppUpdate extends Model
{
    protected $fillable = [];

    public function details(){
    	return $this->hasMany("Modules\Budget\Entities\HppUpdateDetail");
    }
}

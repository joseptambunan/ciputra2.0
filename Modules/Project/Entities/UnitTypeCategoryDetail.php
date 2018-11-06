<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class UnitTypeCategoryDetail extends Model
{
    protected $fillable = [];

    public function itempekerjaan(){
    	return $this->belongsTo("Modules\Pekerjaan\Entities\Itempekerjaan");
    }
}

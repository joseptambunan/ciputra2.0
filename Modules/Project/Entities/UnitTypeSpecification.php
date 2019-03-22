<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class UnitTypeSpecification extends Model
{
    protected $fillable = [];

    public function type(){
    	return $this->belongsTo("Modules\Project\Entities\UnitType");
    }

    public function jenis_gambar(){
    	return $this->belongsTo("Modules\TypeSpecification\Entities\TypeSpecification","gambar");
    }
}

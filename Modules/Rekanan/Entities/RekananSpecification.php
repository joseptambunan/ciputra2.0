<?php

namespace Modules\Rekanan\Entities;

use Illuminate\Database\Eloquent\Model;

class RekananSpecification extends Model
{
    protected $fillable = [];

    public function itempekerjaan(){
    	return $this->belongsTo("Modules\Pekerjaan\Entities\Itempekerjaan");
    }

    public function rekanan_group(){
    	return $this->belongsTo("Modules\Rekanan\Entities\RekananGroup");
    }
}

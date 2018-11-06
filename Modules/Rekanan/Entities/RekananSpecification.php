<?php

namespace Modules\Rekanan\Entities;

use Illuminate\Database\Eloquent\Model;

class RekananSpecification extends Model
{
    protected $fillable = [];

    public function itempekerjaan(){
    	return $this->belongsTo("Modules\Pekerjaan\Entities\Itempekerjaan");
    }
}

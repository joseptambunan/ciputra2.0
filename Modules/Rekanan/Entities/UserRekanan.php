<?php

namespace Modules\Rekanan\Entities;

use Illuminate\Database\Eloquent\Model;

class UserRekanan extends Model
{
    protected $fillable = [];

    public function rekanan_group(){
    	return $this->belongsTo("Modules\Rekanan\Entities\RekananGroup");
    }    
}

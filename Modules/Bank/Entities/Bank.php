<?php

namespace Modules\Bank\Entities;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [];

    public function city(){
    	return $this->belongsTo("Modules\Country\Entities\City");
    }
}

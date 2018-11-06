<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    protected $fillable = [];

    public function category(){
    	return $this->belongsTo("Modules\Category\Entities\Category");
    }
}

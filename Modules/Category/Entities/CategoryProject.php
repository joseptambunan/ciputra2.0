<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryProject extends Model
{
    protected $fillable = [];

    public function category_detail(){
    	return $this->belongsTo("Modules\Category\Entities\CategoryDetail");
    }
}

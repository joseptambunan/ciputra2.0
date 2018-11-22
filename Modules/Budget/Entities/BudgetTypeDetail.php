<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetTypeDetail extends Model
{
    protected $fillable = [];

    public function itempekerjaan(){
    	return $this->belongsTo("Modules\Pekerjaan\Entities\Itempekerjaan");
    }

    public function budget_type(){
    	return $this->belongsTo("Modules\Budget\Entities\BudgetType","budget_id");
    }
}

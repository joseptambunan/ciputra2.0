<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetType extends Model
{
    protected $fillable = [];

    public function details(){
    	return $this->hasMany("Modules\Budget\Entities\BudgetTypeDetail","budget_id");
    }
}

<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetTahunanUnit extends Model
{
    protected $fillable = [];

    public function budget_tahunan(){
    	return $this->belongsTo("Modules\Budget\Entities\BudgetTahunan");
    }

    public function unit_type(){
    	return $this->belongsTo("Modules\Project\Entities\UnitType");
    }

    public function details(){
    	return $this->hasMany("Modules\Budget\Entities\BudgetTahunanUnitPeriode");
    }
    
}

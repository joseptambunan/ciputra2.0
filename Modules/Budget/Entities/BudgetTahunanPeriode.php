<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetTahunanPeriode extends Model
{
    //
    public function budget_tahunan(){
    	return $this->belongsTo("Modules\Budget\Entities\BudgetTahunan");
    }

    public function Itempekerjaan(){
    	return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan', 'itempekerjaan_id');
    }
}

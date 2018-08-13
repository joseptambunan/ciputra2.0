<?php

namespace Modules\Workorder\Entities;

use App\CustomModel;
use App\Traits\Approval;
use App\ApprovalHistory;

class WorkorderBudgetDetail extends CustomModel
{
    //
    public function volume_total($year,$budgetid){
    	
    }

    public function budget_tahunan(){
    	return $this->belongsTo("Modules\Budget\Entities\BudgetTahunan");
    }

    public function itempekerjaan(){
    	return $this->belongsTo("Modules\Pekerjaan\Entities\Itempekerjaan");
    }
}

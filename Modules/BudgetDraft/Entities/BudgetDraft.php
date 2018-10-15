<?php

namespace Modules\BudgetDraft\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Approval;

class BudgetDraft extends Model
{
	use Approval;
    protected $fillable = [];

    public function pt(){
        return $this->belongsTo('Modules\Budget\Entities\Budget',"budget_parent_id");
    }

    public function budget(){
    	return $this->belongsTo('Modules\Budget\Entities\Budget',"budget_parent_id");
    }

    public function budget_tahunan(){
        return $this->belongsTo('Modules\Budget\Entities\BudgetTahunan',"budget_tahunan_id");
    }

    public function details(){
    	return $this->hasMany("\Modules\BudgetDraft\Entities\BudgetDraftDetail");
    }

    public function getNilaiAttribute(){
    	$nilai = 0;
    	foreach ($this->details as $key => $value) {
    		$nilai = $nilai + ( $value->nilai * $value->volume );
    	}
    	return $nilai;
    }

    public function workorder(){
        return $this->belongsTo("\Modules\Workorder\Entities\Workorder");
    }
}

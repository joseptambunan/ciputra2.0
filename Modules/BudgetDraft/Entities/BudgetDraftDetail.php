<?php

namespace Modules\BudgetDraft\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetDraftDetail extends Model
{
    protected $fillable = [];

    public function budget_draft(){
    	return $this->belongsTo("Modules\BudgetDraft\Entities\BudgetDraft");
    }

    public function itempekerjaan(){
    	return $this->belongsTo("\Modules\Pekerjaan\Entities\itempekerjaan");
    }
}

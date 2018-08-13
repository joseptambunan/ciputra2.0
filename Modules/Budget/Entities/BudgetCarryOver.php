<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetCarryOver extends Model
{
    protected $fillable = [];

    public function spk(){
    	return $this->belongsTo("App\Spk");
    }

    public function getSisaAttribute(){
    	$sisa = 0;
    	$sisa = ( $this->spk->nilai - $this->spk->nilai_bap);
    	return $sisa;
    }
}

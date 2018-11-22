<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetCarryOverCashflow extends Model
{
    protected $fillable = [];

    public function getTotalAttribute(){
    	$nilai = $this->januari + $this->februari + $this->maret + $this->april + $this->mei + $this->juni + $this->juli + $this->agustus + $this->september + $this->oktober + $this->november + $this->desember ;
    	return $nilai;

    }
}

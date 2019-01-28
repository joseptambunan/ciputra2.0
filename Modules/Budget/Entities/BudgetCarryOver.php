<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetCarryOver extends Model
{
    protected $fillable = [];

    public function spk(){
    	return $this->belongsTo("Modules\Spk\Entities\Spk");
    }

    public function getSisaAttribute(){
    	$sisa = ( ($this->spk->nilai + $this->spk->nilai_vo) - ( $this->spk->terbayar_verified / 1.1));
    	return $sisa;
    }

    public function cash_flows(){
    	return $this->hasMany("Modules\Budget\Entities\BudgetCarryOverCashflow");
    }

    public function getNilaiRencanaAttribute(){
        $nilai = 0;
        if ( $this->cash_flows->count() > 0 ){
            foreach ($this->cash_flows as $key => $value) {
                if ( $this->hutang_bayar != "" ){
                    $nilai = $nilai + ( ($value->total / 100) * $this->hutang_bayar );
                }else{
                    $nilai = $nilai + ( ($value->total / 100) * $this->sisa );

                }
            }

           return $nilai;
        }else{
            return $this->sisa;
        }
    }

    public function getNilaiTotalAttribute(){

    }

    
}

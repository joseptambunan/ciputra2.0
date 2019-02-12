<?php

namespace Modules\Pengajuanbiaya\Entities;

use Illuminate\Database\Eloquent\Model;

class Pengajuanbiaya extends Model
{
    protected $fillable = [];

    public function details(){
    	return $this->hasMany("Modules\Pengajuanbiaya\Entities\PengajuanbiayaDetail","pengajuan_biaya_id");
    }

    public function department(){
    	return $this->belongsTo("Modules\Department\Entities\Department");
    }

    public function getNilaiAttribute(){
    	$nilai = 0;
    	foreach ($this->details as $key => $value) {
    		$nilai = $nilai + $value->nilai;
    	}
    	return $nilai;
    }

    public function budget_tahunan(){
        return $this->belongsTo("Modules\Budget\Entities\BudgetTahunan","budget_id");
    }

    
}

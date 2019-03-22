<?php

namespace Modules\Workorder\Entities;

use App\CustomModel;
use App\Traits\Approval;
use App\ApprovalHistory;
use Modules\Rab\Entities\Rab;

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

    public function workorder(){
        return $this->belongsTo("Modules\Workorder\Entities\Workorder");
    }

    public function dokumen(){
        return $this->hasMany("Modules\Tender\Entities\TenderDocument","workorder_budget_id");
    }

    public function rab(){
        return $this->hasOne("Modules\Rab\Entities\Rab","workorder_budget_detail_id");
    }

    public function getAllRabAttribute(){

        if ( $this->rab != "" ){
           $rab = Rab::find($this->rab->id);
           return $rab;
        }else{
            $pekerjaan = $this->itempekerjaan_id;
            foreach ($this->workorder->rabs as $key => $value) {
                foreach ( $value->pekerjaans as $key2 => $value2 ){
                    if ( $value2->itempekerjaan_id == $pekerjaan){
                        $rab_id = $value->id;
                        $rab = Rab::find($rab_id);
                        return $rab;
                    }
                }

                if ( $value->pekerjaans->last()->itempekerjaan->parent->id == $pekerjaan ){
                    $rab_id = $value->id;
                    $rab = Rab::find($rab_id);
                    return $rab;
                }
            }
        }
    }
}

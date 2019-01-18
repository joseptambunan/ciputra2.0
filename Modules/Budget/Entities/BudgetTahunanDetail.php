<?php

use Modules\Budget\Entities\BudgetTahunanPeriode;

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetTahunanDetail extends Model
{
    protected $fillable = ['budget_tahunan_id','itempekerjaan_id','nilai','max_overbudget','description'];

    public function budget_tahunan()
    {
        return $this->belongsTo('Modules\Budget\Entities\BudgetTahunan');
    }

    public function budget_tahunan_detail()
    {
        return $this->belongsTo('Modules\Budget\Entities\BudgetTahunanDetail');
    }

    public function itempekerjaans()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan', 'itempekerjaan_id');
    }

    public function itempekerjaan_detail()
    {
        //return $this->belongsTo('App\ItempekerjaanDetail');
        return $this->hasMany('Modules\Pekerjaan\Entities\ItempekerjaanDetail');
    }

    public function getNilaiPeriodeAttribute(){
        $nilai = 0;
        $id = $this->itempekerjaans->id;
        $budget_id = $this->budget_tahunan_id ;
        $cek = BudgetTahunanPeriode::where("budget_id",$budget_id)->where("itempekerjaan_id",$id)->get();
        if ( count($cek) > 0 ){
            return 1;
        }else{
            return $nilai;
        }
    }
}

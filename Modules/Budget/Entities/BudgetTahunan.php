<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Approval;

class BudgetTahunan extends Model
{

    use Approval;

    protected $fillable = ['budget_id','parent_id','no','tahun_anggaran','description'];

    public function scopeProject()
    {
        return $this->whereHas('budget', function($q){
            $q->where('project_id', session('project'));
        });
    }


    public function budget()
    {
        return $this->belongsTo('Modules\Budget\Entities\Budget');
    }

    public function details()
    {
        return $this->hasMany('Modules\Budget\Entities\BudgetTahunanDetail');
    }

    public function workorders()
    {
        return $this->hasMany('App\Workorder');
    }

    public function rabs()
    {
        return $this->hasManyThrough('App\Rab', 'App\Workorder');
    }

    public function carry_over(){
        return $this->hasMany('Modules\Budget\Entities\BudgetCarryOver');
    }

    public function getCarryNilaiAttribute(){
        $nilai = 0;
        foreach ($this->carry_over as $key => $value) {
            $nilai = $value->sisa + $nilai;
        }
        return $nilai;
    }

    public function tenders()
    {
        return \App\Tender::whereHas('rab', function($q) 
        {
            $q->whereHas('workorder', function($r) 
            {
                $r->whereHas('budget_tahunan', function($s) 
                {
                    $s->where('id', $this->id);
                });
            });
        });
    }

    public function getNilaiAttribute()
    {
        //$nilai =  $this->details()->sum('nilai');
        //$volume = $this->details()->sum('volume');
        $nilai = 0;
        foreach ($this->details as $key => $value) {
            $nilai = $nilai + ( $value->nilai * $value->volume);
        }
        return $nilai ;
    }

    public function geTendersAttribute()
    {
        return $this->tenders()->get();
    }

    public function itempekerjaans()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan', 'itempekerjaan_id');
    }

    public function getPtAttribute()
    {
        return $this->budget->pt;
    }

    public function total_volume($itemid,$type){
        

        $total_volume = 0;
        $total_nilai = 0;
        $total = 0;
        $satuan = "";
        $arrayResult = array("nilai" => "", "volume" => "", "satuan" => "");
        //for ( $i=0; $i<count($item_id); $i++ ){
            $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code","like",$itemid."%")->get();
            foreach ($itempekerjaan as $key => $value) {
                $budgets = \Modules\Budget\Entities\BudgetTahunanDetail::where("itempekerjaan_id",$value->id)->where("budget_tahunan_id",$this->id)->first();
                if ( isset($budgets->volume)){
                    $total_nilai = $total_nilai + $budgets->nilai;
                    $total_volume = $total_volume + $budgets->volume;
                    $satuan = $budgets->satuan;
                }
            }
            $arrayResult = array("id" => $itemid, "nilai" => $total_nilai, "volume" => $total_volume, "satuan" => $satuan, "total" => $total);
        //}
        return $arrayResult[$type];        
    }

    public function getBudgetMonthlyAttribute(){
        $nilai = array();
        foreach ($this->details as $key => $value) {
            # code...
            $code = explode(".",$value->itempekerjaans->code);
            $nilai[$key] = $code[0];
        }
        
        $uniqe      = array_unique($nilai);
        $item_id    = array_values($uniqe);
        $total_volume = 0;
        $total_nilai = 0;
        $total = 0;
        $arrayResult = array();
        for ( $i=0; $i<count($item_id); $i++ ){
             $total_volume = 0;
            $total_nilai = 0;
            $total = 0;
            $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$item_id[$i])->first();
            $bulanan = $this->monthly;
            if ( $bulanan != "" ){
                foreach ($bulanan as $key2 => $value2) {
                    if ( $item_id[$i] == $value2->itempekerjaan->code ){
                            $arrayResult[$i] = array(
                            "id" => $value2->id,
                            "code" => $item_id[$i],
                            "januari" => $value2->januari,
                            "februari" => $value2->februari,
                            "maret" => $value2->maret,
                            "april" => $value2->april,
                            "mei" => $value2->mei,
                            "juni" => $value2->juni,
                            "juli" => $value2->juli,
                            "agustus" => $value2->agustus,
                            "september" => $value2->september,
                            "oktober" => $value2->oktober,
                            "november" => $value2->november,
                            "desember" => $value2->desember
                        );
                    }                    
                }
            }
        }
        return $arrayResult;
    }

    public function monthly(){
        return $this->hasMany("Modules\Budget\Entities\BudgetTahunanPeriode","budget_id");
    }

    public function getTotalParentItemAttribute(){
        $nilai = array();
        foreach ($this->details as $key => $value) {
            # code...
            $code = explode(".",$value->itempekerjaans->code);
            $nilai[$key] = $code[0];
        }
        
        $uniqe      = array_unique($nilai);
        $item_id    = array_values($uniqe);
        $total_volume = 0;
        $total_nilai = 0;
        $total = 0;
        $satuan = "";
        $id = "";
        $total = 0;
        $arrayResult = array();
        for ( $i=0; $i<count($item_id); $i++ ){
            $total_volume = 0;
            $total_nilai = 0;
            $total = 0;
            $id = "";
            $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code","like",$item_id[$i]."%")->get();
            foreach ($itempekerjaan as $key => $value) {
                $budgets = \Modules\Budget\Entities\BudgetTahunanDetail::where("itempekerjaan_id",$value->id)->where("budget_tahunan_id",$this->id)->first();
                if ( isset($budgets->volume)){
                    $total_nilai = $total_nilai + $budgets->nilai;
                    $total_volume = $total_volume + $budgets->volume;
                    $satuan = $budgets->satuan;
                    $id = $value->id;
                }
            }
            $arrayResult[$i] = array("code" => $item_id[$i], "nilai" => $total_nilai, "volume" => $total_volume, "satuan" => $satuan, "id" => $id, "total" => "");
        }
        return $arrayResult;

        
    }
   
}

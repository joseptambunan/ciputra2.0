<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
     protected $fillable = ['subholding','contactperson','code','name','luas','address','zipcode','npwp','phone','fax','email','description','city_id'];

    public function contactperson()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'contactperson');
    }

    public function city()
    {
        return $this->belongsTo('Modules\Country\Entities\City');
    }

    public function kawasans()
    {
        return $this->hasMany('Modules\Project\Entities\ProjectKawasan');
    }

    public function budgets()
    {
        return $this->hasMany('Modules\Budget\Entities\Budget');
    }

    public function budget_tahunans()
    {
        return $this->hasManyThrough('Modules\Budget\Entities\BudgetTahunan', 'Modules\Budget\Entities\Budget');
    }

    public function getWorkordersAttribute()
    {
        return \Modules\Workorder\Entities\Workorder::whereHas( 'budget_tahunan', function($q){
            $q->whereHas('budget', function($budget){
                $budget->where('project_id', $this->id);
            });
        } )->get();
    }

    public function getProjectAttribute()
    {
        return $this;
    }

    public function getRabsAttribute()
    {
        return \App\Rab::whereHas( 'workorder', function($workorder){
            $workorder->whereHas('budget_tahunan', function($budgettahunan){
                $budgettahunan->whereHas('budget', function($budget){
                    $budget->where('project_id', $this->id);
                });
            });
        })->get();
    }

    public function getTendersAttribute()
    {
        return 
        \Modules\Tender\Entities\Tender::whereHas('rab', function($rab){ 
            $rab->whereHas( 'workorder', function($workorder){
                $workorder->where('budget_tahunan_id', $this->id);
            });
        });
    }

    public function getHppBudgetAttribute()
    {
        $nilai = 0;

        foreach ($this->kawasans as $key => $kawasan) 
        {
            $nilai = $nilai + $kawasan->hpp_budget;
        }

        return $nilai;
    }

    public function spks()
    {
        return $this->hasMany('Modules\Spk\Entities\Spk');
    }

    public function bloks()
    {
        return $this->hasManyThrough('Modules\Project\Entities\Blok', 'Modules\Project\Entities\ProjectKawasan');
    }

    public function workorder_details()
    {
        return $this->morphMany('Modules\Workorder\Entities\WorkorderDetail', 'asset');
    }
    public function rab_units()
    {
        return $this->morphMany('Modules\Rab\Entities\RabUnit', 'asset');
    }
    public function tender_units()
    {
        return $this->morphMany('Modules\Tender\Entities\TenderUnit', 'asset');
    }
    public function spk_details()
    {
        return $this->morphMany('Modules\Spk\Entities\SpkDetail', 'asset');
    }
    public function progresses()
    {
        return $this->morphMany('App\UnitProgress', 'unit');
    }
    public function getCalculateBobotAttribute()
    {
        $total = 0;

        $progresses = $this->progresses()->whereHas('spkvo_unit')->where('is_pembangunan', true)->get();

        foreach ($progresses as $key => $each) 
        {
            $total = $total + ($each->nilai * $each->volume);
        }

        foreach ($progresses as $key => $detail) 
        {
            if ($detail->is_pembangunan) {
                # code...
                $detail->update([
                    'bobot'=> $detail->nilai * $detail->volume / $total
                ]);
            }else{
                $detail->update([
                    'bobot'=> 0
                ]);
            }
        }

        return $total;
    }

    public function getNilaiAttribute()
    {
        $nilai = array();

        foreach ($this->progresses as $key => $each) 
        {
            $nilai[$key] = $each->nilai * $each->volume * ( 1 + $each->itempekerjaan->ppn );
        }

        return array_sum($nilai);
    }

    public function getNilaiBudgetAttribute()
    {
        $nilai = array();

        foreach ($this->budgets->where('project_kawasan_id', null) as $key => $each) 
        {
            $nilai[$key] = $each->nilai;
        }

        return array_sum($nilai);
    }

    public function units()
    {
        return \Modules\Project\Entities\Unit::whereHas('blok', function($q){
            $q->whereHas('kawasan', function($r){
                $r->where('project_id', $this->id);
            });
        });
    }
    public function getUnitsAttribute()
    {
        return $this->units()->get();
    }

    public function getEfisiensiAttribute()
    {
        if ($this->luas > 0) 
        {
            return $this->units()->where('is_sellable',true)->sum('tanah_luas') / $this->luas;
        }else{
            return 0;
        }
    }

    public function getNilaiKontrakAttribute(){}
    public function getDevCostBudgetBrutoAttribute()
    {
        $nilai = 0;

        foreach ($this->kawasans as $key => $kawasan) 
        {
            $nilai += $kawasan->dev_cost_budget_netto;
        }

        if ($this->luas > 0) 
        {
            return $nilai / $this->luas;
        }else{
            return 0;
        }

    }
    public function getDevCostBudgetNettoAttribute()
    {
        if ($this->efisiensi > 0) 
        {
            return $this->dev_cost_budget_bruto / $this->efisiensi;
        }else{
            return 0;
        }
    }
    public function getDevCostKontrakBrutoAttribute(){}
    public function getDevCostKontrakNettoAttribute(){}
    public function getDevCostRealisasiBrutoAttribute(){}
    public function getDevCostRealisasiNettoAttribute(){}
    public function getConCostBudgetAttribute(){}
    public function getConCostKontrakAttribute(){}
    public function getConCostRealisasiAttribute(){}


    public function getConCostAttribute()
    {
        $nilai = 0;

        foreach ($this->units as $key => $unit) 
        {
            $nilai += $unit->con_cost;
        }

        return $nilai;
    }

    public function getDevCostAttribute()
    {
        $nilai = 0;

        foreach ($this->progresses as $key => $progress) 
        {
            $nilai += $progress->nilai * $progress->volume;
        }

        return $nilai;
    }


    public function pt_user(){
        return $this->hasMany("Modules\Project\Entities\ProjectPtUser");
    }

    public function progress(){
        return $this->hasMany("App\UnitProgress");
    }

    public function unit_progress($itemid){
        return $this->hasMany('App\UnitProgress')->where('project_id',$this->id)->where('itempekerjaan_id',$itemid)->get();
    }

    public function unit_progressbyYear($itemid,$year){
        return $items = $this->hasMany('App\UnitProgress')->where('project_id',$this->id)->where('itempekerjaan_id',$itemid)->whereYear('created_at',$year)->get();
    }

    public function nilai_kontrak($itemid){
        $nilai = 0;
        $items = $this->unit_progress($itemid);
        foreach ( $items as $value ){
            $nilai = $nilai + $value->nilai;
        }
        return $nilai;
    }

    public function nilai_year_kontrak($itemid,$year){
        $nilai = 0;
        $items = $this->unit_progress($itemid,$year);
        foreach ( $items as $value ){
            $nilai = $nilai + $value->nilai;
        }
        return $nilai;
    }

    public function nilai_percentage($itemid){
       return $items = $this->unit_progress($itemid)->avg('progresslapangan_percent');        
    }

    public function nilai_by_year_percentage($itemid,$year){
        return $items = $this->unit_progressbyYear($itemid,$year)->avg('progresslapangan_percent');     
    }

    public function nilai_bap_terbayar($itemid){
        $nilai = 0;
        $items = $this->unit_progress($itemid);
        foreach ($items as $value) {
            $nilai =  $nilai + (  ( $value->nilai * $value->progressbap_percent ) * $value->volume ) ;
        }
        return $nilai;
    }

    public function nilai_bap_year_terbayar($itemid,$year){
        $nilai = 0;
        $items = $this->unit_progressbyYear($itemid,$year);
        foreach ($items as $value) {
            $nilai =  $nilai + (  ( $value->nilai * $value->progressbap_percent ) * $value->volume ) ;
        }
        return $nilai;
    }

    public function getSellUnitAttribute()
    {
        return $this->units()->where('is_sellable',true)->sum('tanah_luas');
    }

    public function getKawasanAttribute(){
        $nilai = 0;
        foreach ($this->kawasans as $key => $value) {
            # code...
            $efisiensi = $nilai + $value->lahan_luas;
        } 
        return $nilai;
    }

    public function getNilaiBudgetTahunAwalAttribute(){
        $nilai = 0;
        foreach ($this->kawasans as $each ) {
            # code...
            foreach ( $each->budgets as $key2 => $each2 ){
                foreach ( $each2->details as $key3 => $each3 ){
                    $nilai = $nilai + $each3->itempekerjaan->budget_tahunan->first()->nilai;
                }
            }
        }
        return $nilai;
    }

    public function getNilaiBudgetAwalAttribute(){
        $nilai = 0;
        foreach ($this->kawasans as $each ) {
            # code...
            foreach ( $each->budgets as $key2 => $each2 ){
                foreach ( $each2->details as $key3 => $each3 ){
                    $nilai = $nilai + $each3->nilai;
                }
            }
        }
        return $nilai;
    }

    public function getNilaiBudgetTotalAttribute()
    {
        $nilai = 0;

        foreach ( $this->budgets as $key => $each ) 
        {
            foreach ($each->details as $key2 => $value2 ) {
                # code...
                $nilai = ( $value2->nilai * $value2->volume ) + $nilai;
            }
            
        }

        return $nilai;
    }

    public function getApprovalPendingAttribute(){
        $nilai = 0;
        $user = \Auth::user();
        /* Get Budget Approval */
        foreach ($this->budgets as $key => $value) {
            # code...
            $nilai = $nilai + $value->approval->histories->where("user_id",$user->id)->where("approval_action_id",1)->count();
        }

        /* Get Workorder Approval */
        foreach ($this->workorders as $key => $value) {
            # code...
            $nilai = $nilai + $value->approval->histories->where("user_id",$user->id)->where("approval_action_id",1)->count();
        }

        return $nilai;
    }

    public function getNettoAttribute(){
        $nilai = 0;
        foreach ($this->kawasans as $key => $value) {
            # code...
            $nilai = $nilai + $value->netto_kawasan;
        }
        return $nilai;
    }

    public function unittype(){
        return $this->hasMany("Modules\Project\Entities\UnitType");
    }

}

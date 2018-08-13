<?php

namespace Modules\Pekerjaan\Entities;

use Illuminate\Database\Eloquent\Model;

class Itempekerjaan extends Model
{
    protected $fillable = ['parent_id','code','tag','name','ppn','group_cost','department_id','description'];
	
    public function templates()
    {
        return $this->hasMany('Modules\Project\Entities\Templatepekerjaan');
    }

    public function scopeChildren()
    {
        return $this->where('parent_id', '<>', NULL);
    }
    public function scopeParents()
    {
        return $this->where('parent_id', NULL);
    }
    public function parent()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan', 'parent_id');
    }
    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department');
    }

    public function coas()
    {
        return $this->belongsToMany('Modules\Pekerjaan\Entities\Coa', 'itempekerjaan_coas', 'itempekerjaan_id', 'coa_id');
    }

    public function details()
    {
        return $this->hasMany('Modules\Pekerjaan\Entities\ItempekerjaanDetail');
    }

    public function budget_details()
    {
        return $this->hasMany('Modules\Budget\Entities\BudgetDetail');
    }

    public function templatepekerjaan_details()
    {
        return $this->hasMany('Modules\Project\Entities\TemplatepekerjaanDetail');
    }

    public function rab_pekerjaans()
    {
        return $this->hasManyThrough('App\RabPekerjaan', 'App\TemplatepekerjaanDetail');
    }

    public function bap_details()
    {
        return $this->belongsToMany('App\BapDetail', 'bap_detail_itempekerjaans');
    }

    public function budget_tahunan(){
        return $this->hasMany('App\BudgetTahunanDetail');
    }

    public function unitprogress(){
        return $this->hasMany('App\UnitProgress');
    }

    public function unitprogressbyyear($year){
        $nilai = 0;
        $items = $this->hasMany('App\UnitProgress')->whereYear('created_at',$year)->get();
        foreach ( $items as $key => $value ) {
             $nilai = $nilai + $value->nilai;
        }
        return $nilai;
    }

    public function getNilaiKontrakAttribute(){
        $nilai = 0;
        foreach ($this->unitprogress as $key => $value) {
            # code...
            $nilai = $nilai + $value->nilai;
        }
        return $nilai;
    }

    public function percent_progress($id){
      return \App\UnitProgress::where('itempekerjaan_id',$id)->avg('progresslapangan_percent');
    }

    public function bap_percent_progress($id){
      return \App\UnitProgress::where('itempekerjaan_id',$id)->avg('progressbap_percent');
    }

    public function getBapTerbayarAttribute(){
        $nilai = 0;
        foreach ($variable as $key => $value) {
            # code...
        }
    }

    public function workorder_budget(){
        return $this->hasMany("App\WorkorderBudgetDetail");
    }

    public function subtotal_workorder($parent_id){
        $nilai = 0;
        $itempekerjaan = Itempekerjaan::where("parent_id",$parent_id);
        foreach ($itempekerjaan as $key => $value) {
            # code...
            $volume = WorkorderBudgetDetail::where("itempekerjaan_id",$value->id)->where("workorder_id");
        } 
    }

    public function getNilaiProgressAttribute(){
        $nilai = 0;
        foreach ($this->unitprogress as $key => $value) {
            # code...
            $nilai = $nilai + $value->progresslapangan_percent;
        }
        return $nilai;
    }

    public function child($id){
        return \App\Itempekerjaan::where('parent_id',$id);
    }

    public function budget_awal($kawasanid){
        $nilai = 0;
        $details_budget_global = 0;
        $child1 = Itempekerjaan::where("parent_id",$this->id)->get();
        foreach ($child1 as $key => $value) {
            $child2 = Itempekerjaan::where("parent_id",$value->id)->get();
            if ( count($child2) > 0 ){
                foreach ($child2 as $key2 => $value2) {
                    $budget = Itempekerjaan::find($value2->id)->budget_details;
                    foreach ($budget as $key3 => $value3) {
                        if ( $value3->budget->project_kawasan_id == $kawasanid ){
                            $details = $value3->nilai * $value3->volume;
                            $nilai = $nilai + $details;
                        }else if ( $value3->budget->project_kawasan_id == null ) {
                            $details_budget_global = $value3->nilai * $value3->volume;
                        }
                        
                    }                    
                }
            }            
        }

       
       /* $kawasan = \App\ProjectKawasan::find($kawasanid);
        if ( $kawasan == ""){
            $nilai = 0;
        }else{
            $nilai = $nilai + $details_budget_global;
        }*/
             
        return $nilai;
    }

    public function budget_tahunan_report($kawasanid){
        $nilai = 0;
        $details_budget_global = 0;
        $child1 = Itempekerjaan::where("parent_id",$this->id)->get();
        foreach ($child1 as $key => $value) {
            $child2 = Itempekerjaan::where("parent_id",$value->id)->get();
            if ( count($child2) > 0 ){
                foreach ($child2 as $key2 => $value2) {
                    $budget = Itempekerjaan::find($value2->id)->budget_tahunan;
                    foreach ($budget as $key3 => $value3) {
                        if ( $value3->budget_tahunan->budget->project_kawasan_id == $kawasanid ){
                            $details = $value3->nilai * $value3->volume;
                            $nilai = $nilai + $details;
                        }else if ( $value3->budget_tahunan->budget->project_kawasan_id == null ) {
                            $details_budget_global = $value3->nilai * $value3->volume;
                        }
                        
                    }                    
                }
            }            
        }

       
        $kawasan = \App\ProjectKawasan::find($kawasanid);
        if ( $kawasan == ""){
            $nilai = 0;
        }else{
            $nilai = $nilai + $details_budget_global;
        }
             
        return $nilai;
    }

    public function getTotalKontrakAttribute(){
        $nilai = 0;
        $itempekerjaan = Itempekerjaan::find($this->id);
        $code = $itempekerjaan->code;
        $nilai = 0;
        foreach (Itempekerjaan::where("code","like",$code."%")->get() as $key => $value) {
            $unitprogress = UnitProgress::where("itempekerjaan_id",$value->id)->get();
            if ( count($unitprogress) > 0 ){
                $nilai = $nilai + ( $unitprogress->first()->nilai * $unitprogress->first()->volume  );
            }
        }
        return $nilai;

    }

    public function getTotalKontrakTahunAttribute(){
        $nilai = 0;
        $itempekerjaan = Itempekerjaan::find($this->id);
        $code = $itempekerjaan->code;
        $nilai = 0;
        foreach (Itempekerjaan::where("code","like",$code."%")->whereYear("created_at",date("Y"))->get() as $key => $value) {
            $unitprogress = UnitProgress::where("itempekerjaan_id",$value->id)->get();
            if ( count($unitprogress) > 0 ){
                $nilai = $nilai + ( $unitprogress->first()->nilai * $unitprogress->first()->volume );
            }
        }
        return $nilai;

    }

    public function getTotalProgressAttribute(){
        $nilai = 0;
        $itempekerjaan = Itempekerjaan::find($this->id);
        $code = $itempekerjaan->code;
        $nilai = 0;
        foreach (Itempekerjaan::where("code","like",$code."%")->get() as $key => $value) {
            $unitprogress = UnitProgress::where("itempekerjaan_id",$value->id)->get();
            if ( count($unitprogress) > 0 ){
                echo $unitprogress->first()->progresslapangan_percent."\n";
                $nilai = $nilai + ( $unitprogress->first()->progresslapangan_percent);
            }
        }
        if ( $nilai > 0 ){
            $nilai = $nilai / count(Itempekerjaan::where("code","like",$code."%")->get());
        }
        return $nilai;

    }

    public function getTotalBapAttribute(){
        $nilai = 0;
        $itempekerjaan = Itempekerjaan::find($this->id);
        $code = $itempekerjaan->code;
        $nilai = 0;
        foreach (Itempekerjaan::where("code","like",$code."%")->get() as $key => $value) {
            $unitprogress = UnitProgress::where("itempekerjaan_id",$value->id)->get();
            if ( count($unitprogress) > 0 ){
                $nilai = $nilai + ( $unitprogress->first()->progressbap_percent);
            }
        }
        if ( $nilai > 0 ){
            $nilai = $nilai / count(Itempekerjaan::where("code","like",$code."%")->get());
        }
        return $nilai;

    }

    public function getTotalProgressTahunAttribute(){
        $nilai = 0;
        $itempekerjaan = Itempekerjaan::find($this->id);
        $code = $itempekerjaan->code;
        $nilai = 0;
        foreach (Itempekerjaan::where("code","like",$code."%")->whereYear("created_at",date("Y"))->get() as $key => $value) {
            $unitprogress = UnitProgress::where("itempekerjaan_id",$value->id)->get();
            if ( count($unitprogress) > 0 ){
                $nilai = $nilai + ( $unitprogress->first()->progresslapangan_percent);
            }
        }
        if ( $nilai > 0 ){
            $nilai = $nilai / count(Itempekerjaan::where("code","like",$code."%")->get());
        }
        return $nilai;

    }

    /*public function getItemSpkAttribute(){
        $itempekerjaan = Itempekerjaan::find($this->id);
        $code = $itempekerjaan->code;
        $spks = array();
        $start = 0;
        foreach (Itempekerjaan::where("code","like",$code."%")->get() as $key => $value) {
            $unitprogress = UnitProgress::where("itempekerjaan_id",$value->id)->get();
            //return $unitprogress;
            if ( count($unitprogress) > 0 ) {
                foreach ( $unitprogress as $key1 => $value1 ){          
                    foreach ($value1->unit->spks as $key => $value) {
                        # code...
                        $spks[$start] = $value->id;
                        $start++;
                    }
                }
            }
            
        }
        return array_values(array_unique($spks));
    }*/

    public function cost_report(){
        return $this->hasMany("App\CostReport","itempekerjaan");
    }

    public function getChildItemAttribute()
    {
        return $this->where('parent_id', $this->id)->get();
    }

    public function getItemProgressAttribute(){
        return $this->hasMany('Modules\Pekerjaan\Entities\ItempekerjaanProgress','item_pekerjaan_id')->get();
    }

    public function budget_tahunan_monthly(){
        return $this->hasOne("\Modules\Budget\Entities\BudgetTahunanPeriode");
    }

    public function progress_termyn(){
        return $this->hasMany("\Modules\Spk\Entities\SpkTermynDetail","item_pekerjaan_id");
    }
}

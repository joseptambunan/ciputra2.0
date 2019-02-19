<?php

namespace Modules\Pekerjaan\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Spk\Entities\Spk;
use Modules\Spk\Entities\SpkDetail;
use Modules\Spk\Entities\SpkvoUnit;
use Modules\Project\Entities\UnitProgress;
use Modules\Project\Entities\Project;
use Modules\Budget\Entities\BudgetTahunanPeriode;

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
        return $this->hasOne('Modules\Pekerjaan\Entities\ItempekerjaanDetail');
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
        return $this->hasMany('\Modules\Rab\Entities\RabPekerjaan');
    }

    public function bap_details()
    {
        return $this->belongsToMany('\Modules\Rab\Entities\BapDetail', 'bap_detail_itempekerjaans');
    }

    public function budget_tahunan(){
        return $this->hasMany('Modules\Budget\Entities\BudgetTahunanDetail');
    }

    public function unitprogress(){
        return $this->hasMany('Modules\Project\Entities\UnitProgress');
    }

    public function unitprogressbyyear($year){
        $nilai = 0;
        $items = $this->hasMany('Modules\Project\Entities\UnitProgress')->whereYear('created_at',$year)->get();
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
        return $this->hasMany("\Modules\Workorder\Entities\WorkorderBudgetDetail");
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

   
    public function cost_report(){
        return $this->hasMany("App\CostReport","itempekerjaan");
    }

    public function getChildItemAttribute()
    {
        return $this->where('parent_id', $this->id)->orderBy("code")->get();
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

    public function escrow(){
        return $this->belongsTo("Modules\Escrow\Entities\Escrow","escrow_id");
    }

    public function getItemSatuanAttribute(){
        $satuan = "";
        $detail = $this->details;
        if ( $detail != "" ){
            $satuan = $detail->satuan;
        }
        return $satuan;
    }

    public function getNilaiLowestAttribute(){
        $nilai = 0;
        $start = 0;
        $result = array();
        $code  = Itempekerjaan::find($this->id)->code;
        $all_item = Itempekerjaan::where("code","like",$code."%")->get();
        $spk = "";
        $satuan = "";
        foreach ($all_item as $key => $value) {
            $item_id = Itempekerjaan::find($value->id);
            $unit_progress = UnitProgress::where("itempekerjaan_id",$item_id->id)->get();

            if ( count($unit_progress) > 0 ){
                $unit_pekerjaan = UnitProgress::find($unit_progress->first()->id);
                $spk = $unit_pekerjaan->spkvo_unit->spk_detail->spk;
                if ( $unit_pekerjaan->spkvo_unit->spk_detail->spk != "" ){
                    $project = $spk->project->name;

                    if ( count($spk->detail_units) > 1 ){
                        foreach ($spk->detail_units as $key2 => $value2) {
                            if ( $value2->unit_progress->itempekerjaan->tag == 1 ){
                                $nilai = $value2->unit_progress->nilai / $value2->unit_progress->volume ;
                                $satuan = $value->unit_progress->satuan;
                            }
                        }
                    }else{
                        $nilai = $unit_pekerjaan->volume / $unit_pekerjaan->nilai ;
                        $satuan = $unit_pekerjaan->satuan;  
                    }    
                    $result[$start] = array("nilai" => $nilai, "project" => $project, "satuan" => $satuan);   
                    $start++;                 
                   
                } 

            }
        }

        if ( count($result) > 0 ){
            $now =(array_values(array_sort($result)));
            return reset($now);            
        }else{
            $result[0] = array("nilai" => "0", "project" => "" );
            $now =(array_values(array_sort($result)));
            return reset($now);
        }
    }

    public function getNilaiMaximumAttribute(){
        $nilai = 0;
        $start = 0;
        $result = array();
        $code  = Itempekerjaan::find($this->id)->code;
        $all_item = Itempekerjaan::where("code","like",$code."%")->get();
        $spk = "";
        $satuan = "";
        foreach ($all_item as $key => $value) {
            $item_id = Itempekerjaan::find($value->id);
            $unit_progress = UnitProgress::where("itempekerjaan_id",$item_id->id)->get();

            if ( count($unit_progress) > 0 ){
                $unit_pekerjaan = UnitProgress::find($unit_progress->first()->id);
                $spk = $unit_pekerjaan->spkvo_unit->spk_detail->spk;
                if ( $unit_pekerjaan->spkvo_unit->spk_detail->spk != "" ){
                    $project = $spk->project->name;

                    if ( count($spk->detail_units) > 1 ){
                        foreach ($spk->detail_units as $key2 => $value2) {
                            if ( $value2->unit_progress->itempekerjaan->tag == 1 ){
                                $nilai = $value2->unit_progress->nilai / $value2->unit_progress->volume ;
                                $satuan = $value->unit_progress->satuan;
                            }
                        }
                    }else{
                        $nilai = $unit_pekerjaan->volume / $unit_pekerjaan->nilai ;
                        $satuan = $unit_pekerjaan->satuan;  
                    }    
                    $result[$start] = array("nilai" => $nilai, "project" => $project, "satuan" => $satuan);   
                    $start++;                 
                   
                } 

            }
        }

        if ( count($result) > 0 ){
            $now =(array_values(array_sort($result)));
            return end($now);            
        }else{
            $result[0] = array("nilai" => "0", "project" => "" );
            $now =(array_values(array_sort($result)));
            return reset($now);
        }
    }

    public function harga(){
        return $this->hasMany("Modules\Pekerjaan\Entities\ItempekerjaanHarga");
    }

    public function hargadetail(){
        return $this->hasMany("Modules\Pekerjaan\Entities\ItempekerjaanHargaDetail");
    }

    public function getNilaiMasterSatuanAttribute(){
        $nilai = 0;
        foreach ($this->harga as $key => $value) {
            if ( $value->project_id == null ){
                $nilai = $value->nilai;
            }
        }
        return $nilai;
    }

    public function getNilaiLibraryAttribute(){
        $nilai = 0;
        foreach ($this->hargadetail as $key => $value) {
            if ( $value->project_id == null ){
                $nilai = $value->nilai;
            }
        }

        return $nilai;
    }

    public function getNilaiLowestLibraryAttribute(){
        $nilai= array();
        foreach ($this->harga as $key => $value) {    
            if ( $value->project_id != "" ){
                $nilai[$key] = array( "nilai" => $value->nilai, "project_id" => Project::find($value->project_id)->name ); 
            }               
        }   

        $now =(array_values(array_sort($nilai)));
        return reset($now);   
    }

    public function getNilaiMaxLibraryAttribute(){
        $nilai= array();
        foreach ($this->harga as $key => $value) {            
            if ( $value->project_id != "" ){
                $nilai[$key] = array( "nilai" => $value->nilai, "project_id" => Project::find($value->project_id)->name ); 
            }    
        }        

        $now =(array_values(array_sort($nilai)));
        return end($now);
    }

    public function budget_type_details(){
        return $this->hasOne("Modules\Budget\Entities\BudgetTypeDetail","itempekerjaan_id");
    }

    public function getNilaiCashflowAttribute($budget_tahunan,$id,$type,$nilai){
        $nilai = 0;
        if ( $type = "Total"){
            $budget_tahunan_periode = BudgetTahunanPeriode::where("budget_tahunan_id",$budget_tahunan)->where("itempekerjaan_id",$id)->get();
            if ( count($budget_tahunan_periode) > 0 ){
                foreach ($budget_tahunan_periode as $key => $value) {
                    $nilai = ( $value->januari * $nilai ) + ( $value->februari * $nilai ) +( $value->maret * $nilai ) +( $value->april * $nilai ) +( $value->mei * $nilai ) +( $value->juni * $nilai ) +( $value->juli * $nilai ) +( $value->agustus * $nilai ) +( $value->september * $nilai ) +( $value->oktober * $nilai ) +( $value->november * $nilai ) +( $value->desember * $nilai ) ;  
                }
            }
            return $nilai;
        }
    }

    public function rekanan_specification(){
        return $this->hasMany("Modules\Rekanan\Entities\RekananSpecification");
    }
}

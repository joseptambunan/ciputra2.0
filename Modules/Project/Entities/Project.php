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
        return $this->hasMany('Modules\Budget\Entities\Budget')->where("deleted_at",null);
    }

    public function budget_tahunans()
    {
        return $this->hasManyThrough('Modules\Budget\Entities\BudgetTahunan', 'Modules\Budget\Entities\Budget');
    }

    public function getWorkordersAttribute()
    {
        return \Modules\Workorder\Entities\Workorder::where( 'budget_tahunan_id',  $this->id )->get();
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
            if ( $each->deleted_at == null ){
                foreach ($each->details as $key2 => $value2 ) {
                    # code...
                    $nilai = ( $value2->nilai * $value2->volume ) + $nilai;
                }
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
            //$nilai = $nilai + $value->lahan_sellable;
            $nilai = $nilai + $value->netto_kawasan;
        }
        return $nilai;
    }

    public function unittype(){
        return $this->hasMany("Modules\Project\Entities\UnitType");
    }

    public function getHppDevCostReportAttribute(){
        foreach ($this->kawasans as $key => $value) {
            if ( $value->is_kawasan == "1"){
                $status = $value->budget_awal;
            }
        }
    }

    public function voucher(){
        return $this->hasMany("Modules\Voucher\Entities\Voucher");
    }

    public function getBudgetDepartmentAttribute(){
        $dept = array();
        foreach ($this->budgets as $key => $value) {
           $dept[$key] = $value->department->id; 
        }

        return array_values(array_unique($dept));
    }

    public function getNilaiTotalBapAttribute(){
        $nilai = 0;
        foreach ($this->spks as $key => $value) {
            $pembayaran = $value->bap * $value->nilai;
            $nilai = $nilai + $pembayaran;
        }
        return $nilai;
    }

    public function getPercentageBudgetAttribute(){
        $nilai = 0;
        if ( $this->nilai_budget_total == 0 ){
            return $nilai ;
        }else{
            $nilai = $this->nilai_total_bap / $this->nilai_budget_total;
        }

        return $nilai;
    }

    public function getTotalRekananAttribute(){
        $nilai = array();
        foreach($this->spks as $key => $value){
            $nilai[$key] = $value->rekanan_id;
        }

        return array_unique($nilai);
    }

    public function getTotalBapAttribute(){
        $nilai = 0;
        foreach ($this->spks as $key => $value) {
            $nilai = $nilai + $value->baps->count();
        }

        return $nilai;
    }

    public function getHppNettoAttribute(){
        $nilai = 0;
        if ( $this->netto <= 0 ){
            return $nilai;
        }else{
            return $this->total_budget_dev_cost / $this->netto;
        }
    }

    public function getTotalBudgetDevCostAttribute(){
        $nilai = 0;
        foreach ($this->budgets as $key => $value) {
            $nilai = $nilai + $value->total_dev_cost;
        }
        return $nilai;
    }

    public function hpp_update(){
        return $this->hasMany("Modules\Budget\Entities\HppUpdate");
    }

    public function getDevCostOnlyAttribute(){
        $nilai = 0;
        foreach ($this->spks as $key => $value) {
            if ( $value->itempekerjaan->group_cost == "1"){
                if ( $value->itempekerjaan->group_cost == "1" ){
                    $nilai = $nilai + ( $value->nilai + $value->nilai_vo );
                }
            }
        }
        
        return $nilai;
    }

    public function getDevCostTerbayarAttribute(){
        $nilai = 0;
        $devcost = $this->dev_cost_only;

        foreach( $this->spks as $key => $value ){
            if ( $value->itempekerjaan->group_cost == "1"){
                $nilai = $nilai + $value->baps->last()->nilai_bap_2;
            }
        }

        return $nilai;
    }

   /* public function getHutangBangunAttribute(){
        $nilai = 0;
        return $this->total_budget_dev_cost;
    }*/

    public function hadap(){
        return $this->hasMany("Modules\Project\Entities\UnitArah");
    }

    public function getHppNettoAwalAttribute(){
        $update = $this->hpp_update;
        if ( count($update) > 0 ){
            $hpp = $this->hpp_update->first()->nilai_budget / $this->hpp_update->first()->netto;
            return $hpp;
        }else{
            return 0;
        }
    }

    public function getHppNettoAkhirAttribute(){
        $update = $this->hpp_update;
        if ( count($update) > 0 ){
            $hpp = $this->hpp_update->last()->nilai_budget / $this->hpp_update->last()->netto;
            return $hpp;
        }else{
            return 0;
        }
    }

    public function summary_kontrak(){
        return $this->hasMany("Modules\Project\Entities\HppDevCostSummaryReport");
    }

    public function all_budgets(){
        return $this->hasMany('Modules\Budget\Entities\Budget');
    }

    public function getUnitTerjualAttribute(){
        $nilai = 0;
        foreach ($this->kawasans as $key => $value) {
            foreach ($value->bloks as $key2 => $value2) {
                foreach ($value2->units as $key3 => $value3) {
                    if ( $value3->is_sellable == 1 ){
                        $nilai = $value3->tanah_luas + $nilai;
                    }
                }
            }
        }

        return $nilai;
    }

    public function getUnitRencanaAttribute(){
        $nilai = 0;
        foreach ($this->kawasans as $key => $value) {
            foreach ($value->bloks as $key2 => $value2) {
                foreach ($value2->units as $key3 => $value3) {
                    if ( $value3->is_sellable != 1 ){
                        $nilai = $value3->tanah_luas + $nilai;
                    }
                }
            }
        }

        return $nilai;
    }

    public function getDevCostDibebankanAttribute(){
        $nilai = 0;
        foreach ($this->budgets as $key => $value) {
            if ( $value->deleted_at == null ){
                $nilai = $value->total_dev_cost + $nilai ;
            }
        }

        if ( $this->netto <= 0 ){
            $hpp_akhir = 0;
        }else{
            $hpp_akhir = $nilai / $this->netto;
        }

        if ( count($this->hpp_update) > 0 ){
            return $this->hpp_update->last()->luas_book * $hpp_akhir;
        }else{
            return 0;
        }
    }

    public function getPersediaanDevCostAttribute(){
        return $this->dev_cost_terbayar - $this->dev_cost_dibebankan;
    }

    public function getHutangBayarAttribute(){
        return $this->dev_cost_only - $this->dev_cost_terbayar;
    }

    public function getHutangBangunAttribute(){
        return $this->total_budget_dev_cost - ( $this->dev_cost_terbayar + $this->hutang_bayar );
    }

    public function getTotalDevCostAttribute(){
        return $this->persediaan_dev_cost + $this->hutang_bayar + $this->hutang_bangun;
    }

    public function getSalesBackLogAttribute(){
        if ( count($this->hpp_update) > 0 ){
            return $this->hpp_update->last()->luas_erem - $this->hpp_update->last()->luas_book;
        }else{
            return 0;
        }
    }

    public function getTotalStockAttribute(){
        if ( count($this->hpp_update) > 0 ){
            return ( $this->hpp_update->last()->luas_erem - $this->hpp_update->last()->luas_book ) + $this->unit_rencana;
        }else{
            return 0;
        }
    }

    public function getHppDevCostUpdAttribute(){
        if ( $this->total_stock <= 0 ){
            return 0;
        }else{
            return $this->total_dev_cost / $this->total_stock;
        }
    }
}

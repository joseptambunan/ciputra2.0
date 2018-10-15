<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Approval;

class Budget extends Model
{
    use Approval;

    protected $dates = ['start_date', 'end_date'];
    protected $fillable = ['pt_id','department_id','project_id','project_kawasan_id','no','start_date','end_date','description'];

    protected $casts = [
        'nilai' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project', 'project_id');
    }

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department');
    }

    public function kawasan()
    {
    	return $this->belongsTo('Modules\Project\Entities\ProjectKawasan', 'project_kawasan_id');
    }

    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt',"pt_id");
    }

    public function parent()
    {
        return $this->belongsTo('Modules\Budget\Entities\Budget', 'parent_id');
    }

    public function scopeNonRevisi($query)
    {
        return $query;
    }

    public function details()
    {
        return $this->hasMany('Modules\Budget\Entities\BudgetDetail')->distinct();
    }

    public function budget_tahunans()
    {
        return $this->hasMany('Modules\Budget\Entities\BudgetTahunan');
    }

    public function getNilaiAttribute()
    {
        $nilai = 0;
        foreach ( $this->details as $key => $value) {
            # code...
            $nilai = ( $value->nilai * $value->volume ) + $nilai;
        }

        return $nilai;
    }

    public function getLastVoucherDateAttribute()
    {
        return \Carbon\Carbon::now();
    }

    public function getNilaiSisaAttribute()
    {
        $nilai = $this->details()->sum('nilai');

        foreach ($this->budget_tahunans as $key => $each) 
        {
            $nilai_tahunan[$key] = $each->nilai;
        }

        return $nilai - array_sum($nilai_tahunan);
    }

    public function itempekerjaans()
    {
        return \Modules\Pekerjaan\Entities\Itempekerjaan::whereHas('budget_details', function($q) 
        {
            $q->whereHas('budget', function($r)
            {
                $r->where('id', $this->id);
            });
        });
    }

    public function getItempekerjaansAttribute()
    {
        return $this->itempekerjaans()->get();
    }

    public function getParentIdsAttribute(){
        $nilai = array();
        foreach ($this->details as $key => $value) {
            # code...
            $code = explode(".",$value->itempekerjaan->code);
            $nilai[$key] = $code[0];
        }
        
        $uniqe = array_unique($nilai);
        return array_values($uniqe);
    }

    public function getSelfApprovalAttribute(){
        return $this->hasMany("Modules\Approval\Entities\ApprovalHistory","document_id");
    }

    public function template(){
        return $this->hasMany("Modules\Budget\Entities\BudgetType");
    }

    public function type(){
        return $this->hasMany("Modules\Budget\Entities\BudgetType","type_id");
    }

    public function getUnitTypeAttribute(){
        $unit = array("");
        $unit_type = array("");
        if ( $this->project_kawasan_id != "" ){
            $kawasan = ProjectKawasan::find($this->project_kawasan_id);
            foreach ($kawasan->bloks as $key => $value) {
                foreach ( $value->units as $key2 => $value2 ){
                    $unit_type[$key] = $value2->unit_type_id .",". $value2->templatepekerjaan_id;
                }
            }        

            $unit_type = array_values(array_unique($unit_type));
            if ( count($unit_type) > 0 ){
                for ( $i=0; $i < count($unit_type); $i++ ){
                    $explode_unit = explode(",",$unit_type[$i]);
                    $unit[$i] = array("unit_type" => $explode_unit[0], "template_id" => $explode_unit[1]);
                }
            }
        }

        return $unit;
    }

    public function getNilaiConCostAttribute(){
        $nilai = 0;
        foreach ($this->type as $key => $value) {
            # code...
            foreach ( $value->details as $key2 => $value2 ){
                $nilai = $nilai + ( $value2->volume * $value2->nilai);
            }
        }
        
        return $nilai;
    }

    public function getTotalDevCostAttribute(){
        $nilai = 0;
        foreach ($this->details as $key => $value) {
            # code...
            if ( \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->itempekerjaan_id)->group_cost == "1"){
                $nilai = $nilai + ( $value->volume * $value->nilai);
            }
        }
        return $nilai ;
    }

    public function getTotalConCostAttribute(){
        $nilai = 0;
        foreach ($this->details as $key => $value) {
            # code...
            if ( \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->itempekerjaan_id)->group_cost == "2"){
                $nilai = $nilai + ( $value->volume * $value->nilai);
            }
        }
        return $nilai ;
    }

    public function approval_status(){
        return $this->belongsTo("Modules\Approval\Entities\Approval","document_id");
    }

    public function getTotalParentItemAttribute(){
        $nilai = array();
        foreach ($this->details as $key => $value) {
            # code...
            $code = explode(".",$value->itempekerjaan->code);
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
            $id = "";
            $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code","like",$item_id[$i]."%")->get();
            foreach ($itempekerjaan as $key => $value) {
                $budgets = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value->id)->where("budget_id",$this->id)->first();
                if ( isset($budgets->volume)){
                    
                    $total_nilai = $total_nilai + $budgets->nilai;
                    $total_volume = $total_volume + $budgets->volume;
                    $satuan = $budgets->satuan;
                    $id = $value->id;
                    $total = $total + ( $budgets->nilai * $budgets->volume );
                }
            }
            $arrayResult[$i] = array("id" => $item_id[$i], "nilai" => $total_nilai, "volume" => $total_volume, "satuan" => $satuan, "id" => $id, "total" => $total);
        }
        return $arrayResult;
    }

    public function draft(){
        return $this->hasMany("Modules\BudgetDraft\Entities\BudgetDraft","budget_parent_id");
    }

   
}

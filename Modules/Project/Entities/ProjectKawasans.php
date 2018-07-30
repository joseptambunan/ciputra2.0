<?php

namespace App;

use App\CustomModel;

class ProjectKawasan extends CustomModel
{
    protected $fillable = ['project_id','project_type_id','code','name','lahan_status','lahan_luas','hpptanahpermeter','zipcode','is_kawasan','description'];

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function project_type()
    {
        return $this->belongsTo('App\ProjectType', 'project_type_id');
    }

    public function bloks()
    {
        return $this->hasMany('App\Blok');
    }
    
	public function budgets()
    {
        return $this->hasMany('App\Budget');
    }

    public function units()
    {
        return $this->hasManyThrough('App\Unit', 'App\Blok');
    }

    public function workorder_details()
    {
        return $this->morphMany('App\WorkorderDetail', 'asset');
    }
    public function rab_units()
    {
        return $this->morphMany('App\RabUnit', 'asset');
    }
    public function tender_units()
    {
        return $this->morphMany('App\TenderUnit', 'asset');
    }
    public function spk_details()
    {
        return $this->morphMany('App\SpkDetail', 'asset');
    }
    public function progresses()
    {
        return $this->morphMany('App\UnitProgress', 'unit');
    }
    public function getCalculateBobotAttribute()
    {
        $total = 0;

        foreach ($this->progresses as $key => $each) 
        {
            $total = $total + ($each->nilai * $each->volume);
        }

        foreach ($this->progresses as $key => $detail) 
        {
            $detail->update([
                'bobot'=> $detail->nilai * $detail->volume / $total
            ]);
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

    public function getHppBudgetAttribute()
    {
        $nilai = 0;

        $items = \App\Itempekerjaan::where('group_cost',1)->get(['id']);

        $budget_details = \App\BudgetDetail::whereHas('budget', function($q){
                $q->where('project_kawasan_id', $this->id);
            })
            ->whereHas('itempekerjaan', function($q) use ($items){
                $q->whereIn('id', $items);
            })
            ->get();

        foreach ($budget_details as $key => $detail) 
        {
            $nilai = $nilai + $detail->nilai;
        }

        return $nilai;
    }

    public function getHppKontrakAttribute()
    {
        return 0;
        // $nilai = 0;

        // $items = \App\Itempekerjaan::where('group_cost',1)->get(['id']);

        // $spk_details = \App\SpkDetail::whereHas('spk')
        //     ->whereHas('details', function($q) use ($items){
        //         $q->whereHas('unit_progress', function($r) use ($items){
        //             $r->whereIn('id', $items);
        //         });
        //     })
        //     ->where('asset_id', $this->id)
        //     ->where('asset_type', 'App\ProjectKawasan')
        //     ->get();

        // foreach ($spk_details as $key => $detail) 
        // {
        //     foreach ($detail->details as $key => $spkvo) 
        //     {
        //         $nilai = $nilai + $spkvo->nilai * $spkvo->volume;
        //     }
        // }

        // return $nilai;
    }

    public function getHppRealisasiAttribute()
    {
        return 0;
    }
    
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
        if (($this->lahan_luas <= 0) OR ($this->project->luas <= 0))
        {
            return 0;
        }

        $nilai = 0;

        foreach ($this->progresses as $key => $progress) 
        {
            $nilai += $progress->nilai * $progress->volume;
        }

        $dev_cost_project = $this->project->dev_cost * $this->lahan_luas / $this->project->luas;

        return $nilai + $dev_cost_project;
    }

    public function getEfisiensiAttribute()
    {
        $efektif = 0;

        foreach ($units as $key => $unit) 
        {
            $efektif += $unit->tanah_luas;
        }

        return $efektif / $this->lahan_luas;
    }
    public function getNilaiKontrakAttribute()
    {
        return $this->con_cost_kontrak;
    }
    public function getDevCostBudgetBrutoAttribute()
    {
        $nilai = 0;

        foreach ($this->budgets as $key => $budget) 
        {
            foreach ($budget->details as $key => $detail) 
            {
                $nilai += $detail->nilai;
            }
        }

        return $nilai;
    }
    public function getDevCostBudgetNettoAttribute()
    {
        return $this->dev_cost_budget_bruto / $this->efisiensi;
    }
    public function getDevCostKontrakBrutoAttribute()
    {
        $spk = 0;

        foreach ($this->progresses as $key => $progress) 
        {
            $spk += $progress->spk * $progress->volume;
        }

        //
        
        $project = 0;
        
        //
        
        $sellable = 0;

        return $spk + $project + $sellable;
    }
    public function getDevCostKontrakNettoAttribute(){}
    public function getDevCostRealisasiBrutoAttribute(){}
    public function getDevCostRealisasiNettoAttribute(){}

    public function getConCostBudgetAttribute()
    {
        $nilai = 0;

        foreach ($this->units as $key => $unit) 
        {
            $nilai += $unit->con_cost_budget;
        }

        return $nilai;
    }
    public function getConCostKontrakAttribute()
    {
        $nilai = 0;

        foreach ($this->units as $key => $unit) 
        {
            $nilai += $unit->con_cost_kontrak;
        }

        return $nilai;
    }
    public function getConCostRealisasiAttribute()
    {
        $nilai = 0;

        foreach ($this->units as $key => $unit) 
        {
            $nilai += $unit->con_cost_realisasi;
        }

        return $nilai;
    }
}
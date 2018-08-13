<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
    public function kawasan()
    {
        return $this->belongsTo('Modules\Project\Entities\ProjectKawasan', 'project_kawasan_id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Project\Entities\Unit');
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

    public function getProjectAtribute()
    {
        return $this->kawasan->project;
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
        if (($this->luas <= 0) OR ($this->kawasan->lahan_luas <= 0))
        {
            return 0;
        }

        $nilai = 0;

        foreach ($this->progresses as $key => $progress) 
        {
            $nilai += $progress->nilai * $progress->volume;
        }

        $dev_cost_project = $this->kawasan->dev_cost * $this->luas / $this->kawasan->lahan_luas;

        return $nilai + $dev_cost_project;
    }

    public function getCalculateBobotAttribute()
    {
        $total = 0;

        foreach ($this->progresses()->where('is_pembangunan', true)->get() as $key => $each) 
        {
            $total = $total + ($each->nilai * $each->volume);
        }

        foreach ($this->progresses as $key => $detail) 
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

    public function getTemplatePekerjaanAttribute(){
        $template = array();
        foreach ($this->units as $key => $value) {
            # code...
            $template[$key] = $value->templatepekerjaan_id;
        }
        $template = array_unique($template);
        return $template;
    }

    public function project_kawasan(){
        return $this->belongsTo("Modules\Project\Entities\ProjectKawasan");
    }
}

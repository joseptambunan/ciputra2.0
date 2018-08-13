<?php

namespace Modules\Project\Entities;

use App\CustomModel;

class Unit extends CustomModel
{
    protected $dates = ['st1_date', 'st2_date'];
    protected $fillable = [
                            'blok_id',
                            'templatepekerjaan_id',
                            'pt_id',
                            'peruntukan_id',
                            'unit_arah_id',
                            'unit_type_id',
                            'code',
                            'name',
                            'tanah_luas',
                            'bangunan_luas',
                            'is_sellable',
                            'status',
                            'tag_kategori',
                            'st1_date',
                            'st2_date'];

    public function getProjectAttribute()
    {
        return $this->blok->kawasan->project;
    }

    public function scopeSessionProject($query)
    {
        return $query->whereHas('blok',function($q){
            $q->whereHas('kawasan',function($r){
                $r->where('project_id', session('project'));
            });
        });
    }

    public function blok()
    {
        return $this->belongsTo('Modules\Project\Entities\Blok');
    }

    public function templatepekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Templatepekerjaan');
    }

    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt');
    }

    public function peruntukan()
    {
        return $this->belongsTo('App\Peruntukan');
    }

    public function arah()
    {
        return $this->belongsTo('Modules\Project\Entities\UnitArah', 'unit_arah_id');
    }

    public function type()
    {
        return $this->belongsTo('Modules\Project\Entities\UnitType', 'unit_type_id');
    }

    // public function progresses()
    // {
    //     return $this->hasMany('App\UnitProgress');
    // }

    public function subs()
    {
        return $this->hasMany('Modules\Project\Entities\UnitSub');
    }

    public function warehouses()
    {
        return $this->morphMany('App\Warehouse', 'head');
    }

    public function tender_menangs()
    {
        return $this->hasMany('App\TenderMenang', 'asset_id')->where('asset_type', 'App\Unit');
    }

    public function spks()
    {
        return  \App\Spk::whereHas('details', function($q){ $q->where('asset_id', $this->id)->where('asset_type','App\Unit'); });
    }

    public function getSpksAttribute()
    {
        return  \App\Spk::whereHas('details', function($q){ $q->where('asset_id', $this->id)->where('asset_type','App\Unit'); })->get();
    }


    public function getProgressLapanganAttribute()
    {
        $progresses = $this->progresses()->where('is_pembangunan', true)->get();

        if ($progresses->count() == 0) 
        {
            foreach ($this->templatepekerjaan->details as $key => $each) 
            {
                $this->progresses()->create([
                    'project_id'=> $this->blok->kawasan->project->id,
                    
                    'itempekerjaan_id'=> $each->itempekerjaan_id,
                    'group_tahapan_id'=> $each->group_tahapan_id,
                    'group_item_id'=> $each->group_item_id,

                    'progresslapangan_percent'=> 0,
                    'progressbap_percent'=> 0,
                    'urutitem'=> $each->urutitem,
                    'termin'=> $each->termin,
                    'nilai'=> $each->nilai,
                    'volume'=> $each->volume,
                    'satuan'=> $each->satuan,
                    'bobot'=> $each->bobot,
                    'durasi'=> $each->durasi,
                    'is_pembangunan'=> $each->is_pembangunan
                ]);
            }
        }

        $total = array();

        foreach ($progresses as $key => $each) 
        {
            $total[$key] = $each->progresslapangan_percent * $each->bobot;
        }

        $percent = array_sum($total);

        if ($percent > 0.99) 
        {
            return 1;
        }else{
            return $percent;
        }
    }

    public function getProgressBapAttribute()
    {
        return 0 .' %';

        return $this->details()->sum('nilai');
    }

    public function getNilaiAttribute()
    {
        $nilai = array();

        foreach ($this->progresses as $key => $each) 
        {
            $nilai[$key] = $each->nilai * $each->volume ;//* ( 1 + $each->itempekerjaan->ppn );
        }

        return array_sum($nilai);
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

    public function getNilaiKontrakAttribute()
    {
        return $this->con_cost_kontrak;
    }
    public function getDevCostBudgetAttribute()
    {
        $nilai = array();

        foreach ($this->rab_units as $key => $rab_unit) 
        {
            foreach ($rab_unit->pekerjaans()->conCost()->get() as $key => $pekerjaan) 
            {
                $nilai[$key] = $pekerjaan->nilai * $pekerjaan->volume;
            }
        }

        return array_sum($nilai);
    }
    public function getDevCostKontrakAttribute()
    {
        $nilai = array();

        foreach ($this->progresses()->conCost()->get() as $key => $progress) 
        {
            $nilai[$key] = $progress->nilai * $progress->volume;
        }

        return array_sum($nilai);
    }
    public function getDevCostRealisasiAttribute(){}

    public function getConCostBudgetAttribute()
    {
        $nilai = array();

        foreach ($this->rab_units as $key => $rab_unit) 
        {
            foreach ($rab_unit->pekerjaans()->devCost()->get() as $key => $pekerjaan) 
            {
                $nilai[$key] = $pekerjaan->nilai * $pekerjaan->volume;
            }
        }

        return array_sum($nilai);
    }
    public function getConCostKontrakAttribute()
    {
        $nilai = array();

        foreach ($this->progresses()->devCost()->get() as $key => $progress) 
        {
            $nilai[$key] = $progress->nilai * $progress->volume;
        }

        return array_sum($nilai);
    }
    public function getConCostRealisasiAttribute(){}

    
}

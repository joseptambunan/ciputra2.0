<?php

namespace Modules\Spk\Entities;

use App\CustomModel;
use App\Traits\Approval;

class Vo extends CustomModel
{
    use Approval;

    protected $dates = ['date'];
    protected $fillable = ['suratinstruksi_id','no','date','urutan','description'];

    public function suratinstruksi()
    {
        return $this->belongsTo('Modules\Spk\Entities\Suratinstruksi');
    }

    public function getSpkAttribute()
    {
        return $this->suratinstruksi->spk;
    }

    public function details()
    {
        return $this->morphMany('Modules\Spk\Entities\SpkvoUnit', 'head');
    }

    public function getNilaiAttribute()
    {
        $nilai = array();

        foreach ($this->details as $key => $value) 
        {
            $nilai[$key] = $value->nilai * $value->volume;
        }
        return array_sum($nilai);
    }

    public function getProgressesAttribute()
    {
        return \App\UnitProgress::whereHas('spkvo_unit', function($spkvounit){
            $spkvounit->where('head_type','Modules\Spk\Entities\Vo')->where('head_id', $this->id);
        })->get();
    }

    public function getNilaiPpnKontrakAttribute()
    {
        $total = array();

        foreach ($this->details as $key => $each) 
        {
            $total[$key] = $each->volume * $each->nilai * $each->ppn ;
        }

        return array_sum($total);
    }

    public function getNilaiPpnAttribute()
    {
        if ($this->details->count() == 0) {
            return 0;
        }

        $detail_units = $this->details;
        $progresses = $this->progresses;

        if ($this->spk->lapangan >= 1) 
        {
            $percent_retensi = $this->spk->retensis()->sum('percent');
        }else{
            $percent_retensi = $this->spk->retensis()->where('is_progress', TRUE)->sum('percent');
        }

        $total = array();

        foreach ($detail_units as $key => $each) 
        {
            $nilai_lapangan = $each->volume * $each->nilai * $progresses[$key]->progresslapangan_percent;

            // termin retensi tidak ada retensi
            
            if ($this->spk->st1_date) 
            {
                $nilai_setelah_retensi = $nilai_lapangan;

            }else{

                $nilai_setelah_retensi = $nilai_lapangan * (1 - $percent_retensi);
            }

            $total[$key] = $nilai_setelah_retensi * $each->ppn ;
        }

        return array_sum($total);
    }

    public function getPtAttribute()
    {
        return $this->spk->pt;
    }

   public function unit(){
    return $this->belongsTo("Modules\Spk\Entities\SuratinstruksiUnit","suratinstruksi_unit_id");
   }
}

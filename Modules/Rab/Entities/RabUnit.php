<?php

namespace Modules\Rab\Entities;

use Illuminate\Database\Eloquent\Model;

class RabUnit extends Model
{
    protected $fillable = [];

     public function rab()
    {
        return $this->belongsTo('Modules\Rab\Entities\Rab');
    }

    public function tender_unit()
    {
        return $this->hasOne('Modules\Tender\Entities\TenderUnit');
    }
    
    public function templatepekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\templatepekerjaan');
    }

    public function pekerjaans()
    {
        return $this->hasMany('Modules\Rab\Entities\RabPekerjaan');
    }

    public function itempekerjaans()
    {
        return \App\Itempekerjaan::whereHas('rab_pekerjaans', function($q)
        {
            $q->where('rab_unit_id', $this->id);
        });
    }

    public function getItempekerjaansAttribute()
    {
        return $this->itempekerjaans()->get();
    }

    public function getNilaiAttribute()
    {
        $nilai = 0;
        
        foreach($this->pekerjaans as $key => $each)
        {
            //$ppn = ($each->nilai * $each->volume) //* $each->ppn;
            //$nilai = $nilai + ( ($each->nilai * $each->volume)  * ($each->ppn + 1));
            $nilai = $nilai + ($each->nilai * $each->volume) ;//+ $ppn );
        }

        return round($nilai);
    }

    public function asset()
    {
        return $this->morphTo();
    }
}

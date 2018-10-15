<?php

namespace Modules\Spk\Entities;

use App\CustomModel;
use App\Traits\Approval;

class Suratinstruksi extends CustomModel
{
    use Approval;

    protected $fillable = ['spk_id', 'no','date','perihal','biaya','is_tambahbiaya','start_date','finish_date','type'];
    protected $dates = ['date','start_date','finish_date'];

    public function vos()
    {
        return $this->hasMany('Modules\Spk\Entities\Vo');
    }

    public function spk()
    {
        return $this->belongsTo('Modules\Spk\Entities\Spk');
    }

    public function scopeSik($query)
    {
        return $query->where('type','sik');
    }

    public function scopeSil($query)
    {
        return $query->where('type','sil');
    }

    public function getPtAttribute()
    {
        if ($this->spk) 
        {
            return $this->spk->pt;
        }else{
            return null;
        }
    }

    public function getNilaiAttribute()
    {
        return $this->spk->nilai;
    }

    public function units(){
        return $this->hasMany("\Modules\Spk\Entities\SuratInstruksiUnit");
    }
    
}

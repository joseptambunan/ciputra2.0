<?php

namespace Modules\Rekanan\Entities;

use App\CustomModel;

class Rekanan extends CustomModel
{
	protected $fillable = ['kelas_id','description'];

    public function group()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\RekananGroup', 'rekanan_group_id');
    }

    public function kelas()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\RekananKelas', 'kelas_id');
    }

    public function city()
    {
        return $this->belongsTo('Modules\Country\Entities\City', 'surat_kota');
    }

    public function tender_rekanans()
    {
        return $this->hasMany('Modules\Tender\Entities\TenderRekanan');
    }

    public function rekenings()
    {
        return $this->hasMany('Modules\Rekanan\Entities\RekananRekening');
    }

    public function supps()
    {
        return $this->hasMany('Modules\Rekanan\Entities\RekananSupp');
    }

    public function piutangs()
    {
        return $this->hasMany('Modules\Spk\Entities\Piutang');
    }

    public function getPiutangAttribute()
    {
        $piutang = $this->piutangs()->sum('nilai');

        foreach ($this->piutangs as $key => $value) 
        {
            $piutang = $piutang - $value->pembayarans()->sum('nilai');
        }

        return $piutang;
    }

    public function spks(){
        return $this->hasMany("Modules\Spk\Entities\Spk");
    }

    public function project(){
        return $this->belongsTo("Modules\Project\Entities\Project");
    }
}

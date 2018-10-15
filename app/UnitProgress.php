<?php

namespace App;

use App\CustomModel;

class UnitProgress extends CustomModel
{
	protected $dates = ['mulai_jadwal_date','selesai_jadwal_date', 'selesai_actual_date'];
    protected $fillable = [
        'project_id',
        'unit_id',
        'unit_type',
        'itempekerjaan_id',
        'group_tahapan_id',
        'group_item_id',
        'progresslapangan_percent',
        'progressbap_percent', 
        'mulai_jadwal_date', 
        'selesai_jadwal_date', 
        'selesai_actual_date',
        'urutitem',
        'termin',
        'nilai',
        'volume',
        'satuan',
        'bobot',
        'durasi',
        'is_pembangunan'
    ];

    public function details()
    {
        return $this->hasMany('Modules\Project\Entities\UnitProgressDetail');
    }

    public function itempekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan');
    }

    public function unit()
    {
        return $this->morphTo();
    }

    public function item_pekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan');
    }

    public function spkvo_unit()
    {
        return $this->hasOne('Modules\Spk\Entities\SpkvoUnit');
    }

    public function getDocumentAttribute()
    {
        if ($this->spkvo_unit) 
        {
            return $this->spkvo_unit->head;
        }else{
            return $this->spkvo_unit;
        }
    }

    public function scopeDevCost($query)
    {
        return $query->whereHas('itempekerjaan', function($q){ 
            $q->whereGroupCost(2); 
        });
    }

    public function scopeConCost($query)
    {
        return $query->whereHas('itempekerjaan', function($q){ 
            $q->whereGroupCost(1); 
        });
    }
}

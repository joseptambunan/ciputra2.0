<?php

namespace Modules\Rab\Entities;

use Illuminate\Database\Eloquent\Model;

class RabPekerjaan extends Model
{
    protected $fillable = [];

    public function rab_unit()
    {
        return $this->belongsTo('Modules\Rab\Entities\RabUnit');
    }

    public function getRabAttribute()
    {
        return $this->rab_unit->rab;
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Project\Entities\Unit');
    }

    public function templatepekerjaan_detail()  // join dari tbl rab_pekerjaans
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\TemplatepekerjaanDetail', 'templatepekerjaan_detail_id');
    }
    
    public function itempekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan');
        //return $this->belongsTo('Modules\Workorder\Entities\WorkorderBudgetDetail',"itempekerjaan_id");
    }

    public function itempekerjaan_detail()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\ItempekerjaanDetail');
    }

    public function tender_penawaran_details()
    {
        return $this->hasMany('Modules\Tender\Entities\TenderPenawaranDetail');
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

    public function getTenderDetailAttribute($penawaranid){
        return $penawaranid;
    }
    
}

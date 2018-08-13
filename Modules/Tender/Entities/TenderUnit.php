<?php

namespace Modules\Tender\Entities;

use App\CustomModel;

class TenderUnit extends CustomModel
{
    protected $fillable = ['rab_unit_id', 'tender_id'];

    public function rab_unit()
    {
        return $this->belongsTo('Modules\Rab\Entities\RabUnit');
    }

    public function tender()
    {
        return $this->belongsTo('Modules\Tender\Entities\Tender');
    }

    public function unit()
    {
        return $this->rab_unit->unit();
    }

    public function menangs()
    {
        return $this->hasMany('Modules\Tender\Entities\TenderMenang');
    }

    public function asset()
    {
        return $this->morphTo();
    }
}

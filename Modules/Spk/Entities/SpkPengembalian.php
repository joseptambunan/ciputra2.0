<?php

namespace Modules\Spk\Entities;

use App\CustomModel;

class SpkPengembalian extends CustomModel
{
    protected $fillable = [
        'spk_id',
        'termin',
        'percent'
    ];

    public function spk()
    {
        return $this->belongsTo('Modules\Spk\Entities\Spk');
    }
}

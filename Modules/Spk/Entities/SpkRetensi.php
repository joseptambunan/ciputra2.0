<?php

namespace Modules\Spk\Entities;

use App\CustomModel;

class SpkRetensi extends CustomModel
{
    protected $fillable = ['percent','hari','is_progress'];

    public function spk()
    {
        return $this->belongsTo('Modules\Spk\Entities\Spk');
    }
}

<?php

namespace Modules\Spk\Entities;

use App\CustomModel;

class BapPph extends CustomModel
{
    protected $fillable = ['bap_id','coa_id','percent','description'];

    public function bap()
    {
        return $this->belongsTo('Modules\Spk\Entities\Bap');
    }

    public function coa()
    {
        return $this->belongsTo('Modules\Spk\Entities\Coa');
    }
}

<?php

namespace Modules\Rekanan\Entities;

use App\CustomModel;

class RekananRekening extends CustomModel
{
    protected $fillable = ['rekanan_id','bank_id','nama_rekening','no','description'];

    public function bank()
    {
        return $this->belongsTo('Modules\Bank\Entities\Bank', 'bank_id');
    }

    public function rekanan()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\Rekanan', 'rekanan_id');
    }
}

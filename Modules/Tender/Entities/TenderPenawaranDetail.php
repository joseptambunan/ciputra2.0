<?php

namespace Modules\Tender\Entities;

use App\CustomModel;

class TenderPenawaranDetail extends CustomModel
{
    protected $fillable = ['tender_penawaran_id', 'rab_pekerjaan_id', 'keterangan', 'nilai', 'volume'];

    public function tender_penawaran()
    {
        return $this->belongsTo('Modules\Tender\Entities\TenderPenawaran');
    }

    public function rab_pekerjaan()
    {
        return $this->belongsTo('Modules\Rab\Entities\RabPekerjaan');
    }

    public function getTotalAttribute()
    {
        return $this->nilai * $this->volume * (1 + $this->rab_pekerjaan->ppn);
    }

   
}

<?php

namespace Modules\Tender\Entities;

use App\CustomModel;

class TenderMenangDetail extends CustomModel
{
    protected $fillable = ['templatepekerjaan_detail_id','itempekerjaan_id','is_pembangunan','nilai','volume','satuan','ppn','description'];

    public function templatepekerjaan_detail()
    {
        return $this->belongsTo('Modules\Project\Entities\TemplatepekerjaanDetail');
    }
    public function itempekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan');
    }
    public function tender_menang()
    {
        return $this->belongsTo('Modules\Tender\Entities\TenderMenang');
    }

    public function templatepekerjaan(){
        return $this->belongsTo('Modules\Pekerjaan\Entities\Templatepekerjaan','templatepekerjaan_detail_id');
    }
}

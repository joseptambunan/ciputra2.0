<?php

namespace Modules\Tender\Entities;

use App\CustomModel;
use App\Traits\Approval;

class TenderKorespondensi extends CustomModel
{
	use Approval;

	protected $fillable = ['tender_rekanan_id','no','type','date','diundang_at','tempat_undangan','due_at'];

    public function tender_rekanan()
    {
        return $this->belongsTo('Modules\Tender\Entities\TenderRekanan');
    }

    public function getPtAttribute()
    {
        return $this->tender_rekanan->tender->rab->workorder->pt;
    }

    public function getNilaiAttribute()
    {
        return $this->tender_rekanan->tender->nilai;
    }

    public function project(){
        return $this->tender_rekanan->tender->rab->workorder->project;
    }
}

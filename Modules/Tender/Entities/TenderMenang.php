<?php

namespace Modules\Tender\Entities;

use App\CustomModel;
use App\Traits\Approval;

class TenderMenang extends CustomModel
{

    use Approval;
    protected $fillable = ['tender_id','tender_unit_id','tender_rekanan_id','asset_id','asset_type','description'];

    public function getPtAttribute()
    {
        return $this->tender_rekanan->tender->rab->workorder->project->first()->pt->first()->pt;
    }

    public function tender_rekanan()
    {
        return $this->belongsTo('Modules\Tender\Entities\TenderRekanan');
    }

    public function tender_unit()
    {
        return $this->belongsTo('Modules\Tender\Entities\TenderUnit');
    }

    public function asset()
    {
        return $this->morphTo();
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Project\Entities\Unit', 'asset_id')->where('asset_type', 'Modules\Project\Entities\Unit');
    }
    public function kawasan()
    {
        return $this->belongsTo('Modules\Project\Entities\ProjectKawasan', 'asset_id')->where('asset_type', 'Modules\Project\Entities\ProjectKawasan');
    }
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project', 'asset_id')->where('asset_type', 'Modules\Project\Entities\Project');
    }

    public function details()
    {
        return $this->hasMany('Modules\Tender\Entities\TenderMenangDetail');
    }

    public function getTenderAttribute()
    {
        return $this->tender_rekanan->tender;
    }

    public function rekanan()
    {
        return $this->tender_rekanan->rekanan();
    }

    public function getNilaiAttribute()
    {
        $total = array();

        foreach ($this->details as $key => $each) 
        {
            $total[$key] = $each->nilai * $each->volume;
        }

        return array_sum($total);
    }


}

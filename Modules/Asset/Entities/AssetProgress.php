<?php

namespace Modules\Asset\Entities;

use App\CustomModel;

class AssetProgress extends CustomModel
{
	protected $dates = ['mulai_jadwal_date','selesai_jadwal_date', 'selesai_actual_date'];
    protected $fillable = ['asset_type','asset_id','templatepekerjaan_detail_id', 'progresslapangan_percent','progressbap_percent', 'mulai_jadwal_date', 'selesai_jadwal_date', 'selesai_actual_date'];

    public function templatepekerjaan_detail()
    {
        return $this->belongsTo('Modules\Project\Entities\TemplatepekerjaanDetail');
    }

    public function asset()
    {
        return $this->morphTo();
    }

    public function item_pekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan');
    }

    public function spkvo_unit()
    {
        return $this->hasOne('App\SpkvoUnit');
    }
}

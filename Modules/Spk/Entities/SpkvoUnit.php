<?php

namespace Modules\Spk\Entities;

use App\CustomModel;

class SpkvoUnit extends CustomModel
{
	protected $fillable = [
		'head_type',
		'head_id',
		'spk_detail_id', 
		'templatepekerjaan_id',
		'unit_progress_id', 
		'nilai', 
		'description', 
		'volume', 
		'satuan', 
		'ppn',
	];

    public function unit_progress()
    {
        return $this->belongsTo('Modules\Project\Entities\UnitProgress');
    }

    public function templatepekerjaan()
    {
        return $this->belongsTo('Modules\Project\Entities\Templatepekerjaan');
    }

    public function head()
    {
        return $this->morphTo();
    }

    public function spk_detail()
    {
        return $this->belongsTo('Modules\Spk\Entities\SpkDetail', 'spk_detail_id');
    }

    // this for satuan table vo
    public function item_satuan()
    {
        return $this->belongsTo('Modules\Item\Entities\ItemSatuan', 'satuan');
    }

    // this for nilai on voucher itempekerjaan
    public function bap_itempekerjaan_detail()
    {
        return $this->belongsTo('Modules\Bap\Entities\BapDetailItempekerjaan', 'id');
    }

    public function getNilaiTotalAttribute()
    {
        return $this->nilai * $this->volume;
    }

    public function getNilaiPpnAttribute()
    {
        return $this->nilai_total * $this->ppn;
    }

    public function getNilaiDpAttribute()
    {
        return $this->nilai_total * ( $this->spk_detail->spk->dp_percent / 100 );
    }

    public function getNilaiPpnDpAttribute()
    {
        return $this->nilai_total * ( $this->spk_detail->spk->dp_percent / 100)  * ( $this->ppn / 100);
    }

    public function surat_instruksi(){
       return $this->belongsTo('Modules\Spk\Entities\Suratinstruksi');
    }
   
}

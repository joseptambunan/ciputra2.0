<?php

namespace Modules\Spk\Entities;

use Illuminate\Database\Eloquent\Model;

class SuratInstruksiItem extends Model
{
    protected $fillable = [];

    public function pekerjaan(){
    	return $this->belongsTo("\Modules\Pekerjaan\Entities\Itempekerjaan","itempekerjaan_id");
    }
}

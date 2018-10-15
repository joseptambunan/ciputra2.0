<?php

namespace Modules\Spk\Entities;

use Illuminate\Database\Eloquent\Model;

class SuratInstruksiUnit extends Model
{
    protected $fillable = [];

    public function items(){
    	return $this->hasMany("Modules\Spk\Entities\SuratInstruksiItem");
    }

    public function spk_detail(){
    	return $this->belongsTo("Modules\Spk\Entities\SpkDetail","unit_id");
    }
}

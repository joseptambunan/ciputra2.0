<?php

namespace Modules\Pekerjaan\Entities;

use Illuminate\Database\Eloquent\Model;

class ItempekerjaanHarga extends Model
{
    protected $fillable = [];

    public function project(){
    	return $this->belongsTo("Modules\Project\Entities\Project");
    }

    public function details(){
    	return $this->hasMany("Modules\Pekerjaan\Entities\ItempekerjaanHargaDetail");
    }
}

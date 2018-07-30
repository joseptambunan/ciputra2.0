<?php

namespace Modules\Pt\Entities;

use Illuminate\Database\Eloquent\Model;

class PtMasterRekening extends Model
{
    protected $fillable = [];

    public function bank(){
    	return $this->belongsTo("Modules\Bank\Entities\Bank");
    }
}

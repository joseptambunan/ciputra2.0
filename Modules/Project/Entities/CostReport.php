<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class CostReport extends Model
{
    protected $fillable = [];

    public function kawasan(){
    	return $this->belongsTo("Modules\Project\Entities\ProjectKawasan","project_kawasan_id");
    }

    public function spk(){
    	return $this->belongsTo("Modules\Spk\Entities\Spk","spk_id");
    }

    public function itempekerjaan_name(){
    	return $this->belongsTo("Modules\Pekerjaan\Entities\Itempekerjaan","itempekerjaan");
    }
}

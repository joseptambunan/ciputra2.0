<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectPt extends Model
{
    protected $fillable = [];

    public function pt(){
    	return $this->belongsTo("Modules\Pt\Entities\Pt");
    }

    public function project(){
    	return $this->belongsTo("Modules\Project\Entities\Project");
    }
}

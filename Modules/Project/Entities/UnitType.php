<?php

namespace Modules\Project\Entities;

use App\CustomModel;

class UnitType extends CustomModel
{
	protected $fillable = ['name','description'];

    public function unit()
    {
        return $this->hasMany('Modules\Project\Entities\Unit');
    }

    public function templates(){
    	return $this->hasMany('Modules\Project\Entities\Templatepekerjaan');
    }
}

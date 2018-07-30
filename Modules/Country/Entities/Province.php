<?php

namespace Modules\Country\Entities;

use App\CustomModel;

class Province extends CustomModel
{
    protected $fillable = ['country_id','name','description'];

    public function country()
    {
        return $this->belongsTo('Modules\Country\Entities\Country', 'country_id');
    }
	
	public function cities()
    {
        return $this->hasMany('Modules\Country\Entities\City', 'province_id');
    }
}

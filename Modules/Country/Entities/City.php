<?php

namespace Modules\Country\Entities;

use App\CustomModel;

class City extends CustomModel
{
    protected $fillable = ['zipcode','province_id','name'];

    public function pts()
    {
        return $this->hasMany('Modules\Country\Entities\Pt');
    }

    public function province()
    {
        return $this->belongsTo('Modules\Country\Entities\Province');
    }

    public function country()
    {
        return $this->belongsTo('Modules\Country\Entities\Country');
    }
}

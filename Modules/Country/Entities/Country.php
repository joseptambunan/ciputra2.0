<?php

namespace Modules\Country\Entities;

use App\CustomModel;

class Country extends CustomModel
{
     public function provinces()
    {
        return $this->hasMany('Modules\Country\Entities\Province');
    }
}

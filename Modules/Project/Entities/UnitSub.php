<?php

namespace Modules\Project\Entities;

use App\CustomModel;

class UnitSub extends CustomModel
{
    public function unit()
    {
        return $this->belongsTo('Modules\Project\Entities\Unit');
    }

    public function warehouses()
    {
        return $this->morphMany('App\Warehouse', 'head');
    }
}

<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class Warehouse extends CustomModel
{

    protected $fillable = ['code','project_id','department_id','head_id','city_id','name','address','capacity_volume'];
    public function users()
    {
        return $this->belongsToMany('Modules\User\Entities\User', 'user_warehouse');
    }

    public function city()
    {
        return $this->belongsTo('Modules\Country\Entities\City');
    }

    public function head()
    {
        return $this->morphTo();
    }

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department');
    }

}

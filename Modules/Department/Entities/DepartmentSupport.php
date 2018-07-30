<?php

namespace Modules\Department\Entities;

use Illuminate\Database\Eloquent\Model;

class DepartmentSupport extends Model
{
    public function workorder()
    {
        return $this->belongsTo('App\Workorder');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function details()
    {
        return $this->hasMany('App\DepartmentSupportDetail');
    }
}

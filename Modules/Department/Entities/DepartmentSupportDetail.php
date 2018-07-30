<?php

namespace Modules\Department\Entities;

use Illuminate\Database\Eloquent\Model;

class DepartmentSupportDetail extends Model
{
    public function department_support()
    {
        return $this->belongsTo('App\DepartmentSupport');
    }

    public function workorder()
    {
        return $this->belongsTo('App\Workorder');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function pic()
    {
        return $this->belongsTo('App\User', 'pic_support');
    }
}

<?php

namespace Modules\User\Entities;

use App\CustomModel;

class Mappingperusahaan extends CustomModel
{
    protected $fillable = ['pt_id','department_id','division_id','description'];

    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt');
    }

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department');
    }

    public function division()
    {
        return $this->belongsTo('Modules\Division\Entities\Division');
    }
}

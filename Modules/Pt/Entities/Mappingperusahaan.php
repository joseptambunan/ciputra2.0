<?php

namespace Modules\Pt\Entities;

use Illuminate\Database\Eloquent\Model;

class Mappingperusahaan extends Model
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

     public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project');
    }
}

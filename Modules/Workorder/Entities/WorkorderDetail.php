<?php

namespace Modules\Workorder\Entities;

use App\CustomModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkorderDetail extends CustomModel
{
    public function workorder()
    {
        return $this->belongsTo('Modules\Workorder\Entities\Workorder');
    }

    public function peruntukan()
    {
        return $this->belongsTo('App\Peruntukan');
    }

    public function template_pekerjaans()
    {
        return $this->belongsTo('Modules\Project\Entities\Templatepekerjaan', 'templatepekerjaan_id');
    }

    public function blocks()
    {
        return $this->belongsTo('Modules\Project\Entities\Blok', 'blok_id');
    }

    public function peruntukans()
    {
        return $this->belongsTo('Modules\Project\Entities\Peruntukan', 'peruntukan_id');
    }

    public function asset()
    {
        return $this->morphTo();
    }

    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project', 'asset_id');
    }
    public function kawasan()
    {
        return $this->belongsTo('Modules\Project\Entities\ProjectKawasan', 'asset_id');
    }
    public function unit()
    {
        return $this->belongsTo('Modules\Project\Entities\Unit', 'asset_id');
    }
}

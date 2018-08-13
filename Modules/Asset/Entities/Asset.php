<?php

namespace Modules\Asset\Entities;

use App\CustomModel;

class Asset extends CustomModel
{
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project');
    }

    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt');
    }

    public function barangkeluar()
    {
        return $this->belongsTo('App\Barangkeluar');
    }

    public function details()
    {
        return $this->hasMany('Modules\Asset\Entities\AssetDetail');
    }

    
}

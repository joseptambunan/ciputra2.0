<?php

namespace App;

use App\CustomModel;

class ProjectType extends CustomModel
{
    public function project_type_group()
    {
        return $this->belongsTo('Modules\Project\Entities\ProjectTypeGroup');
    }
}

<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectPtUser extends Model
{
    protected $fillable = ['user_id','pt_id','project_id','description'];

    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project', 'project_id');
    }

    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt', 'pt_id');
    }

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'user_id');
    }

    public function project_pts(){
        return $this->belongsTo('Modules\Project\Entities\ProjectPt', 'project_pt');
    }
}

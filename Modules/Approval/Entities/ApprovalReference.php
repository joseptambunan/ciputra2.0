<?php

namespace  Modules\Approval\Entities;

use App\CustomModel;

class ApprovalReference extends CustomModel
{
    protected $fillable = [
    	'user_id',
        'project_id',
        'pt_id',
        'document_id',
        'document_type',
		'no_urut',
        'min_value',
        'max_value',
        'description',
        'is_action'
    ];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project');
    }
    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt');
    }

    public function document(){
        return $this->belongsTo("Modules\Document\Entities\DocumentType","document_type");
    }
}

<?php

namespace Modules\Approval\Entities;

use App\CustomModel;

class Approval extends CustomModel
{
	protected $fillable = [
		'approval_action_id',
		'document_id',
		'document_type',
		'total_nilai'
	];

    public function status()
    {
        return $this->belongsTo('Modules\Approval\Entities\ApprovalAction', 'approval_action_id');
    }

    public function histories()
    {
    	return $this->hasMany('Modules\Approval\Entities\ApprovalHistory', 'approval_id')->orderBy("no_urut","ASC");
    }

    public function document()
    {
        return $this->morphTo();
    }
}

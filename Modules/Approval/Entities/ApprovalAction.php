<?php

namespace Modules\Approval\Entities;

use App\CustomModel;

class ApprovalAction extends CustomModel
{
	protected $fillable = ['description'];

    public function approvals()
    {
        return $this->hasMany('Modules\Approval\Entities\Approval');
    }

    public function histories()
    {
        return $this->hasMany('Modules\Approval\Entities\ApprovalHistory');
    }
}

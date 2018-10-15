<?php

namespace App;

use App\CustomModel;

class Approval extends CustomModel
{
	/*protected $fillable = [
		'approval_action_id',
		'document_id',
		'document_type',
		'total_nilai'
	];*/

    public function status()
    {
        return $this->belongsTo('App\ApprovalAction', 'approval_action_id');
    }

    public function histories()
    {
    	return $this->hasMany('App\ApprovalHistory', 'approval_id');
    }

    public function document()
    {
        return $this->morphTo();
    }
}

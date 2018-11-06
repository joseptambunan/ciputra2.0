<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class BarangMasukHibah extends CustomModel
{
    //
    protected $fillable = ['from_project_id','from_pt_id','to_project_id','to_pt_id','no_refrensi','no','tanggal_hibah','status','description','pic_recipient_id'];

    public function details()
    {
    	return $this->hasMany('Modules\Inventory\Entities\BarangMasukHibahDetail');
    }

    public function from_project()
    {
    	return $this->belongsTo('Modules\Project\Entities\Project','from_project_id');
    }

    public function to_project()
    {
    	return $this->belongsTo('Modules\Project\Entities\Project','to_project_id');
    }

    public function from_pt()
    {
    	return $this->belongsTo('Modules\Pt\Entities\Pt','from_pt_id');
    }

    public function to_pt()
    {
    	return $this->belongsTo('Modules\Pt\Entities\Pt','to_pt_id');
    }

    public function user_recepient()
    {
        return $this->belongsTo('Modules\User\Entities\User','pic_recipient_id');
    }
}


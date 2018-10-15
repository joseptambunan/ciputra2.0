<?php 
namespace App\Traits;


trait Approval
{
    public function approval()
    {
        return $this->morphOne('Modules\Approval\Entities\Approval', 'document');
    }

    public function approval_histories()
    {
        return $this->morphMany('Modules\Approval\Entities\ApprovalHistory', 'document');
    }

    public function approval_references()
    {
        return $this->morphMany('Modules\Approval\Entities\ApprovalReference', 'document');
    }

    public function getStatusAttribute()
    {
        if ($this->approval()->count() == 0) 
        {
        	$class = get_class($this);

            \Document::make_approval( $class , $this->id);
        }

        return $this->approval->status;
    }

    public function scopeApproved()
    {
        return $this->whereHas('approval', function($q){
            $q->whereHas('status', function($r){
                $r->whereId(6);
            });
        });
    }
}
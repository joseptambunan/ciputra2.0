<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class TemplatepekerjaanLapangan extends Model
{
    use SoftDeletes;

    protected $dates = ['inactive_at'];

    public function createdBy()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'deleted_by');
    }

    public function inactiveBy()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'inactive_by');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            
            $model->created_by = \Auth::user()->id;
        });

        self::created(function($model){
            //
        });

        self::updating(function($model){
            
            $model->updated_by = \Auth::user()->id;
        });

        self::updated(function($model){
            //
        });

        self::deleting(function($model){
            
            $model->deleted_by = \Auth::user()->id;
        });

        self::deleted(function($model){
            // ... code here
        });
    }
}

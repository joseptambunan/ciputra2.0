<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitProgressDetail extends Model
{
	use SoftDeletes;

    protected $dates = ['inactive_at'];

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo('App\User', 'deleted_by');
    }

    public function inactiveBy()
    {
        return $this->belongsTo('App\User', 'inactive_by');
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

    public function pictures()
    {
        return $this->hasMany('Modules\Project\Entities\UnitProgressDetailPicture');
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Project\Entities\Unit');
    }

    public function unit_type()
    {
        return $this->belongsTo('Modules\Project\Entities\UnitType');
    }

    public function unit_progress(){
        return $this->belongsTo("Modules\Project\Entities\UnitProgress");
    }
}

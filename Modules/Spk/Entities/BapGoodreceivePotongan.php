<?php

namespace Modules\Spk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BapGoodreceivePotongan extends Model
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
}

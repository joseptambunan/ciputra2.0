<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomModel extends Model
{
    use softDeletes;

    protected $dates = ['inactive_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'inactive_at', 'inactive_by'];

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

        self::creating(function($model)
        {
            if ( \Auth::guest() ) 
            {
                $model->created_by = 1;

            }else{
                
                $model->created_by = \Auth::user()->id;
            }
        });

        self::created(function($model){
            //
        });

        self::updating(function($model){
            
            if ( \Auth::guest() ) 
            {
                $model->updated_by = 1;

            }else{
                
                $model->updated_by = \Auth::user()->id;
            }
        });

        self::updated(function($model){
            //
        });

        self::deleting(function($model){
            
            if ( \Auth::guest() ) 
            {
                $model->deleted_by = 1;
                $model->save();

            }else{
                
                $model->deleted_by = \Auth::user()->id;
                $model->save();
            }
        });

        self::deleted(function($model){
            // ... code here
        });
    }
}

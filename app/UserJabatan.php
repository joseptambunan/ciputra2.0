<?php

namespace App;

use App\CustomModel;

class UserJabatan extends CustomModel
{
    protected $fillable = ['code','name','description'];

    public function province()
    {
        return $this->belongsTo('App\Province');
    }

    public function user_details()
    {
        return $this->hasMany('App\UserDetail');
    }

    public function getUsersAttribute()
    {
        return \App\User::whereHas('details', function($q){
            $q->where('user_jabatan_id', $this->id );
        })->with('details')->get();
    }
}

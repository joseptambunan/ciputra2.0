<?php

namespace Modules\User\Entities;

use App\CustomModel;

class UserJabatan extends CustomModel
{
    protected $fillable = ['code','name','description'];

    public function province()
    {
        return $this->belongsTo('Modules\Country\Entities\Province');
    }

    public function user_details()
    {
        return $this->hasMany('Modules\User\Entities\UserDetail');
    }

    public function getUsersAttribute()
    {
        return \App\User::whereHas('details', function($q){
            $q->where('user_jabatan_id', $this->id );
        })->with('details')->get();
    }
}

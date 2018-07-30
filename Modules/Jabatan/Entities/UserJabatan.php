<?php

namespace Modules\Jabatan\Entities;

use Illuminate\Database\Eloquent\Model;

class UserJabatan extends Model
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

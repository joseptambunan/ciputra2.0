<?php

namespace Modules\Department\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [];

    public function coas()
    {
        return $this->belongsToMany('App\Coa');
    }

    public function budgets(){
    	return $this->hasMany("Modules\Budget\Entities\Budget");
    }
}

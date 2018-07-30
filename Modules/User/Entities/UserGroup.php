<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{

    protected $fillable = ['name','is_rekanan','description'];

    public function details()
    {
        return $this->hasMany('App\UserGroupDetail');
    }

    public function privileges()
    {
        return $this->hasMany('App\GroupPrivilege');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Menu', 'group_privileges', 'user_group_id', 'menu_id');
    }
}

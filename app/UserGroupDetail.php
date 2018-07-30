<?php

namespace App;

use App\CustomModel;

class UserGroupDetail extends CustomModel
{
    public function group()
    {
        return $this->belongsTo('App\UserGroup', 'user_group_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

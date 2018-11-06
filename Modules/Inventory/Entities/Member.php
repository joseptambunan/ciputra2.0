<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class Member extends CustomModel
{
    //
    protected $fillable = ['member_name','description'];
}

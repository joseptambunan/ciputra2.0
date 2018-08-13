<?php

namespace Modules\Spk\Entities;

use App\CustomModel;

class SpkPoPic extends CustomModel
{
    protected $fillable = ['head_id','head_type','user_id'];

    public function head()
    {
        return $this->morphTo();
    }
}

<?php

namespace Modules\Library\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Spk\Entities\Spk;
use Modules\Spk\Entities\SpkDetail;
use Modules\Spk\Entities\SpkvoUnit;
use Modules\Pekerjaan\Entities\Itempekerjaan;

class Library extends Model
{
    protected $fillable = [];

    public function item(){
        return "a";
        
    }

    
}

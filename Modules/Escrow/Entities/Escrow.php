<?php

namespace Modules\Escrow\Entities;

use Illuminate\Database\Eloquent\Model;

class Escrow extends Model
{
    protected $fillable = [];

    public function itempekerjaans(){
    	return $this->hasMany("Modules\Pekerjaan\Entities\Itempekerjaan");
    }
}

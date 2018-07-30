<?php

namespace Modules\Pekerjaan\Entities;

use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    protected $fillable = ['subholding','parent_id','code','description'];

	public function itempekerjaans()
    {
        return $this->belongsToMany('App\Itempekerjaan', 'itempekerjaan_coas', 'coa_id', 'itempekerjaan_id');
    }
}

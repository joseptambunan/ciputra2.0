<?php

namespace Modules\Pt\Entities;

use App\CustomModel;

class Pt extends CustomModel
{
    protected $fillable = ['city_id','code','name','address','npwp','phone','rekening','description'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'project_pt_users');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank', 'bank_id');
    }

    public function supp()
    {
        return $this->belongsTo('App\RekananSupp', 'id');
    }

    public function mapping(){
        return $this->hasMany("\App\Mappingperusahaan");
    }

    public function rekenings(){
        return $this->hasMany("Modules\Pt\Entities\PtMasterRekening");
    }
}

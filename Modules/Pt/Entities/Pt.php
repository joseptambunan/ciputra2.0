<?php

namespace Modules\Pt\Entities;

use App\CustomModel;

class Pt extends CustomModel
{
    protected $fillable = ['city_id','code','name','address','npwp','phone','rekening','description'];

    public function users()
    {
        return $this->belongsToMany('Modules\User\Entities\User', 'project_pt_users');
    }

    public function city()
    {
        return $this->belongsTo('Modules\City\Entities\City');
    }

    public function bank()
    {
        return $this->belongsTo('Modules\Bank\Entities\Bank', 'bank_id');
    }

    public function supp()
    {
        return $this->belongsTo('App\RekananSupp', 'id');
    }

    public function mapping(){
        return $this->hasMany("\Modules\Pt\Entities\Mappingperusahaan");
    }

    public function rekenings(){
        return $this->hasMany("Modules\Pt\Entities\PtMasterRekening");
    }

    public function project_pt_users(){
         return $this->hasMany("Modules\Project\Entities\ProjectPtUser");
    }
}

<?php

namespace App;

use App\CustomModel;

class UserDetail extends CustomModel
{
    protected $fillable = ['user_jabatan_id','user_id','mappingperusahaan_id','user_level','can_approve','description'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\UserJabatan','user_jabatan_id');
    }

    public function mappingperusahaan()
    {
        return $this->belongsTo('Modules\Pt\Entities\Mappingperusahaan');
    }

    public function projectpt(){
        return $this->belongsTo("Modules\Project\Entities\ProjectPt");
    }
}

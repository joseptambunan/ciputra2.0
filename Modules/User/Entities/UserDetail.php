<?php

namespace Modules\User\Entities;

use App\CustomModel;

class UserDetail extends CustomModel
{
    protected $fillable = ['user_jabatan_id','user_id','mappingperusahaan_id','user_level','can_approve','description'];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    public function jabatan()
    {
        return $this->belongsTo('Modules\User\Entities\UserJabatan','user_jabatan_id');
    }

    public function mappingperusahaan()
    {
        return $this->belongsTo('Modules\User\Entities\Mappingperusahaan');
    }

     public function projectpt(){
        return $this->belongsTo("Modules\Project\Entities\ProjectPt");
    }
}

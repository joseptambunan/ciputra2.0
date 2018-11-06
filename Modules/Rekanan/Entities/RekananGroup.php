<?php

namespace Modules\Rekanan\Entities;

use App\CustomModel;

class RekananGroup extends CustomModel
{
    protected $fillable = ['npwp_kota','code','name','pph_percent','npwp_no','npwp_image','npwp_alamat','description'];

    public function rekanans()
    {
        return $this->hasMany('Modules\Rekanan\Entities\Rekanan');
    }

    public function spks(){
    	return $this->hasMany("Modules\Spk\Entities\Spk","rekanan_id");
    }

    public function spesifikasi(){
    	return $this->hasMany("Modules\Rekanan\Entities\RekananSpecification");
    }

    public function user_rekanan(){
    	return $this->hasOne("Modules\Rekanan\Entities\UserRekanan");
    }

   
}

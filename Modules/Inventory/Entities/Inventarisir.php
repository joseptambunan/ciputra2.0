<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class Inventarisir extends CustomModel
{
    //
    protected $dates = ['date'];
    protected $fillable = ['barangkeluar_id','id_pic_giver','id_pic_recipient','no','date'];
    
    public function details()
    {
        return $this->hasMany('Modules\Inventory\Entities\InventarisirDetail');
    }


    public function barangkeluar()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Barangkeluar');
    }

    public function user_giver()
    {
        return $this->belongsTo('Modules\User\Entities\User','id_pic_giver');
    }

    public function user_recipient()
    {
        return $this->belongsTo('Modules\User\Entities\User','id_pic_recipient');
    }
}

<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class MutasiIn extends CustomModel
{
    //
    protected $table ='mutasi_ins';

    protected $fillable = ['no',
    'id_pic_recipient',
    'pic_recipient',
    'id_pic_giver',
    'name_pic_giver',
    'id_source',
    'item_id',
    'qty',
    'item_satuan_id',
    'item_tidak_terdefinisi',
    'satuan_item_tidak_terdefinisi',
    'source',
    'id_destination',
    'destination',
    'confirm_by_warehouseman',
    'confirm_by_hod',
    'status',
    'is_from_employee',
    'is_from_project',
    'is_from_rekanan',
    'is_from_other'
];

    public function item()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Item','item_id');
    }

    public function user_giver()
    {
        return $this->belongsTo('Modules\User\Entities\User','id_pic_giver');
    }

    public function user_recipient()
    {
        return $this->belongsTo('Modules\User\Entities\User','id_pic_recipient');
    }

    public function source_rekanan()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\Rekanan','id_source');
    }

    public function source_other()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Member','id_source');
    }

    public function source_project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project','id_source');
    }

    public function details()
    {
        return $this->hasMany('Modules\Inventory\Entities\MutasiInDetail');
    }

    public function satuan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
    }

    public function assets_morphic()
    {
        return $this->morphMany('Modules\Inventory\Entities\Asset','assetable','sumber_type','sumber_id');
    }
}

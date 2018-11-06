<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class Rotasi extends CustomModel
{
    //
    protected $table='rotasis';

    protected $fillable = [
        'asset_id',
        'item_id',
        'barcode',
        'id_pic_giver',
        'pic_giver',
        'pic_recipient',
        'from_department_id',
        'from_location_id',
        'to_department_id',
        'to_location_id',
        'from_room',
        'to_room',
        'image1',
        'image2',
        'image3',
        'confirm_by_warehouseman',
        'confirm_by_hod',
        'status',
        'description'
    ];

    public function department_from()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Department','from_department_id');
    }

    public function department_to()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Department','to_department_id');
    }

    public function location_from()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Location','from_location_id');
    }

    public function location_to()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Location','to_location_id','id');
    }

    public function item()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Item','item_id');
    }

    public function asset()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Asset','asset_id');
    }

    public function room_from()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Room','from_room_id');
    }

    public function room_to()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Room','to_room_id');
    }
}

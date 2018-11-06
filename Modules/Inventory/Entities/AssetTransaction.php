<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class AssetTransaction extends CustomModel
{
    protected $fillable = [
        'asset_id',
        'from_user_id',
        'from_department_id',
        'from_unit_sub_id',
        'from_location_id',
        'from_room_id',
        'to_user_id',
        'to_department_id',
        'to_unit_sub_id',
        'to_location_id',
        'to_room_id',
        'status',
        'description',
        'received_at'
    ];

    public function asset()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Asset');
    }

    public function department_from()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Department','from_department_id');
    }

    public function department_to()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Department','to_department_id');
    }

    public function user_from()
    {
        return $this->belongsTo('Modules\User\Entities\User','from_user_id');
    }

    public function room_from()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Room','from_room_id');
    }

    public function user_to()
    {
        return $this->belongsTo('Modules\User\Entities\User','to_user_id');
    }

    public function unitsub_from()
    {
        return $this->belongsTo('Modules\Inventory\Entities\UnitSub','from_unit_sub_id');
    }

    public function unitsub_to()
    {
        return $this->belongsTo('Modules\Inventory\Entities\UnitSub','to_unit_sub_id');
    }

    public function location_from()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Location','from_location_id');
    }

    public function location_to()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Location','to_location_id');
    }

    public function room_to()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Room','to_room_id');
    }

    public function asset_transaction_images()
    {
        return $this->hasMany('Modules\Inventory\Entities\AssetTransactionImage');
    }
}

<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class AssetTransactionDetail extends CustomModel
{
	protected $dates = ['received_at'];
	
    public function asset_detail_item()
    {
        return $this->belongsTo('Modules\Inventory\Entities\AssetDetailItem');
    }

    public function asset_transaction()
    {
        return $this->belongsTo('Modules\Inventory\Entities\AssetTransaction');
    }

    public function from_user()
    {
        return $this->belongsTo('Modules\Inventory\Entities\User', 'from_user_id');
    }

    public function from_department()
    {
        return $this->belongsTo('App\Department', 'from_department_id');
    }

    public function from_unit_sub()
    {
        return $this->belongsTo('Modules\Inventory\Entities\UnitSub', 'from_unit_sub_id');
    }

    public function from_location()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Location', 'from_location_id');
    }

    public function to_user()
    {
        return $this->belongsTo('Modules\Inventory\Entities\User', 'to_user_id');
    }

    public function to_department()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Department', 'to_department_id');
    }

    public function to_unit_sub()
    {
        return $this->belongsTo('Modules\Inventory\Entities\UnitSub', 'to_unit_sub_id');
    }

    public function to_location()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Location', 'to_location_id');
    }

    public function images()
    {
        return $this->hasMany('Modules\Inventory\Entities\AssetTransactionDetailImage');
    }
}

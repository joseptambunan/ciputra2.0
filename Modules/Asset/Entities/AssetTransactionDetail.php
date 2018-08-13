<?php

namespace App;

use App\CustomModel;

class AssetTransactionDetail extends CustomModel
{
	protected $dates = ['received_at'];
	
    public function asset_detail_item()
    {
        return $this->belongsTo('Modules\Asset\Entities\AssetDetailItem');
    }

    public function asset_transaction()
    {
        return $this->belongsTo('Modules\Asset\Entities\AssetTransaction');
    }

    public function from_user()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }

    public function from_department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department', 'from_department_id');
    }

    public function from_unit_sub()
    {
        return $this->belongsTo('App\UnitSub', 'from_unit_sub_id');
    }

    public function from_location()
    {
        return $this->belongsTo('App\Location', 'from_location_id');
    }

    public function to_user()
    {
        return $this->belongsTo('App\User', 'to_user_id');
    }

    public function to_department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department', 'to_department_id');
    }

    public function to_unit_sub()
    {
        return $this->belongsTo('App\UnitSub', 'to_unit_sub_id');
    }

    public function to_location()
    {
        return $this->belongsTo('App\Location', 'to_location_id');
    }

    public function images()
    {
        return $this->hasMany('Modules\Asset\Entities\AssetTransactionDetailImage');
    }
}

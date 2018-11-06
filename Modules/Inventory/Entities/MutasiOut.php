<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class MutasiOut extends CustomModel
{
    //
    protected $table ='mutasi_outs';

    protected $fillable = [
        'department_id',
        'no',
        'pic_recipient',
        'id_pic_recipient',
        'id_pic_giver',
        'name_pic_giver',
        'item_id',
        'item_satuan_id',
        'asset_id',
        'barcode',
        'source',
        'id_destination',
        'destination',
        'image1',
        'image2',
        'image3',
        'confirm_by_warehouseman',
        'is_inventory',
        'confirm_by_hod',
        'description'];

    public function item()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Item','item_id');
    }

    public function asset()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Asset','asset_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Warehouse','id_destination');
    }

    public function inventory()
    {
        return $this->morphOne('Modules\Inventory\Entities\Inventory', 'sumber','sumber_type','sumber_id');
    }
}

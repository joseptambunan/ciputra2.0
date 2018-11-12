<?php

namespace Modules\Satuan\ItemSatuan;

use App\CustomModel;

class Item extends CustomModel
{
    protected $fillable = ['name','item_category_id','default_warehouse_id','stock_min','is_inventory','is_consumable','description'];

}

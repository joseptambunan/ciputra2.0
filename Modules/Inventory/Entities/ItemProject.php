<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemProject extends Model
{
    protected $fillable = ['item_id','project_id','default_warehouse_id','stock_min','is_inventory','is_consumable','description'];

    public function item()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\Item');
    }

    public function project()
    {
    	return $this->belongsTo('Modules\Project\Entities\Project');
    }
}

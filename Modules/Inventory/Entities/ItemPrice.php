<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class ItemPrice extends CustomModel
{
    public function item()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Item', 'item_id');
    }

    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project', 'project_id');
    }

    public function satuan()
    {
    	return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id');
    }
}

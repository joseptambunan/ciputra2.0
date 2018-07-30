<?php

namespace Modules\Pekerjaan\Entities;

use Illuminate\Database\Eloquent\Model;

class ItempekerjaanDetail extends Model
{
    public function itempekerjaan()
    {
        return $this->belongsTo('App\Itempekerjaan');
    }

    public function item_satuan()
    {
        return $this->belongsTo('App\ItemSatuan', 'satuan');
    }
}

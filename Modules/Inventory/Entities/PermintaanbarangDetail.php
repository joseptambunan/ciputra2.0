<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;

class PermintaanbarangDetail extends CustomModel
{
	protected $dates = ['butuh_date'];
    protected $fillable = ['permintaanbarang_id','item_id','item_satuan_id','is_inventarisasi','quantity','butuh_date','description'];

    public function item()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Item','item_id','id');
    }

    public function satuan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id','id');
    }

    public function permintaanbarang()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Permintaanbarang');
    }

    public function barangkeluar_detail()
    {
        return $this->hasMany('Modules\Inventory\Entities\BarangkeluarDetail');
    }

    public function StatusPermintaan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\StatusPermintaan','is_inventarisasi');
    }

    
}

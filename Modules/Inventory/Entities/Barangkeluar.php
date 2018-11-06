<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;
use App\Traits\Approval;
class Barangkeluar extends CustomModel
{
    use Approval;
    
	protected $fillable =['permintaanbarang_id'
							,'confirmed_by_warehouseman'
							,'confirmed_by_requester'
							,'date'
							,'no'
							,'description'];	

    public function permintaanbarang()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Permintaanbarang');
    }

    public function barangkeluardetails()
    {
    	return $this->hasMany('Modules\Inventory\Entities\BarangkeluarDetail');
    }

    public function inventarisirs()
    {
        return $this->hasMany('Modules\Inventory\Entities\Inventarisir');
    }

}

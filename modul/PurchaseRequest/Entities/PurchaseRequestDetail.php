<?php

namespace Modules\PurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;

class PurchaseRequestDetail extends CustomModel
{
    public $table = "purchaserequest_details";
    protected $fillable = ['id','purchaserequest_id','itempekerjaan_id','item_id','item_satuan_id','brand_id','recomended_supplier','quantity','description','rec_1','rec_2','rec_3','delivery_date'];

    public function pr()
    {
        return $this->belongsTo('Modules\PurchaseRequest\Entities\PurchaseRequest', 'purchaserequest_id');
    }

    public function item_project()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemProject','item_id','id');
    }

    public function item_satuan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemSatuan','item_satuan_id','id');
    }

    public function brand()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Brand');
    }

    public function rec1()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\Rekanan','rec_1','id');
    }

    public function rec2()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\Rekanan','rec_2','id');
    }

    public function rec3()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\Rekanan','rec_3','id');
    }

    public function item_pekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan','itempekerjaan_id','id');
    }
    public function getNilaiAttribute()
    {
        return 0;
    }

    public function approval()
    {
        return $this->morphMany('Modules\Approval\Entities\Approval','document','document_type','document_id');
    }

    public function permintaanbarang_detail()
    {
        return $this->hasMany('Modules\Inventory\Entities\PermintaanbarangDetail');
    }

    public function spk()
    {
        return $this->belongsTo('App\Spk','spk_id','id');
    }
}

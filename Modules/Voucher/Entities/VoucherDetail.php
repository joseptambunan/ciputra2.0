<?php 

namespace Modules\Voucher\Entities;

use App\CustomModel;

class VoucherDetail extends CustomModel
{
    protected $fillable = ['voucher_id','coa_id','head_id','head_type','nilai','type','mata_uang','kurs'];

    public function voucher()
    {
        return $this->belongsTo('Modules\Voucher\Entities\Voucher');
    }

    public function coa()
    {
        return $this->belongsTo('Modules\Coa\Entities\Coa');
    }

    public function head()
    {
        return $this->morphTo();
    }

    public function price()
    {
        return $this->belongsTo('App\ItemPrice', 'mata_uang');
    }

    public function bap_detail()
    {
        return $this->hasOne('Modules\Bap\Entities\BapDetail', 'id');
    }
}

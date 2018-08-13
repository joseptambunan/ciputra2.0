<?php

namespace  Modules\Spk\Entities;

use App\CustomModel;

class PiutangPembayaran extends CustomModel
{
    protected $fillable = ['piutang_id','sumber_id','sumber_type','nilai','cara_pembayaran','date','description'];
    protected $dates = ['date'];

    public function piutang()
    {
        return $this->belongsTo(' Modules\Spk\Entities\Piutang');
    }

    public function sumber()
    {
        // Bap atau Goodreceive
        return $this->morphTo();
    }
}

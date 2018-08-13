<?php

namespace  Modules\Spk\Entities;

use App\CustomModel;
use App\Traits\Approval;

class Piutang extends CustomModel
{
    use Approval;

    protected $fillable = ['rekanan_id','approved_by','project_id','pt_id','no','date','nilai','approved_at','description'];
    protected $dates = ['date','approved_at'];

    public function rekanan()
    {
        return $this->belongsTo(' Modules\Rekanan\Entities\Rekanan');
    }
    public function approver()
    {
        return $this->belongsTo('App\User','approved_by');
    }
    public function pt()
    {
        return $this->belongsTo('App\Pt');
    }
    public function project()
    {
        return $this->belongsTo(' Modules\Project\Entities\Project');
    }

    public function pembayarans()
    {
        return $this->hasMany(' Modules\Spk\Entities\PiutangPembayaran');
    }

    public function getTerbayarAttribute()
    {
        return $terbayar = $this->pembayarans->sum('nilai');
    }
    public function getSisaAttribute()
    {
        $sisa = $this->nilai - $this->terbayar;

        return $sisa;
    }
}

<?php

namespace Modules\Voucher\Entities;

use App\CustomModel;
use App\Traits\Approval;

class Voucher extends CustomModel
{
    use Approval;

    protected $fillable = ['rekanan_id','department_id','pt_id','no','no_faktur','pencairan_date','is_out','export_count','posting','description','date','tempo_date', 'penyerahan_date','head_id','head_type'];
	protected $dates = ['pencairan_date','date','tempo_date', 'penyerahan_date'];

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department');
    }

    public function rekanan()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\Rekanan');
    }

    
    public function rekening()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\RekananRekening', 'rekanan_rekening_id');
    }

    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt');
    }

    public function details()
    {
        return $this->hasMany('Modules\Voucher\Entities\VoucherDetail');
    }

    public function bap()
    {
        return $this->hasOne('Modules\Spk\Entities\Bap', 'id', 'head_id');
    }

    public function getSpkAttribute()
    {
        return $this->bap->spk;
    }

    public function document()
    {
        return $this->morphTo();
    }

    public function head()
    {
        return $this->morphTo();
    }

    public function getVoucherSebelumnyaAttribute()
    {
        $bap_sebelumnya = $this->bap->spk->baps()->where('termin', $this->bap->termin -1 )->first();

        if ($bap_sebelumnya) 
        {
            return $bap_sebelumnya->vouchers->first();
        }else{
            return NULL;
        }
    }

    public function getNilaiDppAttribute()
    {
        return $this->details()->where('type','dpp')->first()->nilai;
    }

    public function getNilaiDppKumulatifAttribute()
    {
        $sekarang = $this->nilai_dpp;

        $sebelumnya = ($this->voucher_sebelumnya ? $this->voucher_sebelumnya->nilai_dpp_kumulatif : 0);

        return $sekarang + $sebelumnya;
    }

    public function getNilaiAttribute()
    {
        $nilai = 0;
        foreach ($this->details as $key => $value) {
            $nilai = $nilai + $value->nilai;
        }
        return $nilai;
    }

    public function project(){
        return $this->belongsTo("Modules\Project\Entities\Project");
    }
}

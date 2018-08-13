<?php

namespace Modules\Spk\Entities;

use App\CustomModel;

class BapDetail extends CustomModel
{
    protected $fillable = ['bap_id','asset_id','asset_type'];

    public function bap()
    {
        return $this->belongsTo('Modules\Spk\Entities\Bap');
    }

    public function asset()
    {
        return $this->morphTo();
    }

    public function voucher_detail()
    {
        return $this->morphMany('Modules\Spk\Entities\VoucherDetail', 'head');
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Project\Entities\Unit', 'asset_id');
    }

    public function kawasan()
    {
        return $this->belongsTo('Modules\Project\Entities\ProjectKawasan', 'asset_id');
    }

    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project', 'asset_id');
    }

    public function itempekerjaans()
    {
        return $this->hasMany('Modules\Bap\Entities\BapDetailItempekerjaan');
    }

    public function getTerbayarPercentAttribute()
    {
        $percent = 0;

        if ($this->itempekerjaans()->count() == 0) 
        {
            return $percent;
        }else{

            $itempekerjaans = $this->itempekerjaans->load('spkvo_unit');

            $nilai_seluruh_item = 0;

            foreach ($itempekerjaans as $key => $item) 
            {
                $nilai_seluruh_item = $nilai_seluruh_item + ($item->spkvo_unit->nilai * $item->spkvo_unit->volume);
            }
        }

        foreach ($itempekerjaans as $key => $item) 
        {
            $percent = $percent + ($item->terbayar_percent * ($item->spkvo_unit->nilai * $item->spkvo_unit->volume) / $nilai_seluruh_item);
        }

        return $percent;
    }

    public function getLapanganPercentAttribute()
    {
        $percent = 0;
        $total = 0;

        foreach ($this->itempekerjaans as $key => $each) 
        {
            $percent    = $percent + $each->lapangan_percent * $each->spkvo_unit->nilai * $each->spkvo_unit->volume;
            $total      = $total + $each->spkvo_unit->nilai * $each->spkvo_unit->volume;
        }

        return $percent / $total;
    }

    public function getDetailSebelumnyaAttribute()
    {
        $bap_sebelumnya = $this->bap->bap_sebelumnya;

        if ($bap_sebelumnya) 
        {
            return $detail_sebelumnya = $bap_sebelumnya->details()->where('asset_id', $this->asset_id)->where('asset_type', $this->asset_type)->first();
        }else{
            return null;
        }
    }

    public function getNilaiAttribute()
    {
        $nilai = 
        [
            'dpp' => 0,
            'retensi' => 0,
            'dp' => 0,
            'pengembalian' => 0,
            'dpp_sebelumnya' => 0,
            'ppn' => 0,
            'pph' => 0,
            'potongan' => 0
        ];

        foreach ($this->itempekerjaans as $key => $each) 
        {
            // $nilai['dpp'] = $nilai['dpp'] + $each->terbayar_percent * $each->spkvo_unit->nilai * $each->spkvo_unit->volume;
            // //$nilai['ppn'] = $nilai['ppn'] + $each->terbayar_percent * $each->spkvo_unit->nilai * $each->spkvo_unit->volume * $each->spkvo_unit->ppn;
            // $nilai['retensi'] = array_sum($this->bap->nilai_retensis) / $this->bap->details()->count();
            // $nilai['ppn'] = ($nilai['dpp'] - $nilai['retensi']) * 0.1;
            
            //$item_sebelumnya = $this->detail_sebelumnya->itempekerjaans()->where('spkvo_unit_id', $each->spkvo_unit_id)->first();
            
            $bap_sebelumnya = $this->bap->spk->baps()->where('termin', $this->bap->termin -1 )->first();

            if ($bap_sebelumnya) 
            {
                $voucher_sebelumnya = $bap_sebelumnya->vouchers()->first();
            }else{
                $voucher_sebelumnya = null;
            }

            $dpp                    =  $each->terbayar_percent * $each->spkvo_unit->nilai_total;
            $retensi                =  $dpp * array_sum($this->bap->percentage_retensis);

            $dpp_sebelumnya         =  ($voucher_sebelumnya? $voucher_sebelumnya->details()->where('type','dpp')->first()->nilai : 0);

            $dp                     =  $each->spkvo_unit->nilai_dp;
            $pengembalian           =  $this->bap->pengembalianDpPercent( $this->bap->termin ) * $dp;

            $nilai['pengembalian']       += $pengembalian;
            $nilai['dpp_sebelumnya'] += $dpp_sebelumnya;
            
            $nilai['retensi']       += $retensi;
            $nilai['dpp']           += $dpp - $retensi + $dp - $pengembalian - $dpp_sebelumnya;
            $nilai['dp']            += $dp;

            $nilai['ppn']           += $nilai['dpp'] * $each->spkvo_unit->ppn;
            $nilai['pph']           += ($dpp - $retensi) * $this->bap->pph_percent;
            $nilai['potongan']      += $this->bap->nilai_potongan / $this->bap->details()->count();
        }

        return $nilai;
    }

    public function voucher_details()
    {
        return $this->hasMany('Modules\Voucher\Entities\VoucherDetail', 'head_id');
    }

  
}

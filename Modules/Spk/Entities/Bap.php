<?php

namespace Modules\Spk\Entities;

use App\CustomModel;
use App\Traits\Approval;

class Bap extends CustomModel
{
    use Approval;

    protected $fillable = ['spk_id','date','no','termin','nilai_administrasi','nilai_denda','nilai_selisih'];
    protected $dates = ['date'];

    public $termin_terpilih;

    public function spk()
    {
        return $this->belongsTo('Modules\Spk\Entities\Spk');
    }

    public function getProjectAttribute()
    {
        return $this->spk->project;
    }
    public function scopeFilterProject()
    {
        return $this->whereHas('spk', function($q){
            $q->where('project_id', session('project'));
        });
    }

    public function spk_retensi()
    {
        return $this->hasOne('Modules\Spk\Entities\SpkRetensi');
    }

    public function vouchers()
    {
        return $this->morphMany('Modules\Voucher\Entities\Voucher', 'head');
    }

    public function piutang_pembayarans()
    {
        return $this->morphMany('Modules\Spk\Entities\PiutangPembayaran', 'sumber');
    }

    public function details()
    {
        return $this->hasMany('Modules\Spk\Entities\BapDetail');
    }

    public function pphs()
    {
        return $this->hasMany('Modules\Spk\Entities\BapPph');
    }

    public function detail_itempekerjaans()
    {
        return $this->hasManyThrough('Modules\Spk\Entities\BapDetailItempekerjaan', 'Modules\Spk\Entities\BapDetail');
    }

    public function getRekananAttribute()
    {
        return $this->spk->tender_rekanan->rekanan;
    }
    public function getDepartmentAttribute()
    {
        return $this->spk->tender->rab->workorder->budget_tahunan->budget->department;
    }
    public function getPtAttribute()
    {
        return $this->spk->tender->rab->workorder->budget_tahunan->budget->pt;
    }
   public function getPercentageKumulatifAttribute()
    {
        $total = array();
        $bobot = array();

        foreach ($this->detail_itempekerjaans as $key => $each) 
        {
            if ( $each->spkvo_unit ){
            $total[$key] = ($each->terbayar_percent / 100) * ( $each->spkvo_unit->nilai * $each->spkvo_unit->volume );
            $bobot[$key] = $each->spkvo_unit->nilai * $each->spkvo_unit->volume;
            }
        }

        if (array_sum($bobot) == null) 
        {
            return 0;
        }

        $percentage_sekarang = array_sum($total) / array_sum($bobot);

        if ($percentage_sekarang > 1) 
        {
            $percentage_sekarang = 1;
        }

        return $percentage_sekarang;
    }

    public function getPercentageSebelumnyaAttribute()
    {
        $bap_sebelumnya = $this->spk->baps()->orderBy('id','DESC')->where('id','<',$this->id)->first();

        if ($bap_sebelumnya == null) 
        {
            return 0;
        }else{
            return $bap_sebelumnya->percentage_kumulatif;
        }
    }

    public function getPercentageSekarangAttribute()
    {
        return number_format(($this->percentage_kumulatif - $this->percentage_sebelumnya), 4);
    }

    public function getPercentageRetensisAttribute()
    {
        $retensis = array();

        foreach ($this->spk->retensis as $key => $retensi) 
        {
            if ($retensi->is_progress) 
            {
                $retensis[$key] = $retensi->percent;

            }else{
                if ($this->percentage_kumulatif >= 1) 
                {
                    # termin terakhir
                    
                    $retensis[$key] = $retensi->percent * $this->termin;
                }else{
                    $retensis[$key] = 0;
                }
            }
            
        }

        return $retensis;
    }

    public function getNilaiRetensisAttribute()
    {
        if($this->percentage_sebelumnya >= 1)
        {
            return [0];
        }

        $retensis = array();

        foreach ($this->percentage_retensis as $key => $percent) 
        {
            $retensis[$key] = $percent * $this->nilai_kumulatif;
        }

        return $retensis;
    }


    public function getNilaiBapTerminAttribute()
    {
        return $this->nilai_sertifikat + $this->nilai_ppn;
    }

    public function getNilaiNonRetensiAttribute()
    {
        return $this->nilai_sekarang;
    }

    public function getNilaiAttribute()
    {
        //return $this->nilai_sertifikat ;
        return $this->nilai_sertifikat + $this->nilai_ppn - $this->nilai_pph - $this->nilai_piutang_pembayaran - $this->nilai_sebelumnya - $this->nilai_denda - $this->nilai_administrasi - $this->nilai_selisih;
    }

    public function getSisaKontrakAttribute()
    {
        return ($this->spk->nilai + $this->spk->nilai_ppn) - $this->nilai_bap_termin;
    }

    public function getNilaiPiutangPembayaranAttribute()
    {
        return $this->piutang_pembayarans()->sum('nilai');
    }

    public function getNilaiPphAttribute()
    {
        $nilai = 0;

        foreach ($this->pphs as $key => $pph) 
        {
            $nilai = $nilai + $pph->percent * ($this->nilai_sertifikat - ($this->bap_sebelumnya ? $this->bap_sebelumnya->nilai_sertifikat : 0));
        }

        return $nilai;
    }

    public function getNilaiPpnAttribute()
    {
        if ($this->detail_itempekerjaans->count() == 0) {
            return 0;
        }

        $itempekerjaans = $this->detail_itempekerjaans;

        if ($this->percentage_kumulatif >= 1) 
        {
            $percent_retensi = $this->spk->retensis()->sum('percent');
        }else{
            $percent_retensi = $this->spk->retensis()->where('is_progress', TRUE)->sum('percent');
        }

        $total = array();

        foreach ($itempekerjaans as $key => $each) 
        {
     
                $nilai_terbayar = $each->spkvo_unit->volume * $each->spkvo_unit->nilai * ( $each->terbayar_percent / 100 );

                // termin retensi tidak ada retensi
                
                if ($this->percentage_sebelumnya >= 1) 
                {
                    $nilai_setelah_retensi = $nilai_terbayar;
                }else{
                    $nilai_setelah_retensi = $nilai_terbayar * (1 - $percent_retensi);
                }

                $total[$key] = $nilai_setelah_retensi * $each->spkvo_unit->ppn ;
            
        }

        return array_sum($total);
    }

    public function getNilaiSekarangAttribute()
    {
        return $this->nilai_bap_termin - $this->nilai_sebelumnya;
    }

    public function getBapSebelumnyaAttribute()
    {
        return $this->spk->baps()->orderBy('id','DESC')->where('id','<',$this->id)->first();
    }

    public function getNilaiSebelumnyaAttribute()
    {
        /*if ($this->bap_sebelumnya == null) 
        {
            return 0;
        }else{
            return $this->bap_sebelumnya->nilai_kumulatif;
        }*/
        if ( isset( $this->spk->baps()->orderBy('id','DESC')->where('id','<',$this->id)->first()->nilai_bap_3 )){
            return $this->spk->baps()->orderBy('id','DESC')->where('id','<',$this->id)->first()->nilai_bap_3;
        }else{
            return 0 ;
        }
    }

    public function getNilaiKumulatifAttribute()
    {
        return $this->percentage_kumulatif * $this->spk->nilai;
    }

    public function getNilaiSertifikatAttribute()
    {
        if ( $this->nilai_sebelumnya == "0"){
            return 0;
        }else{
            return $this->nilai_kumulatif - array_sum($this->nilai_retensis);
        }
    }
    
    public function getNilaiPengembalianAttribute(){
        $nilai = 0;
        $total_termun = 0;
        $total_progress = $this->detail_itempekerjaans->sum('lapangan_percent') * 100 ;
        
        foreach ($this->spk->termyn as $key => $value) {
            $total_termun = $total_termun + $value->progress;
            if ( $total_termun > $total_progress){
               $start = $key - 1;
               foreach ( $this->spk->dp_pengembalians as $key2 => $value2 ){
                
                    if ( $key2 < $start ){
                        $nilai = $nilai + $value2->percent;                        
                    }
               }
               return $nilai / 100 * ( ($this->spk->dp_percent / 100 ) * $this->spk->nilai) ;
            }
        }
        
    }

    public function getTotalNilaiSebelumnyaAttribute(){
        
    }

    public function user(){
        return $this->belongsTo("Modules\User\Entities\User","created_by");
    }
}
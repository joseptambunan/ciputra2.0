<?php

namespace Modules\Spk\Entities;

use App\CustomModel;
use App\Traits\Approval;

class Spk extends CustomModel
{
    use Approval;

    protected $fillable = [
        'project_id',
        'rekanan_id',
        'tender_rekanan_id',
        'spk_type_id',
        'spk_parent_id',
        'no',
        'date',
        'name',
        'start_date',
        'finish_date',
        'fa_date',
        'dp_percent',
        'denda_a',
        'denda_b',
        'matauang',
        'nilai_tukar',
        'jenis_kontrak',
        'memo_cara_bayar',
        'memo_lingkup_kerja',
        'is_instruksilangsung',
        'description',
        'coa_pph_default_id',
    ];
    protected $dates = ['date','start_date', 'finish_date', 'fa_date'];

    public function getRekananAttribute()
    {
        if ($this->tender_rekanan == NULL) 
        {
            return NULL;
        }
        
        return $this->tender_rekanan->rekanan;
    }

    public function rekanans(){
        return $this->belongsTo("Modules\Rekanan\Entities\RekananGroup","rekanan_id");
    }

    public function tender_rekanan()
    {
        return $this->belongsTo('Modules\Tender\Entities\TenderRekanan');
    }

    public function getPtAttribute()
    {
        return $this->tender->rab->workorder->pt;
    }

    public function getTenderAttribute()
    {
        if ($this->tender_rekanan == NULL) 
        {
            return NULL;
        }

        return $this->tender_rekanan()->first()->tender;
    }

    public function type()
    {
        return $this->belongsTo('Modules\Spk\Entities\SpkType');
    }

    public function parent()
    {
        return $this->belongsTo('Modules\Spk\Entities\Spk');
    }

    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project');
    }

    public function details()
    {
        return $this->hasMany('Modules\Spk\Entities\SpkDetail');
    }

    public function dp_pengembalians()
    {
        return $this->hasMany('Modules\Spk\Entities\SpkPengembalian');
    }

    public function baps()
    {
        return $this->hasMany('Modules\Spk\Entities\Bap');
    }

    // Voucher
    public function vouchers()
    {
        return \App\Voucher::whereHas('bap', function($bap){
            $bap->where('spk_id',$this->id);
        } );
    }

    public function getVouchersAttribute()
    {
        return $this->vouchers()->get();
    }
    // end of Voucher

    public function retensis()
    {
        return $this->hasMany('Modules\Spk\Entities\SpkRetensi');
    }

    public function suratinstruksis()
    {
        return $this->hasMany('Modules\Spk\Entities\Suratinstruksi');
    }

    public function siks()
    {
        return $this->suratinstruksis()->where('type', '=' , 'kerja');
    }

    public function sils()
    {
        return $this->suratinstruksis()->where('type', '=' , 'lapangan');
    }


    public function vos()
    {
        return $this->hasManyThrough('Modules\Spk\Entities\Vo', 'Modules\Spk\Entities\Suratinstruksi');
    }

    public function units()
    {
        return  \Modules\Project\Entities\Unit::whereHas('spk_details', function($q){ $q->where('spk_id', $this->id); });
    }

    public function getUnitsAttribute()
    {
        return $this->units()->get();
    }

    public function detail_units()
    {
        return $this->morphMany('Modules\Spk\Entities\SpkvoUnit', 'head');
    }

    public function getCoasAttribute()
    {
        return $this->progresses->first()->itempekerjaan->coas;
    }

    public function pics()
    {
        return $this->morphMany('Modules\Spk\Entities\SpkPoPic', 'head');
    }

    public function templatepekerjaans()
    {
        return \Modules\Project\Entities\Templatepekerjaan::whereHas('spkvo_units', function($q) 
        {
            $q->whereHas('spk_detail', function($r) 
            {
                $r->where('spk_id', $this->id);
            });
        });
    }

    public function templatepekerjaan_details()
    {
        return \Modules\Project\Entities\TemplatepekerjaanDetail::whereHas('spkvo_units', function($q) 
        {
            $q->whereHas('spk_detail', function($r) 
            {
                $r->where('spk_id', $this->id);
            });
        });
    }

    public function getTemplatepekerjaanDetailsAttribute()
    {
        return $this->templatepekerjaan_detailss()->get();
    }

    public function progresses()
    {
        return \Modules\Project\Entities\UnitProgress::whereHas('spkvo_unit', function($spkvounit){
            $spkvounit->where('head_type','Modules\Spk\Entities\Spk')->where('head_id', $this->id);
        });
    }

    public function getProgressesAttribute()
    {
        return $this->progresses()->get();
    }

    public function getNilaiAttribute()
    {
        $nilai = 0;

        foreach ($this->detail_units as $key => $each) 
        {
            $nilai = $nilai + $each->nilai * $each->volume;
        }

        return $nilai;
    }

    # tidak digunakan lagi, karena tidak menghitung retensi
    // public function getPpnAttribute()
    // {
    //     $nilai = 0;

    //     foreach ($this->detail_units as $key => $each) 
    //     {
    //         $nilai_now = $each->ppn * $each->nilai * $each->volume;

    //         $nilai = $nilai + $nilai_now;
    //     }

    //     return $nilai;
    // }
    // 
    public function getNilaiPpnVoAttribute()
    {
        $nilai = 0;

        foreach($this->vos as $key => $each)
        {
            $nilai += $each->nilai_ppn;
        }

        return $nilai;
    }

    public function getNilaiVoAttribute()
    {
        $nilai = 0;

        foreach ($this->vos as $key => $each) 
        {   
            $nilai = $nilai + $each->nilai;
        }

        return $nilai;
    }

    public function getNilaiPpnVoKontrakAttribute()
    {
        $nilai = 0;

        foreach ($this->vos as $key => $each) 
        {
            $nilai = $nilai + $each->nilai_ppn_kontrak;
        }

        return $nilai;
    }

    public function getNilaiVoucherAttribute()
    {
        $nilai = 0;

        foreach ($this->vouchers as $key => $each) 
        {
            $nilai = $nilai + $each->nilai;
        }

        return $nilai;
    }

    public function getNilaiBapAttribute()
    {
        $latest_bap = $this->baps()->latest()->first();

        if ($latest_bap) 
        {
            return $latest_bap->nilai_bap_termin;
        }else{
            return 0;
        }

    }

    public function getReportNilaiBapAttribute(){
        $nilai = 0;
        foreach ($this->baps as $key => $value) {
            # code...
            if ( $value->nilai ){
                $nilai = $nilai + $value->nilai_sertifikat;
            }
        }
        
        return round($nilai);
    }

    public function nilai()
    {
        if ($this->baps()->latest()->first()) 
        {
            $latest_bap = $this->baps()->latest()->first();

            return $latest_bap->nilai_sertifikat;
        }else{
            return 0;
        }

    }

    public function getNilaiKumulatifAttribute()
    {
        // nilai spk + vo
        
        return $this->nilai + $this->nilai_vo;
    }

    public function getLapanganAttribute()
    {
        if ($this->progresses->count() == 0) {
            return 0;
        }

        $progresses = $this->progresses;

        $total = array();

        foreach ($progresses as $key => $each) 
        {
            $total[$key] = $each->progresslapangan_percent * $each->nilai * $each->volume;
            $bobot[$key] = $each->nilai * $each->volume;
        }

        return number_format(array_sum($total) / array_sum($bobot), 2);
    }

    public function getNilaiLapanganAttribute()
    {
        if ($this->progresses->count() == 0) {
            return 0;
        }

        $progresses = $this->progresses;

        $total = array();

        foreach ($progresses as $key => $each) 
        {
            $total[$key] = $each->volume * $each->nilai * $each->progresslapangan_percent;
        }

        return array_sum($total) + $this->nilai_vo;
    }

    public function getNilaiRetensiAttribute()
    {
        $retensi = array();        

        if ($this->lapangan >= 1) 
        {
            foreach ($this->retensis as $key => $ret) 
            {
                $retensi[$key] = $ret->percent * $this->nilai_lapangan;
            }
            
        }else{

            foreach ($this->retensis as $key => $ret) 
            {
                if ($ret->is_progress) 
                {
                    $retensi[$key] = $ret->percent * $this->nilai_lapangan;
                }
            }
        }

        return array_sum($retensi);
    }

    public function getNilaiPpnKontrakAttribute()
    {
        $total = array();

        foreach ($this->detail_units as $key => $each) 
        {
            $total[$key] = $each->volume * $each->nilai * $each->ppn ;
        }

        return array_sum($total);
    }

    public function getNilaiPpnAttribute()
    {
        if ($this->detail_units->count() == 0) {
            return 0;
        }

        $detail_units = $this->detail_units;
        $progresses = $this->progresses;

        if ($this->lapangan >= 1) 
        {
            $percent_retensi = $this->retensis()->sum('percent');
        }else{
            $percent_retensi = $this->retensis()->where('is_progress', TRUE)->sum('percent');
        }

        $total = array();

        foreach ($detail_units as $key => $each) 
        {
            $nilai_lapangan = $each->volume * $each->nilai * $progresses[$key]->progresslapangan_percent;

            // termin retensi tidak ada retensi
            
            if ($this->st1_date) 
            {
                $nilai_setelah_retensi = $nilai_lapangan;

            }else{

                $nilai_setelah_retensi = $nilai_lapangan * (1 - $percent_retensi);
            }

            $total[$key] = $nilai_setelah_retensi * $each->ppn ;
        }

        return array_sum($total);
    }

    public function getBapAttribute()
    {
        if ($this->baps->count() <= 0) 
        {
            return 0;
        }

        $latest_bap = $this->baps()->latest()->first();

        return $latest_bap->percentage_kumulatif;
    }

    public function getBapSebelumnyaAttribute()
    {
        $baps = $this->baps;
        $total_percent = 0;

        foreach ($baps as $key => $each) 
        {
            $total_percent = $total_percent + $each->percentage_sekarang;
        }

        return $total_percent;
    }

    public function getSt1DateAttribute()
    {
        $bap_st1 = NULL;

        foreach ($this->baps as $key => $bap) 
        {
            if ($bap->percentage_kumulatif >= 1) 
            {
                $bap_st1 = $bap;
            }
        }

        if ($bap_st1) 
        {
            return $bap_st1->date;
        }else{
            return NULL;
        }

    }

    public function getNilaiDpAttribute()
    {
        $nilai = 0;

        foreach ($this->detail_units as $key => $each) 
        {
            $nilai += $each->nilai_dp + $each->nilai_ppn_dp;
        }

        return $nilai;
    }

    public function getNilaiFixAttribute(){
        $nilai = 0;
        foreach ($this->tender_rekanan->penawarans->last()->details as $key => $value) {
            # code...
            $nilai = $nilai + ( $value->nilai * $value->volume );
        }
        return $nilai;
    }

    public function termyn(){
        return $this->hasMany("Modules\Spk\Entities\SpkTermyn");
    }

    public function getCoaAttribute(){
        $progresses = $this->progresses->first();
        $itempekerjaan = Itempekerjaan::find($progresses->itempekerjaan_id);
        $code = explode(".",$itempekerjaan->code);
        $coas_item = Itempekerjaan::where("code",$code[0])->first();
        $item = Itempekerjaan::find($coas_item->id);

        return $item;
    }

    public function getNilaiProgressAttribute(){
        $nilai = 0;
        foreach ($this->progresses as $key => $value) {
            # code...
            $nilai = $nilai + $value->progresslapangan_percent;
        }
        if ( $nilai > 0 ){
            $nilai =  $nilai / count($this->progresses);
        }
        return $nilai;
    }

     public function getNilaiProgressBapAttribute(){
        $nilai = 0;
        foreach ($this->progresses as $key => $value) {
            # code...
            $nilai = $nilai + $value->progressbap_percent;
        }
        if ( $nilai > 0 ){
            $nilai =  $nilai / count($this->progresses);
        }
        return $nilai;
    }

    public function getKumulatifBapAttribute(){
        $nilai =0;
        foreach ($this->baps as $key => $value) {
            # code...
            $nilai = $value->nilai + $nilai;
        }
        return $nilai;
    }

    public function getItemPekerjaanAttribute(){
        if ( count($this->progresses) > 0  ){
            $itempekerjaan = $this->progresses->first()->itempekerjaan;
            $code = explode(".", $itempekerjaan->code);
            $id = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$code[0])->first();
            return $id;
        }
        
    }

}

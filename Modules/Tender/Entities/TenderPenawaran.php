<?php

namespace Modules\Tender\Entities;

use App\CustomModel;

class TenderPenawaran extends CustomModel
{
    protected $fillable = ['tender_rekanan_id', 'no', 'date', 'file_attachment'];
    protected $dates = ['date'];
    protected $appends 	= ['nilai'];

    public function rekanan()
    {
        return $this->belongsTo('Modules\Tender\Entities\TenderRekanan', 'tender_rekanan_id');
    }

    public function details()
    {
        return $this->hasMany('Modules\Tender\Entities\TenderPenawaranDetail')->where('deleted_at',null);;
    }

    public function getNilaiAttribute()
    {
    	$total = array("");

        foreach ($this->details as $key => $each) 
        {
        	//$total[$key] = $each->nilai * $each->volume * (1 + $each->rab_pekerjaan->ppn);
            $total[$key] = $each->nilai * $each->volume ;
        }

        return array_sum($total);
    }

    public function getNilaiPpnAttribute()
    {
        $total = array("");

        foreach ($this->details as $key => $each) 
        {
            $total[$key] = 0.1 * $each->nilai * $each->volume * (1 + $each->rab_pekerjaan->ppn);
        }

        return array_sum($total);
    }

    public function getNilaiTotalAttribute()
    {
        return $this->nilai + $this->nilai_ppn;
    }

     public function getTemplatePekerjaanAttribute(){
        $template = array();
        foreach ($this->details as $key => $value) {
            # code...
            $template[$key] = $value->rab_pekerjaan->templatepekerjaan_detail_id;
        }

        return array_values(array_unique($template));
    }
}

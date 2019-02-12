<?php

namespace Modules\Tender\Entities;

use App\CustomModel;

class TenderUnit extends CustomModel
{
    protected $fillable = ['rab_unit_id', 'tender_id'];

    public function rab_unit()
    {
        return $this->belongsTo('Modules\Rab\Entities\RabUnit');
    }

    public function tender()
    {
        return $this->belongsTo('Modules\Tender\Entities\Tender');
    }

    public function unit()
    {
        return $this->rab_unit->unit();
    }

    public function menangs()
    {
        return $this->hasMany('Modules\Tender\Entities\TenderMenang');
    }

    public function asset()
    {
        return $this->morphTo();
    }

    public function getEscrowAtapAttribute(){
        $nilai = 0;
        $total_item = 0;
        $unitprogress = \Modules\Project\Entities\UnitProgress::where("unit_id",$this->id)->get();
        foreach ($unitprogress as $key => $value) {
            if ( $value->itempekerjaan->escrow_id == "1"){
                $total_item = $total_item + 1 ;
                $nilai = $nilai + $value->progresslapangan_percent;
            }
        }
        
        if ( $total_item == "0"){
            return 0;
        }else{

            return $nilai / $total_item;
        }
    }

    public function getEscrowDindingAttribute(){
        $nilai = 0;
        $total_item = 0;
        $unitprogress = \Modules\Project\Entities\UnitProgress::where("unit_id",$this->id)->get();
        foreach ($unitprogress as $key => $value) {
            if ( $value->itempekerjaan->escrow_id == "2"){
                $total_item = $total_item + 1 ;
                $nilai = $nilai + $value->progresslapangan_percent;
            }
        }

        if ( $total_item == "0"){
            return 0;
        }else{

            return $nilai / $total_item;
        }
    }

    public function unit_progress(){
        return $this->hasMany("\Modules\Project\Entities\UnitProgress","unit_id");
    }

    public function getProgressAttribute(){
        $nilai = 0;
        $real_bobot = 0;
        $vo_bobot = 0;
        $total = 0;
        $main_nilai = 0;
        $main_percent = 0;
        $vo_nilai = 0;
        $vo_percent = 0;
        foreach ($this->unit_progress as $key => $value) {
            $nilai = $nilai + ($value->volume * $value->nilai);
        }

 
        //No VO
        foreach ($this->unit_progress as $key => $value) {
            if ( $value->spkvo_unit->head_type == "Modules\Spk\Entities\Spk" ){
                $main_nilai = ( $value->volume * $value->nilai ) + $main_nilai;
                $real_bobot_s =  ( ( $value->progresslapangan_percent * 100 ) / 100 ) * ( $value->bobot_rab ) ;
                $real_bobot = $real_bobot + $real_bobot_s;                
            }
        }
        
        

        //VO
        foreach ($this->unit_progress as $key => $value) {
            if ( $value->spkvo_unit != "" ){
                if ( $value->spkvo_unit->head_type == "Modules\Spk\Entities\Vo" ){
                    //$vo = $value->spkvo_unit->spk_detail->spk->nilai_vo;
                    $vo_nilai = ( $value->volume * $value->nilai ) + $vo_nilai;
                    $vo_bobot_s =  (( $value->progresslapangan_percent *  $vo_nilai ) / $vo_nilai ) * 100 ;
                    $vo_bobot = $vo_bobot + $vo_bobot_s;     
                    //return $vo_bobot ."<>".$vo_nilai."<>".$vo_bobot_s;  
                }
                /*if ( $value->spkvo_unit->spk_detail != "" ){
                    if ( $value->spkvo_unit->spk_detail->spk != "" ){
                        if ( $value->spkvo_unit->spk_detail->spk->nilai_vo != "" ){
                            $vo = $value->spkvo_unit->spk_detail->spk->nilai_vo;
                            if ( $vo > 0 ){
                                if ( $value->spkvo_unit->head_type == "Modules\Spk\Entities\Vo" ){
                                    $vo_nilai = ( $value->volume * $value->nilai ) + $vo_nilai;
                                    $vo_bobot_s =  (( $value->progresslapangan_percent *  $vo ) / $vo ) * 100 ;
                                    $vo_bobot = $vo_bobot + $vo_bobot_s;                
                                }
                            }
                        }
                    }
                }*/
                /*if ( $value->spkvo_unit->spk_detail->spk->nilai_vo != "" ){
                    $vo = $value->spkvo_unit->spk_detail->spk->nilai_vo;
                    if ( $value->spkvo_unit->head_type == "Modules\Spk\Entities\Vo" ){
                        $vo_nilai = ( $value->volume * $value->nilai ) + $vo_nilai;
                        $vo_bobot_s =  (( $value->progresslapangan_percent *  $vo ) / $vo ) * 100 ;
                        $vo_bobot = $vo_bobot + $vo_bobot_s;     
                        return $vo_bobot ."<>".$vo_nilai."<>".$vo_bobot_s;                     
                    }
                }*/
            }
            
        }
        //return $real_bobot."<>".$main_nilai."==".$vo_bobot."<>".$vo_nilai;

        //Main + VO Percent
        $main_percent = ( ( $real_bobot * (( $main_nilai / $nilai ) * 100 )) / 100 ) ;
        $vo_percent   = ( ( $vo_bobot * ( ( $vo_nilai / $nilai ) * 100 )) / 100 ) ;
        $sum_percent  = $main_percent + $vo_percent;
       
        return $sum_percent;
    }
}

<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetTahunanUnitPeriode extends Model
{
    protected $fillable = [];

    public function details(){
    	return $this->hasMany("Modules\Budget\Entities\BudgetTahunanUnitPeriodeDetail","budget_tahunan_periode");
    }

    public function budget_unit(){
    	return $this->belongsTo("Modules\Budget\Entities\BudgetTahunanUnit","budget_tahunan_unit_id");
    }

    public function getNilaiCashOutBulananAttribute($bulan){
       $array_pekerjaan = array(
       		"januari" => 0,
       		"februari" =>0,
       		"maret" =>0,
       		"april" =>0,
       		"mei" =>0,
       		"juni" =>0,
       		"juli" =>0,
       		"agustus" =>0,
       		"september" =>0,
       		"oktober" =>0,
       		"november" =>0,
       		"desember" =>0
      );

      $cashout_januari = 0; 
      $cashout_februari = 0; 
      $cashout_maret = 0; 
      $cashout_april = 0; 
      $cashout_mei = 0; 
      $cashout_juni = 0; 
      $cashout_juli = 0; 
      $cashout_agustus = 0;
      $cashout_september = 0;
      $cashout_oktober = 0;
      $cashout_november = 0;
      $cashout_desember = 0;


      foreach ($this->details as $key => $value) {
          $luas_bangunan = $this->budget_unit->unit_type->luas_bangunan;
          $array_harga['biaya_bangunan'] = array(
            "1" => ( $this->januari * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "2" => ( $this->februari * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "3" => ( $this->maret * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "4" => ( $this->april * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "5" => ( $this->mei * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "6" => ( $this->juni * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "7" => ( $this->juli * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "8" => ( $this->agustus * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "9" => ( $this->september * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "10" => ( $this->oktober * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "11" => ( $this->november * $luas_bangunan ) * $this->budget_unit->harga_satuan,
            "12" => ( $this->desember * $luas_bangunan ) * $this->budget_unit->harga_satuan               
          );
          

          $cashout_januari = ( $value->januari / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_februari = ( $value->februari / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_maret = ( $value->maret / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_april = ( $value->april / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_mei = ( $value->mei / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_juni = ( $value->juni / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_juli = ( $value->juli / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_agustus = ( $value->agustus / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_september = ( $value->september / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_oktober = ( $value->oktober / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_november = ( $value->november / 100 ) * $array_harga['biaya_bangunan'][$value->month];
          $cashout_desember = ( $value->desember / 100 ) * $array_harga['biaya_bangunan'][$value->month];

       		$array_pekerjaan["januari"] = $array_pekerjaan["januari"] + $cashout_januari ;
       		$array_pekerjaan["februari"] = $array_pekerjaan["februari"] + $cashout_februari ;
          $array_pekerjaan["maret"] = $array_pekerjaan["maret"] + $cashout_maret;
          $array_pekerjaan["april"] = $array_pekerjaan["april"] + $cashout_april ;
          $array_pekerjaan["mei"] = $array_pekerjaan["mei"] + $cashout_mei ;
          $array_pekerjaan["juni"] = $array_pekerjaan["juni"] + $cashout_juni ;
          $array_pekerjaan["juli"] = $array_pekerjaan["juli"] + $cashout_juli ;
          $array_pekerjaan["agustus"] = $array_pekerjaan["agustus"] + $cashout_agustus ;
          $array_pekerjaan["september"] = $array_pekerjaan["september"] + $cashout_september ;
          $array_pekerjaan["oktober"] = $array_pekerjaan["oktober"] + $cashout_oktober;
          $array_pekerjaan["november"] = $array_pekerjaan["november"] + $cashout_november ;
          $array_pekerjaan["desember"] = $array_pekerjaan["desember"] + $cashout_desember ;
       }

       return $array_pekerjaan;
    }
}

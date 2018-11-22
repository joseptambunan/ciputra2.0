<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class UnitTypeCategory extends Model
{
    protected $fillable = [];

    public function details(){
    	return $this->hasMany("Modules\Project\Entities\UnitTypeCategoryDetail");
    }

    public function unit_type(){
    	return $this->belongsTo("Modules\Project\Entities\UnitType","unit_type_id");
    }

    public function category_project(){
    	return $this->belongsTo("Modules\Category\Entities\CategoryProject","category_project_id");
    }

    public function getNilaiAttribute(){
    	$nilai = 0;
    	$nilai_per_item = 0;
    	if ( $this->unit_type->luas_tanah > 0 ){
    		foreach ($this->details as $key => $value) {
                if ( $value->satuan == "%"){
                    if ( $this->unit_type->luas_bangunan > 0 ){
                        $nilai_per_item = ( ($value->volume / 100 ) * $value->nilai ) / $this->unit_type->luas_bangunan;
                        $nilai = $nilai + $nilai_per_item;                        
                    }else{
                        $nilai_per_item = 0;
                        $nilai = $nilai + $nilai_per_item;
                    }
                }else{
                    if ( $this->unit_type->luas_bangunan > 0 ){                        
                        $nilai_per_item = ( $value->volume * $value->nilai ) / $this->unit_type->luas_bangunan;
                        $nilai = $nilai + $nilai_per_item;
                    }else{
                        $nilai_per_item = 0;
                        $nilai = $nilai + $nilai_per_item;
                    }
                }
    		}
    	}
    	return $nilai;
    }
}

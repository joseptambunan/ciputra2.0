<?php

namespace Modules\Project\Entities;

use App\CustomModel;


class UnitType extends CustomModel
{
	protected $fillable = ['name','description'];

    public function unit()
    {
        return $this->hasMany('Modules\Project\Entities\Unit');
    }

    public function templates(){
    	return $this->hasMany('Modules\Project\Entities\Templatepekerjaan');
    }

    public function category(){
    	return $this->hasOne("Modules\Project\Entities\UnitTypeCategory");
    }

    public function cluster(){
        return $this->belongsTo("Modules\Project\Entities\ProjectKawasan","cluster_id");
    }

    public function hpp_concost(){
        return $this->hasMany("Modules\Project\Entities\HppConCostDetailReport");
    }

    public function getPendingWoAttribute(){
        $pending = 0;
        foreach ($this->unit as $key => $value) {
            if ( $value->is_readywo == NULL && $value->status == 5 ){
                $pending = $pending + 1 ;
            }
        }
        return $pending;
    }

    public function getUnitTerbangunAttribute(){
        $nilai = 0;
        foreach ($this->unit as $key => $value) {
            if ( $value->is_readywo != NULL && $value->status != 5 ){
                $nilai = $nilai + 1 ;
            }
        }
        return $nilai;
    }

    public function specifications(){
        return $this->hasMany("Modules\Project\Entities\UnitTypeSpecification");
    }
}

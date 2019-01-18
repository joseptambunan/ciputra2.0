<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Approval;
use Modules\Budget\Entities\BudgetTahunan;

class BudgetTahunan extends Model
{

    use Approval;

    protected $fillable = ['budget_id','parent_id','no','tahun_anggaran','description'];

    public function scopeProject()
    {
       /* return $this->whereHas('budget', function($q){
            $q->where('project_id', session('project_id'));
        });*/
        return $this->budget->project->name;
    }

     public function scopeKawasan()
    {
       /* return $this->whereHas('budget', function($q){
            $q->where('project_id', session('project_id'));
        });*/
        return $this->budget->kawasan->name;
    }


    public function budget()
    {
        return $this->belongsTo('Modules\Budget\Entities\Budget');
    }

    public function details()
    {
        return $this->hasMany('Modules\Budget\Entities\BudgetTahunanDetail');
    }

    public function workorders()
    {
        return $this->hasMany('App\Workorder');
    }

    public function rabs()
    {
        return $this->hasManyThrough('App\Rab', 'App\Workorder');
    }

    public function carry_over(){
        return $this->hasMany('Modules\Budget\Entities\BudgetCarryOver');
    }

    public function getCarryNilaiAttribute(){
        $nilai = 0;
        foreach ($this->carry_over as $key => $value) {
            if ( $value->hutang_bayar != "" ){
                $nilai = $nilai + $value->hutang_bayar;
            }else{
                $nilai = $value->nilai_rencana + $nilai;
            }
        }
        return $nilai;
    }

    public function getCarryNilaiConCostAttribute(){
        $nilai = 0;
        
        return $nilai;
    }

    public function getCarryNilaiDevCostAttribute(){
        $nilai = 0;
        
        return $nilai;
    }

    public function tenders()
    {
        return \App\Tender::whereHas('rab', function($q) 
        {
            $q->whereHas('workorder', function($r) 
            {
                $r->whereHas('budget_tahunan', function($s) 
                {
                    $s->where('id', $this->id);
                });
            });
        });
    }

    public function getNilaiAttribute()
    {   
        $nilai = 0;
        $item_bln = 0;
        foreach ($this->details as $key => $value) {
           $budgetcf = \Modules\Budget\Entities\BudgetTahunanPeriode::where("budget_id",$this->id)->where("itempekerjaan_id",$value->itempekerjaan_id)->get();
           if ( count($budgetcf) > 0 ){
                $spk = $value->volume * $value->nilai;
                foreach ( $budgetcf as $key2 => $value2 ){
                     $total_cash_out = (($value2->januari/100) * $spk ) + ( ($value2->februari/100) * $spk ) + ( ($value2->maret/100) * $spk ) + ( ($value2->april/100) * $spk ) + (($value2->mei/100) * $spk ) + ( ($value2->juni/100) * $spk ) + ( ($value2->juli/100) * $spk ) + ( ($value2->agustus/100) * $spk ) + ( ($value2->september/100) * $spk ) + ( ($value2->oktober/100) * $spk ) + ( ($value2->november/100) * $spk ) + ( ($value2->desember/100) * $spk );
                }
                $item_bln = $item_bln + $total_cash_out;
           }
        }
        return $this->carry_nilai + $this->carry_nilai_con_cost + $this->nilai_cash_out_con_cost + $item_bln;
    }

    public function geTendersAttribute()
    {
        return $this->tenders()->get();
    }

    public function itempekerjaans()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan', 'itempekerjaan_id');
    }

    public function getPtAttribute()
    {
        return $this->budget->pt;
    }

    public function total_volume($itemid,$type){
        

        $total_volume = 0;
        $total_nilai = 0;
        $total = 0;
        $satuan = "";
        $arrayResult = array("nilai" => "", "volume" => "", "satuan" => "");
        //for ( $i=0; $i<count($item_id); $i++ ){
            $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code","like",$itemid."%")->get();
            foreach ($itempekerjaan as $key => $value) {
                $budgets = \Modules\Budget\Entities\BudgetTahunanDetail::where("itempekerjaan_id",$value->id)->where("budget_tahunan_id",$this->id)->get();
                if ( count($budgets) > 0 ){
                    foreach ($budgets as $key2 => $value2) {

                        if ( isset($value2->volume)){
                            //echo $value2->volume;
                            $total_nilai = $total_nilai + $value2->nilai;
                            $total_volume = $total_volume + $value2->volume;
                            $satuan = $value2->satuan;
                        }
                    }
                }
                
            }
            $arrayResult = array("id" => $itemid, "nilai" => $total_nilai, "volume" => $total_volume, "satuan" => $satuan, "total" => $total);
        //}
        return $arrayResult[$type];        
    }

    public function getBudgetMonthlyAttribute(){
        $nilai = array();
        foreach ($this->details as $key => $value) {
            # code...
            if ( $value->itempekerjaans != "" ){

                $code = explode(".",$value->itempekerjaans->code);
                if ( sizeof($code) >= 2 ){
                    $nilai[$key] = $code[0].".".$code[1];
                }else{
                    $nilai[$key] = $code[0];
                }
            }
        }
        

        $uniqe      = array_unique($nilai);
        $item_id    = array_values($uniqe);
        $total_volume = 0;
        $total_nilai = 0;
        $total = 0;
        $arrayResult = array();
        for ( $i=0; $i<count($item_id); $i++ ){
             $total_volume = 0;
            $total_nilai = 0;
            $total = 0;
            $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$item_id[$i])->first();
            $bulanan = $this->monthly;
            if ( $bulanan != "" ){
                foreach ($bulanan as $key2 => $value2) {
                    $explode2 = explode(".", $value2->itempekerjaan->code);
                    $params = $value2->itempekerjaan->code;
                    /*if ( count($explode2) > 0 ){
                        $params = $explode2[0];
                    }else{
                        $params = $value2->itempekerjaan->code;
                    }*/
                    
                    if ( $item_id[$i] == $params ){
                            $arrayResult[$i] = array(
                            "id" => $value2->id,
                            "code" => $item_id[$i],
                            "januari" => $value2->januari,
                            "februari" => $value2->februari,
                            "maret" => $value2->maret,
                            "april" => $value2->april,
                            "mei" => $value2->mei,
                            "juni" => $value2->juni,
                            "juli" => $value2->juli,
                            "agustus" => $value2->agustus,
                            "september" => $value2->september,
                            "oktober" => $value2->oktober,
                            "november" => $value2->november,
                            "desember" => $value2->desember
                        );
                    }                    
                }
            }
        }
        return $arrayResult;
    }

    public function monthly(){
        return $this->hasMany("Modules\Budget\Entities\BudgetTahunanPeriode","budget_id");
    }

    public function getTotalParentItemAttribute(){
        $array = array();
        $nilai_satuan = 0;
        foreach ($this->details as $key => $value) {           
            if ( $value->itempekerjaans->group_cost == 1 ){
                if ( $value->itempekerjaans->parent != "" ){
                    if ( isset($array[$value->itempekerjaans->parent->id] )){
                        if ( $value->itempekerjaans->parent->details != "" ){
                            $satuan = $value->itempekerjaans->parent->details->satuan;
                        }else{
                            $satuan = "ls";
                        }

                        $array[$value->itempekerjaans->parent->id] = array(
                            "code" => $value->itempekerjaans->parent->code,
                            "satuan" => $satuan,
                            "itempekerjaan" => $value->itempekerjaans->parent->name,
                            "nilai" => $value->nilai + $array[$value->itempekerjaans->parent->id]["nilai"],
                            "volume" => $value->volume + $array[$value->itempekerjaans->parent->id]["volume"],
                            "group_cost" => $value->itempekerjaans->group_cost,
                            "nilai_terpakai" => 0,
                            "id" => $value->itempekerjaans->parent->id
                        );
                    }else{
                        if ( $value->itempekerjaans->parent->details != "" ){
                            $satuan = $value->itempekerjaans->parent->details->satuan;
                        }else{
                            $satuan = "ls";
                        }
                        $array[$value->itempekerjaans->parent->id] = array(
                            "code" => $value->itempekerjaans->parent->code,
                            "satuan" => $satuan,
                            "itempekerjaan" => $value->itempekerjaans->parent->name,
                            "nilai" => $value->nilai,
                            "volume" => $value->volume,
                            "group_cost" => $value->itempekerjaans->group_cost,
                            "nilai_terpakai" => 0,
                            "id" => $value->itempekerjaans->parent->id
                        );
                    }
                }
            }else{
                $nilai = $value->nilai;
                $volume = $value->volume;
                
                $nilai_satuan = $this->budget_unit->avg("harga_satuan");
                if ( $this->budget_unit->count() > 0 ){
                    /*foreach ($this->budget_unit as $key2 => $value2) {
                        $nilai = $nilai + ($value2->harga_satuan * $value2->volume);
                        $volume = $volume + $value2->volume;
                    }*/
                    $nilai = $this->budget_unit->avg("harga_satuan");
                    $volume = $this->budget_unit->sum("volume");
                }else{
                    $nilai = $value->nilai;
                    $volume = $value->volume;
                }

                if ( $value->itempekerjaans->parent != "" ){
                    if ( isset($array[$value->itempekerjaans->parent->id] )){
                        if ( $value->itempekerjaans->parent->details != "" ){
                            $satuan = $value->itempekerjaans->parent->details->satuan;
                        }else{
                            $satuan = "ls";
                        }
                        $array[$value->itempekerjaans->parent->id] = array(
                            "code" => $value->itempekerjaans->parent->code,
                            "satuan" => $value->satuan,
                            "itempekerjaan" => $value->itempekerjaans->parent->name,
                            "nilai" => $nilai,
                            "volume" => $volume,
                            "group_cost" => $value->itempekerjaans->group_cost,
                            "nilai_terpakai" => 0,
                            "id" => $value->itempekerjaans->parent->id
                        );
                    }else{
                        if ( $value->itempekerjaans->parent->details != "" ){
                            $satuan = $value->itempekerjaans->parent->details->satuan;
                        }else{
                            $satuan = "ls";
                        }

                         $array[$value->itempekerjaans->parent->id] = array(
                            "code" => $value->itempekerjaans->parent->code,
                            "satuan" => $value->satuan,
                            "itempekerjaan" => $value->itempekerjaans->parent->name,
                            "nilai" => $nilai,
                            "volume" => $volume,
                            "group_cost" => $value->itempekerjaans->group_cost,
                            "nilai_terpakai" => 0,
                            "id" => $value->itempekerjaans->parent->id
                        );
                    }
                }
            }
        }
        
        return $array;
    }

    public function getProjectAttribute(){
        return $this->budget->project;
    }
    
    public function getTotalDevCostAttribute(){
        $nilai = 0;
        foreach ($this->details as $key => $value) {
            # code...
            /*if (  \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->itempekerjaan_id) != "" ){                
                if ( \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->itempekerjaan_id)->group_cost == "1"){
                    $nilai = $nilai + ( $value->volume * $value->nilai);
                }
            }*/
            if ( $value->itempekerjaans != ""){
                if ( $value->itempekerjaans->group_cost == 1 ){
                    $nilai = $nilai + ( $value->volume * $value->nilai);
                }
            }
        }
        return $nilai ;
    }

    public function getTotalConCostAttribute(){
        $nilai = 0;
        $volume = 0;
        foreach ($this->budget_unit as $key => $value) {
            /*if ( $value->itempekerjaans->group_cost == 2 ){
                $nilai = $nilai + ($value->volume * $value->nilai);
            } */
            /*if ( $value->itempekerjaans != ""){
                if ( $value->itempekerjaans->group_cost == 2 ){
                    $nilai = $nilai + ( $value->volume * $value->nilai);
                }
            }*/
            $nilai = $nilai + ($value->harga_satuan * $value->volume );
        }
        return $nilai ;
    }

    public function getNilaiCarryOverAttribute(){
        $nilai = 0;
        foreach ($this->carry_over as $key => $value) {
            foreach ($value->cash_flows as $key1 => $value1) {
                if ( $value->hutang_bayar != "" ){
                    $nilai = $nilai + ( ( $value1->total / 100 ) * $value->hutang_bayar );
                }else{

                    $nilai = $nilai + ( ($value1->total / 100) * ( $value->spk->nilai - ( $value->spk->nilai_bap * $value->spk->nilai ) ) );
                }
            }
        }

        return $nilai;
    }

    public function getNilaiCarryOverDevCostAttribute(){
        $nilai = 0;
        foreach ($this->carry_over as $key => $value) {
            if ( $value->spk != "" ){
                if ( $value->spk->itempekerjaan->group_cost == 1 ){
                    foreach ($value->cash_flows as $key1 => $value1) {
                        $nilai = $nilai + ( ($value1->total / 100) * ( $value->spk->nilai - ( $value->spk->nilai_bap * $value->spk->nilai ) ) );
                    }
                }
            }
        }
        return $nilai;
    }

    public function getNilaiCarryOverConCostAttribute(){
        $nilai = 0;
        foreach ($this->carry_over as $key => $value) {
            if ( $value->spk != "" ){
                if ( $value->spk->itempekerjaan->group_cost == 2 ){
                    foreach ($value->cash_flows as $key1 => $value1) {
                        $nilai = $nilai + ( ($value1->total / 100) * ( $value->spk->nilai - ( $value->spk->nilai_bap * $value->spk->nilai ) ) );
                    }
                }
            }
        }
        return $nilai;
    }

    public function getTotalUnitsAttribute(){
        $nilai = 0;
        return $nilai;
    }

    public function budget_unit(){
        return $this->hasMany("Modules\Budget\Entities\BudgetTahunanUnit");
    }

    public function getCashFlowSpkAttribute(){
        $nilai = 0;
        foreach ($this->details as $key => $value) {
            if ( $value->itempekerjaans->group_cost == 2 ){
                foreach ($this->budget_unit as $key2 => $value2) {
                    $nilai = ( $value2->volume * $value->nilai ) + $nilai;
                }
            }            
        }
       

        return $nilai;
    }

    public function getMonthlyCashFlowAttribute(){
        $array = array(
            "januari" => 0,
            "februari" => 0,
            "maret" => 0,
            "april" => 0,
            "mei" => 0,
            "juni" => 0,
            "juli" => 0,
            "agustus" => 0,
            "september" => 0,
            "oktober" => 0,
            "november" => 0,
            "desember" => 0
        );
        $array_monthly = array();

        foreach ($this->budget_monthly as $key => $value) {
            $array["januari"] = $array["januari"] + ($value['januari']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
            $array["februari"] = $array["februari"] + ($value['februari']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
            $array["maret"] = $array["maret"] + ($value['maret']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
            $array["april"] = $array["april"] + ($value['april']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
            $array["mei"] = $array["mei"] + ($value['mei']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
            $array["juni"] = $array["juni"] + ($value['juni']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
            $array["juli"] = $array["juli"] + ($value['juli']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
            $array["september"] = $array["september"] + ($value['september']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
            $array["oktober"] = $array["oktober"] + ($value['oktober']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
            $array["november"] = $array["november"] + ($value['november']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));            
            $array["desember"] = $array["desember"] + ($value['desember']/100) * ( $this->total_volume($value['code'],"nilai") * $this->total_volume($value['code'],"volume"));
        }

        return $array;
    }

    public function getMonthlyBudgetUnitAttribute(){
         $array = array(
            "januari" => 0,
            "februari" => 0,
            "maret" => 0,
            "april" => 0,
            "mei" => 0,
            "juni" => 0,
            "juli" => 0,
            "agustus" => 0,
            "september" => 0,
            "oktober" => 0,
            "november" => 0,
            "desember" => 0
        );

        if ( $this->budget_unit != "" ){
            foreach ($this->budget_unit as $key => $value) {
                if ( $value->details != "" ){
                    foreach ( $value->details as $key2 => $value2 ){
                        $array["januari"] = ( $value2->januari ) + $array["januari"];
                        $array["februari"] = ( $value2->februari ) + $array["februari"];
                        $array["maret"] = ( $value2->maret ) + $array["maret"];
                        $array["april"] = ( $value2->april ) + $array["april"];
                        $array["mei"] = ( $value2->januari ) + $array["mei"];
                        $array["juni"] = ( $value2->januari ) + $array["juni"];
                        $array["juli"] = ( $value2->januari ) + $array["juli"];
                        $array["agustus"] = ( $value2->januari ) + $array["agustus"];
                        $array["september"] = ( $value2->januari ) + $array["september"];
                        $array["oktober"] = ( $value2->januari ) + $array["oktober"];
                        $array["november"] = ( $value2->januari ) + $array["november"];
                        $array["desember"] = ( $value2->januari ) + $array["desember"];
                    }
                }                
            }
        }
        

        return $array;
    }

    public function getNilaiCashOutConCostAttribute(){
        $nilai = 0;
        foreach ($this->budget_unit as $key => $value) {
            foreach ( $value->details as $key2 => $value2 ){
                $nilai = $nilai + ($value2->nilai_cash_out_bulanan['januari'] + $value2->nilai_cash_out_bulanan['februari'] + $value2->nilai_cash_out_bulanan['maret'] + $value2->nilai_cash_out_bulanan['april'] + $value2->nilai_cash_out_bulanan['mei'] + $value2->nilai_cash_out_bulanan['juni'] + $value2->nilai_cash_out_bulanan['juli'] + $value2->nilai_cash_out_bulanan['agustus'] + $value2->nilai_cash_out_bulanan['september'] + 
                              $value2->nilai_cash_out_bulanan['oktober'] + $value2->nilai_cash_out_bulanan['november'] + $value2->nilai_cash_out_bulanan['desember']);
            }
        }
        return $nilai;
    }

    public function getNilaiRealCashOutDevCostAttribute(){
        $nilai_carry_over_dev_cost = 0;
        $nilai_cash_out_carry_over_dc = 0;
        $item_bln = 0;        

        foreach ($this->carry_over as $key => $value) {
            if ( $value->spk->itempekerjaan->group_cost == 1 ){
                $nilai_carry_over_dev_cost = $nilai_carry_over_dev_cost + $value->nilai_rencana;
            }  
        }

        foreach ( $this->details as $key => $value ){
            if ( $value->itempekerjaans->group_cost == 1 ){
               if ( $value->volume > 0 && $value->nilai > 0 ){
                    $budgetcf = \Modules\Budget\Entities\BudgetTahunanPeriode::where("budget_id",$this->id)->where("itempekerjaan_id",$value->itempekerjaans->id)->get();
                    if ( count($budgetcf) > 0 ){
                        foreach ($budgetcf as $key2 => $value2) {
                            $spk = $value->volume * $value->nilai;
                            $total_cash_out = (($value2->januari/100) * $spk ) + ( ($value2->februari/100) * $spk ) + ( ($value2->maret/100) * $spk ) + ( ($value2->april/100) * $spk ) + (($value2->mei/100) * $spk ) + ( ($value2->juni/100) * $spk ) + ( ($value2->juli/100) * $spk ) + ( ($value2->agustus/100) * $spk ) + ( ($value2->september/100) * $spk ) + ( ($value2->oktober/100) * $spk ) + ( ($value2->november/100) * $spk ) + ( ($value2->desember/100) * $spk ) ;
                            $item_bln = $item_bln + $total_cash_out;
                        }
                    }
                } 
            }   
        }

        return $nilai_carry_over_dev_cost + $item_bln ;

        //$this->total_dev_cost + $this->total_con_cost
    }

    public function getNilaiRealCashOutConCostAttribute(){
        $nilai_carry_over_con_cost = 0;
        $nilai_cash_out_carry_over_cc = 0;
        

        foreach ($this->carry_over as $key => $value) {
            if ( $value->spk->itempekerjaan->group_cost == 2 ){
                $nilai_carry_over_con_cost = $nilai_carry_over_con_cost + $value->nilai_rencana;
            }   
        }


        return $nilai_carry_over_con_cost + $this->nilai_cash_out_con_cost;

        //$this->total_dev_cost + $this->total_con_cost
    }

    public function periode(){
        return $this->hasMany("Modules\Budget\Entities\BudgetTahunanPeriode","budget_id");
    }

    public function getNilaiTotalBulananDevCostAttribute(){
        $array = array(
            "jan" => 0,
            "feb" => 0,
            "mar" => 0,
            "apr" => 0,
            "mei" => 0,
            "jun" => 0,
            "jul" => 0,
            "agu" => 0,
            "sep" => 0,
            "okt" => 0,
            "nov" => 0,
            "des" => 0
        );

        foreach ($this->details as $key => $value) {

            if ( $value->volume > 0 && $value->nilai > 0 ){
                $budget_periode = BudgetTahunanPeriode::where("budget_id",$this->id)->where("itempekerjaan_id",$value->itempekerjaan_id)->get();
                if ( $budget_periode->count() > 0 ){
                    foreach ($budget_periode as $key2 => $value2) {
                        $array["jan"] = $array["jan"] + (( $value2->januari / 100 ) * ( $value->nilai * $value->volume ));
                        $array["jan"] = $array["jan"] + (( $value2->januari / 100 ) * ( $value->nilai * $value->volume ));
                        $array["jan"] = $array["jan"] + (( $value2->januari / 100 ) * ( $value->nilai * $value->volume ));
                        $array["jan"] = $array["jan"] + (( $value2->januari / 100 ) * ( $value->nilai * $value->volume ));
                        $array["jan"] = $array["jan"] + (( $value2->januari / 100 ) * ( $value->nilai * $value->volume ));
                        $array["jan"] = $array["jan"] + (( $value2->januari / 100 ) * ( $value->nilai * $value->volume ));
                        $array["jan"] = $array["jan"] + (( $value2->januari / 100 ) * ( $value->nilai * $value->volume ));
                        $array["jan"] = $array["jan"] + (( $value2->januari / 100 ) * ( $value->nilai * $value->volume ));
                        $array["jan"] = $array["jan"] + (( $value2->januari / 100 ) * ( $value->nilai * $value->volume ));
                    }
                }
            }
        }
    }
}

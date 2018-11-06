<?php 
namespace Modules\Workorder\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Approval;

class Workorder extends Model
{
    use Approval;

    protected $fillable = ['budget_tahunan_id','no','department_from','department_to','name','durasi','satuan_waktu','estimasi_nilaiwo','date','posisi_dokumen','description'];
    protected $dates = ['date'];

    public function scopeProject()
    {
        return $this->whereHas('budget_tahunan', function($q){
            $q->whereHas('budget', function($r){
                $r->where('project_id', session('project'));
            });
        });
    }
    public function getProjectAttribute()
    {
        //return $this->budget_tahunan->project;
        return $this->belongsTo('Modules\Project\Entities\Project', 'budget_tahunan_id');
    }

    public function budget_tahunan()
    {
        return $this->belongsTo('Modules\Budget\Entities\BudgetTahunan', 'budget_tahunan_id');
    }

    public function supports()
    {
        return $this->hasMany('Modules\Department\Entities\DepartmentSupport');
    }

    public function rabs()
    {
        return $this->hasMany('Modules\Rab\Entities\Rab')->whereNotNull("budget_tahunan_id");
    }

    public function tenders()
    {
        return $this->hasManyThrough('Modules\Tender\Entities\Tender', 'App\Rab');
    }

    public function departmentFrom()
    {
        return $this->belongsTo('Modules\Department\Entities\Department', 'department_from');
    }

    public function departmentTo()
    {
        return $this->belongsTo('Modules\Department\Entities\Department', 'department_to');
    }

    public function details()
    {
        return $this->hasMany('Modules\Workorder\Entities\WorkorderDetail');
    }

    public function getPtAttribute()
    {
        return $this->project->first()->pt_user->first()->pt;
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Project\Entities\Unit');
    }

    public function getNilaiAttribute()
    {
        /*$nilai = 0;

        foreach ($this->detail_pekerjaan as $key => $detail) 
        {
            $nilai = $nilai + ( $detail->volume * $detail->nilai );
        }

        $workorder_unit = $this->details->where("asset_type","App\Unit");
        $devcost = 0;
        
        foreach ($workorder_unit as $key => $value) {
            # code...
            $devcost = $devcost + $value->asset->templatepekerjaan->con_cost ;
        }

        return $nilai + $devcost;*/
        //return $this->estimasi_nilaiwo;
        $nilai = 0;
        foreach ($this->detail_pekerjaan as $key => $value) {
            # code...
            $nilai = $nilai + ( $value->volume * $value->nilai );
        }
        return $nilai;
    }

    public function approvalhistory(){                                                                             
        return $this->hasManyThrough("Modules\Approval\Entities\ApprovalHistory","App\User","id","approval_id");
    }

    public function detail_pekerjaan(){
        return $this->hasMany("Modules\Workorder\Entities\WorkorderBudgetDetail");
    }

    public function getSelfApprovalAttribute(){
        return $this->hasMany("Modules\Approval\Entities\ApprovalHistory","document_id");
    }

    public function itempekerjaan(){
        return $this->hasMany("Modules\Pekerjaan\Entities\Itempekerjaan","itempekerjaan_id");
    }

    public function getParentIdAttribute(){
        $nilai = array();
        $detailworkorder = array();
        $satuan = "";
        $budget_tahunan = "";
        $total_budget = 0;
        $workorder_budget_id = "";
        foreach ($this->detail_pekerjaan as $key => $value) {
            # code...
            //if ( isset($value->itempekerjaan->parent_id)){
                $explode = explode(".",$value->itempekerjaan->code);
                if ( count($explode) > 1 ){                    
                    $nilai[$key] = $explode[0].".".$explode[1];  
                }else{
                    $nilai[$key] = $explode[0];
                }
            //}

        }
        
        
        $uniqe = array_values(array_unique($nilai));

        for ( $i=0; $i < count($uniqe); $i++ ){
            $subtotal = 0;
            $volume = 0;
            $unitprice = 0;
            $id = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$uniqe[$i])->get()->first()->id;
            $deptcode = \Modules\Pekerjaan\Entities\Itempekerjaan::find($id)->department->code;
            $coa_code =  \Modules\Pekerjaan\Entities\Itempekerjaan::find($id)->code;
            $item_name = \Modules\Pekerjaan\Entities\Itempekerjaan::find($id)->name;
            $item_name = \Modules\Pekerjaan\Entities\Itempekerjaan::find($id)->name;
            
           /* $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("parent_id",$uniqe[$i])->get();
            foreach ($itempekerjaan as $key => $value) {*/
                # code...
                $detail_pekerjaan_workorder = WorkorderBudgetDetail::where("itempekerjaan_id",$id)->where("workorder_id",$this->id)->get()->first();
                if ( isset($detail_pekerjaan_workorder->volume)){
                    $workorder_budget_id = $detail_pekerjaan_workorder->id;
                    $subtotal_detail = $detail_pekerjaan_workorder->volume * $detail_pekerjaan_workorder->nilai ;
                    $subtotal = $subtotal + $subtotal_detail;
                    $satuan = $detail_pekerjaan_workorder->satuan;
                    $volume = $volume + $detail_pekerjaan_workorder->volume;
                    $unitprice = $unitprice + $detail_pekerjaan_workorder->nilai;
                    if ( $detail_pekerjaan_workorder->budget_tahunan != "" ){
                        $budget_tahunan = $detail_pekerjaan_workorder->budget_tahunan->no;
                    }else{
                        $budget_tahunan = "";
                    }
                    $total_budget = 0;
                    if ( $detail_pekerjaan_workorder->budget_tahunan != "" ){
                        foreach ($detail_pekerjaan_workorder->budget_tahunan->total_parent_item as $key7 => $value7) {
                           if ( $value7['code'] == $coa_code ){
                                $total_budget = $value7['total'] * $value7['volume'];
                                $coa_code."<>".$total_budget;
                           }
                        }                        
                    }
                }
            //}

            $detailworkorder[$i] = array(
                "deptcode" => $deptcode,
                "coa_code" => $coa_code,
                "item_name" => $item_name,
                "subtotal" => $subtotal,
                "satuan" => $satuan,
                "id" => $id,
                "volume" => $volume,
                "unitprice" => $unitprice,
                "budget_tahunan" => $budget_tahunan,
                "total_budget" => $total_budget,
                "workorder_budget_id" => $workorder_budget_id
            );
            
        }
        return $detailworkorder;
    }

    public function getSubTotalUnitAttribute(){
        $nilai = 0;
        foreach ($this->parent_id as $key => $value) {
            # code...
            $itempekerjaan = Itempekerjaan::where("parent_id",$value)->get();
            foreach ($itempekerjaan as $key => $value) {
                # code...
                $volume = WorkorderBudgetDetail::where("itempekerjaan_id",$value->id)->where("workorder_id",$this->id)->get()->first()->volume;
            }
        }
        return $nilai ;
    }

    public function getParentCoaAttribute(){
        $array = array();
        $array_coa = array();
        foreach ($this->detail_pekerjaan as $key => $value) {
            //if ( \Modules\Rab\Entities\RabPekerjaan::where("itempekerjaan_id",$value->itempekerjaan_id)->count() <= 0 ){
                    if ( \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->itempekerjaan_id)->group_cost == "1" ){
                    $code = explode(".", \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->itempekerjaan_id)->code );
                    $array[$key] = $code[0];
                }  
            //}
                      
        }
        
        $uniqe = array_values(array_unique($array));
        for ( $i=0; $i < count($uniqe); $i++ ){
            $item = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$uniqe[$i])->first();
            $array_coa[$i] = array(
                "id" => $item->id,
                "code" => $uniqe[$i],
                "label" => $item->name
            );
        }
        return $array_coa;
    }

    public function getUnitCoaAttribute(){
        $array = array();
        $array_coa = array();
        foreach ($this->details as $key => $value) {
            if ( \Modules\Rab\Entities\RabUnit::where("asset_id",$value->asset_id)->count() <= 0 ){
                if ( $value->asset_type == "App\Unit") {
                    $array[$key] = $value->unit->unit_type_id;
                }   
            }
            
        }
        $uniqe = array_values(array_unique($array));
        for ( $i=0; $i < count($uniqe); $i++ ){            
            $type = UnitType::find($uniqe[$i]);
            $template = Unit::where("unit_type_id",$type->id)->first();
            $array_coa[$i] = array(
                "id" => $type->id,
                "type" => $type->name,
                "template" => $template->templatepekerjaan->name,
                "budget" => $template->templatepekerjaan->budget_details->first()->nilai
            );
        }
        return $array_coa;
    }

    public function getBudgetParentAttribute(){
        $nilai = array();
        foreach ($this->detail_pekerjaan as $key => $value) {
            $nilai[$key] = $value->budget_tahunan_id;
        }

        return array_values(array_unique($nilai));
    }
    
}

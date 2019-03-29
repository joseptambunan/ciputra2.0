<?php 
namespace Modules\Tender\Entities;

use App\CustomModel;
use App\Traits\Approval;

class TenderRekanan extends CustomModel
{
    use Approval;

    protected $fillable = ['tender_id','rekanan_id','sipp_no','sipp_date','doc_ambil_date','doc_ambil_by','is_pemenang','doc_bayar_status','doc_bayar_date','description'];
    protected $dates = ['sipp_date', 'doc_bayar_date','doc_ambil_date'];

    public function tender()
    {
        return $this->belongsTo('Modules\Tender\Entities\Tender')->orderBy("id","desc");
    }

    public function rekanan()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\Rekanan');
    }

    public function spk()
    {
        return $this->hasOne('Modules\Spk\Entities\Spk');
    }

    public function penawarans()
    {
        return $this->hasMany('Modules\Tender\Entities\TenderPenawaran')->where('deleted_at',null);;
    }

    public function menangs()
    {
        return $this->hasMany('Modules\Tender\Entities\TenderMenang')->where('deleted_at',null);;
    }

    public function korespondensis()
    {
        return $this->hasMany('Modules\Tender\Entities\TenderKorespondensi')->where('deleted_at',null);;
    }

    public function workorder()
    {
        return $this->hasMany('Modules\Workorder\Entities\Workorder');
    }

    public function getNilaiAttribute()
    {

        if ($this->penawarans->count() > 0 ) 
        {
            return $this->penawarans()->latest()->first()->nilai;
        }else{
            return $this->tender->nilai;
            //return 0;
        }
    }

    public function getNoAttribute()
    {
        return $this->sipp_no;
    }
    public function getPtAttribute()
    {
        return $this->tender->pt;
    }

    public function getSelfApprovalAttribute(){
        return $this->hasMany("Modules\Approval\Entities\ApprovalHistory","document_id");
    }

    public function getTemplatePekerjaanAttribute(){
        $template_pekerjaan = array();
        $flag = array("");
        $start = 0;
        $flag_template = "";
        foreach ($this->menangs as $key => $value) {
            foreach ($value->details as $key2 => $value2 ) {
                if ( $flag_template != $value2->templatepekerjaan_detail->templatepekerjaan->id ){
                    $flag = array("");
                }
 
                if ( in_array($value2->itempekerjaan_id, $flag )) {

                }else{

                    $flag[$key2] = $value2->itempekerjaan_id;
                    $template_pekerjaan[$start]= array( "item_id" => $value2->itempekerjaan_id, "name" => $value2->itempekerjaan->name, "nilai" => $value2->nilai, "volume" => $value2->volume, "satuan" => $value2->satuan, "template_name" => $value2->templatepekerjaan_detail->templatepekerjaan->name, "template_id" => $value2->templatepekerjaan_detail->templatepekerjaan->id ) ;
                    $template_id[$key] = $value2->templatepekerjaan_detail_id;     
                    $flag_template =  $value2->templatepekerjaan_detail->templatepekerjaan->id;             
                    $start++;
                    
                }     

            }            
        }

        return $template_pekerjaan;
    }

    public function project(){
        return $this->tender->rab->workorder->project;
    }

    public function getDepartmentFromAttribute(){
        return $this->tender->rab->workorder->department_from;
    }

}

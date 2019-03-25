<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequest extends CustomModel
{
    public $table = "tender_purchase_requests";

    protected $fillable = ["tender_pr_groups_id",'rab_id','kirim_penawaran','status','kelas_id','no','name','aanwijzing_type','aanwijzing_date','penawaran1_date','klarifikasi1_date','penawaran2_date','klarifikasi2_date','penawaran3_date','final_date','recommendation_date','pengumuman_date','penawaran_date','penawaran_group','penawaran_no','sumber','description'];
    
    public function tender_group()
    {
    	return $this->hasOne("Modules\TenderPurchaseRequest\Entities\TenderPurchaseRequestGroup","id","tender_pr_groups_id");
    }

    public function approval()
    {
        return $this->morphMany('Modules\Approval\Entities\Approval','document','document_type','document_id');
    }

}

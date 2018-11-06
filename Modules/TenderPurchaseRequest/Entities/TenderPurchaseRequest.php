<?php

namespace Modules\TenderPurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class TenderPurchaseRequest extends CustomModel
{
    public $table = "tender_purchase_requests";

    protected $fillable = ['id',"tender_pr_groups_id",'rab_id','kelas_id','no','name','aanwijzing_type','aanwijzing_date','penawaran1_date','klarifikasi1_date','penawaran2_date','klarifikasi2_date','penawaran3_date','final_date','recommendation_date','pengumuman_date','sumber','description'];
    


}

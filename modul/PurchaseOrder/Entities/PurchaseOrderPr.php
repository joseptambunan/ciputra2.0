<?php

namespace Modules\PurchaseOrder\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class PurchaseOrderPr extends CustomModel
{
    public $table = "purchaseorder_prs";

    protected $fillable = ["id","purchaseorder_detail_id","purchaserequest_id","purchaserequest_detail_id","budget_tahunan_id","purchaserequest_no","departement_id","departement_name","quantity","satuan","satuan_id","urgent","date_dibutuhkan"];

}

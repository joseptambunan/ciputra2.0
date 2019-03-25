<?php

namespace Modules\PurchaseOrder\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;


class PurchaseOrderTerm extends CustomModel
{
    public $table = "purchaseorder_term_pengiriman";

    protected $fillable = ["id","purchaseorder_id","date"];

}

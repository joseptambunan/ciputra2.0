<?php

namespace Modules\Tender\Entities;

use Illuminate\Database\Eloquent\Model;

class TenderDocumentApproval extends Model
{
    protected $fillable = [];

    public function user(){
    	return $this->belongsTo("Modules\User\Entities\User");
    }
}

<?php

namespace Modules\Tender\Entities;

use Illuminate\Database\Eloquent\Model;

class TenderDocument extends Model
{
    protected $fillable = [];

    public function document_approval(){
    	return $this->hasMany("Modules\Tender\Entities\TenderDocumentApproval");
    }

    public function getRejectedAttribute(){
    	$nilai = 0;
    	foreach ($this->document_approval as $key => $value) {
    		if ( $value->status == "7"){
    			$nilai = $nilai + 1;
    		}
    	}
    	return $nilai;
    }

    public function getPendingAttribute(){
        $nilai = 0;
        foreach ($this->document_approval as $key => $value) {
            if ( $value->status == "1"){
                $nilai = $nilai + 1;
            }
        }
        return $nilai;
    }
}

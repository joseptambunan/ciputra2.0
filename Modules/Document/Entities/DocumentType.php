<?php

namespace Modules\Document\Entities;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = [];

    public function approval_histories()
    {
        return $this->hasMany('Modules\Approval\Entities\ApprovalHistory');
    }
}

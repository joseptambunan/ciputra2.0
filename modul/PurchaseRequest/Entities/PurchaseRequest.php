<?php

namespace Modules\PurchaseRequest\Entities;

use Illuminate\Database\Eloquent\Model;
use App\CustomModel;

class PurchaseRequest extends CustomModel
{
    public $table = "purchaserequests";
    protected $fillable = ['budget_tahunan_id','pt_id','department_id','location_id','project_for_id','no','date','butuh_date','is_urgent','description'];

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department', 'department_id');
    }

    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt', 'pt_id');
    }

    public function budget()
    {
        return $this->belongsTo('Modules\Budget\Entities\BudgetTahunan','budget_tahunan_id');
    }

    public function details()
    {
        return $this->hasMany('Modules\PurchaseRequest\Entities\PurchaserequestDetail','purchaserequest_id','id');
    }

    public function getNilaiAttribute()
    {
        return 0;
    }

    public function approval()
    {
        return $this->morphMany('Modules\Approval\Entities\Approval','document','document_type','document_id');
    }
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project','project_for_id');
    }
}

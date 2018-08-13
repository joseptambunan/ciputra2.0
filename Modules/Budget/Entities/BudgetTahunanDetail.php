<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetTahunanDetail extends Model
{
    protected $fillable = ['budget_tahunan_id','itempekerjaan_id','nilai','max_overbudget','description'];

    public function budget_tahunan()
    {
        return $this->belongsTo('Modules\Budget\Entities\BudgetTahunan');
    }

    public function budget_tahunan_detail()
    {
        return $this->belongsTo('Modules\Budget\Entities\BudgetTahunanDetail');
    }

    public function itempekerjaans()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan', 'itempekerjaan_id');
    }

    public function itempekerjaan_detail()
    {
        //return $this->belongsTo('App\ItempekerjaanDetail');
        return $this->hasMany('Modules\Pekerjaan\Entities\ItempekerjaanDetail');
    }
}

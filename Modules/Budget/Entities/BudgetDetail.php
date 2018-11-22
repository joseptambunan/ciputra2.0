<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Approval;

class BudgetDetail extends Model
{

    use Approval;

    public function budget()
    {
        return $this->belongsTo('Modules\Budget\Entities\Budget');
    }

    public function itempekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan');
    }

    public function itempekerjaan_details()
    {
        return $this->itempekerjaan->details();
    }

    public function getPtAttribute(){
        return $this->budget->pt;
    }
}

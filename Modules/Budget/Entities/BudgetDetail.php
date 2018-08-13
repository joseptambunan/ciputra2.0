<?php

namespace Modules\Budget\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetDetail extends Model
{
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
}

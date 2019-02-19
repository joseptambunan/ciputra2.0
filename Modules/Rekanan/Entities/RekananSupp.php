<?php

namespace Modules\Rekanan\Entities;

use App\CustomModel;

class RekananSupp extends CustomModel
{
    protected $fillable = ['rekanan_id','pt_id','penandatangan','saksi','supp_template_id','no','date','expired_at','printed_at','setuju_at','description'];
    protected $dates = ['date','expired_at','printed_at','setuju_at'];

    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt');
    }

    public function rekanan()
    {
        return $this->belongsTo('Modules\Rekanan\Entities\Rekanan');
    }

    public function user_penandatangan()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'penandatangan');
    }

    public function user_saksi()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'saksi');
    }

    public function supp_template()
    {
        return $this->belongsTo('App\SuppTemplate', 'supp_template_id');
    }
}

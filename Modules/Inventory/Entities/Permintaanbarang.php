<?php

namespace Modules\Inventory\Entities;

use App\CustomModel;
use App\Traits\Approval;

class Permintaanbarang extends CustomModel
{
    use Approval;

    protected $dates = ['date'];

    protected $fillable = ['project_id','pt_id','department_id','spk_id','user_id','no','status_permintaan_id','status_persetujuan','confirm_by_requester','date','description'];
    
    public function barangkeluars()
    {
        return $this->hasMany('Modules\Inventory\Entities\Barangkeluar');
    }

    public function details()
    {
        return $this->hasMany('Modules\Inventory\Entities\PermintaanbarangDetail');
    }
    
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project');
    }

    public function pt()
    {
        return $this->belongsTo('Modules\Pt\Entities\Pt');
    }

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department');
    }

    public function spk()
    {
        return $this->belongsTo('Modules\Spk\Entities\Spk');
    }

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    public function getNilaiAttribute()
    {
        return 0;
    }

    public function StatusPermintaan()
    {
        return $this->belongsTo('Modules\Inventory\Entities\StatusPermintaan','status_permintaan_id');
    }
}

<?php

namespace Modules\Approval\Entities;

use App\CustomModel;

class ApprovalHistory extends CustomModel
{
    protected $fillable = ['no_urut','user_id','approval_action_id','approval_id','document_id','document_type','description','document_tpe_id'];
    
    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    public function approval()
    {
        return $this->belongsTo('Modules\Approval\Entities\Approval');
    }

    public function document_type()
    {
        return $this->belongsTo('Modules\Document\Entities\DocumentType');
    }

    public function action()
    {
        return $this->belongsTo('Modules\Approval\Entities\ApprovalAction', 'approval_action_id');
    }

    public function document()
    {
        return $this->morphTo();
    }

    public function getUrutCheckAttribute()
    {
        $approval = $this->approval;
        $urut_terbesar = $approval->histories()->max('no_urut');

        while ($urut_terbesar > 0) 
        {
            foreach ($approval->histories()->where('no_urut', $urut_terbesar)->get() as $key => $each) 
            {
                if (($each->approval_action_id == 1) OR ($each->approval_action_id == 2))   // jika ada yg statusnya open atau delivered, maka no urut ini yg terbesar
                {
                    if ($this->no_urut == $urut_terbesar) 
                    {
                        return TRUE;
                    }else{
                        return FALSE;                        
                    }
                }
            }

            $urut_terbesar = $urut_terbesar - 1;
        }

        return FALSE;   // no urut terbesar tidak ditemukan
    }

}

<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class Templatepekerjaan extends Model
{
    protected $fillable = ['code','tag','name','luasbangunan','hppbangunanpermeter','is_sellable','description'];

    public function unit()
    {
        return $this->hasMany('Modules\Project\Entities\Unit');
    }

    public function spkvo_units()
    {
        return $this->hasMany('Modules\Spk\Entities\SpkvoUnit', 'templatepekerjaan_id');
    }

    public function details()
    {
        return $this->hasMany('Modules\Project\Entities\TemplatepekerjaanDetail');
    }

    public function itempekerjaans()
    {
        return \Modules\Pekerjaan\Entities\Itempekerjaan::whereHas('templatepekerjaan_details', function($q)
        {
            $q->where('templatepekerjaan_id', $this->id);
        });
    }

    public function getItempekerjaansAttribute()
    {
        return $this->itempekerjaans()->get();
    }

    public function getCalculateBobotAttribute()
    {
        $total = 0;

        foreach ($this->details as $key => $each) 
        {
            $total = $total + ($each->nilai * $each->volume);
        }

        foreach ($this->details as $key => $detail) 
        {
            $detail->update([
                'bobot'=> $detail->nilai * $detail->volume / $total
            ]);
        }

        return $total;
    }

    public function unit_type(){
        return $this->belongsTo("Modules\Project\Entities\UnitType");
    }
}

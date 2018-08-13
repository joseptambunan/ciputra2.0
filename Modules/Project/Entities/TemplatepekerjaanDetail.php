<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class TemplatepekerjaanDetail extends Model
{
    protected $fillable = ['itempekerjaan_id','group_tahapan_id','group_item_id','urutitem','termin','nilai','volume','satuan','bobot','is_pembangunan','description'];

    public function templatepekerjaan()
    {
        return $this->belongsTo('Modules\Project\Entities\Templatepekerjaan');
    }

    public function itempekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan');
    }

    public function group_item()
    {
        return $this->belongsTo('App\GroupItem');
    }

    public function group_tahapan()
    {
        return $this->belongsTo('App\GroupTahapan');
    }

    public function unit_progresses()
    {
        return $this->hasMany('App\UnitProgress');
    }

    public function spkvo_units()
    {
        return $this->hasMany('App\SpkvoUnit');
    }

    public function rab_pekerjaans()
    {
        return $this->hasMany('App\RabPekerjaan');
    }

    public function item_satuan()
    {
        return $this->belongsTo('App\ItemSatuan', 'satuan');
    }
}

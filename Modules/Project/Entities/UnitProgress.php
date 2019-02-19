<?php

namespace Modules\Project\Entities;

use App\CustomModel;

class UnitProgress extends CustomModel
{
	protected $dates = ['mulai_jadwal_date','selesai_jadwal_date', 'selesai_actual_date'];
    protected $fillable = [
        'project_id',
        'unit_id',
        'unit_type',
        'itempekerjaan_id',
        'group_tahapan_id',
        'group_item_id',
        'progresslapangan_percent',
        'progressbap_percent', 
        'mulai_jadwal_date', 
        'selesai_jadwal_date', 
        'selesai_actual_date',
        'urutitem',
        'termin',
        'nilai',
        'volume',
        'satuan',
        'bobot',
        'durasi',
        'is_pembangunan'
    ];

    public function details()
    {
        return $this->hasMany('Modules\Project\Entities\UnitProgressDetail')->orderBy('id','desc');
    }

    public function itempekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan');
    }

    public function unit()
    {
        return $this->morphTo();
    }

    public function item_pekerjaan()
    {
        return $this->belongsTo('Modules\Pekerjaan\Entities\Itempekerjaan');
    }

    public function spkvo_unit()
    {
        return $this->hasOne('Modules\Spk\Entities\SpkvoUnit');
    }

    public function getDocumentAttribute()
    {
        if ($this->spkvo_unit) 
        {
            return $this->spkvo_unit->head;
        }else{
            return $this->spkvo_unit;
        }
    }

    public function scopeDevCost($query)
    {
        return $query->whereHas('itempekerjaan', function($q){ 
            $q->whereGroupCost(2); 
        });
    }

    public function scopeConCost($query)
    {
        return $query->whereHas('itempekerjaan', function($q){ 
            $q->whereGroupCost(1); 
        });
    }

    public function getNilaiTotalAttribute(){
        $nilai = 0;
        foreach ($this->spkvo_unit as $key => $value) {
           $nilai = $nilai + $value->nilai_total;
        }
        return $nilai;
    }

    public function getProgresSebelumnyaAttribute(){
        $nilai = 0;
        $sebelumnya = strtotime("now");

        foreach ($this->details as $key => $value) {
            if ( ($key + 1 ) < count($this->details) ){
                $nilai = $value->progress_percent * 100;
            }
            
        }
        return $nilai ;
    }

    public function getBobotRabAttribute(){
        $nilai = 0;
        if ( isset($this->spkvo_unit->spk_detail)){

            if ( isset($this->spkvo_unit->spk_detail->spk->tender )){            
                $volume = $this->spkvo_unit->spk_detail->spk->tender->rab->pekerjaans->where("itempekerjaan_id",$this->itempekerjaan_id)->first()->volume;
                $nilai  = $this->spkvo_unit->spk_detail->spk->tender->rab->pekerjaans->where("itempekerjaan_id",$this->itempekerjaan_id)->first()->nilai;
                return (( $volume * $nilai ) / $this->spkvo_unit->spk_detail->spk->tender->rab->nilai ) * 100 ;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}

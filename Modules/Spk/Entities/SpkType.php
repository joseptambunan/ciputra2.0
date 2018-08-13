<?php 
namespace Modules\Spk\Entities;

use App\CustomModel;

class SpkType extends CustomModel
{
	protected $fillable = ['description'];

    public function spks()
    {
        return $this->hasMany('Modules\Spk\Entities\Spk');
    }
}

<?php

namespace Modules\Inventory\Entities;;

use App\CustomModel;

class Item extends CustomModel
{
    protected $fillable = ['name','kode','brand_id','sub_item_category_id','item_category_id','description'];

    public function brand()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Brand');
    }

    public function category()
    {
        return $this->belongsTo('Modules\Inventory\Entities\ItemCategory', 'item_category_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Entities\Warehouse', 'default_warehouse_id');
    }

    public function satuans()
    {
        return $this->hasMany('Modules\Inventory\Entities\ItemSatuan');
    }

    public function prices()
    {
        return $this->hasMany('Modules\Inventory\Entities\ItemPrice');
    }

    public function purchaserequest_details()
    {
        return $this->hasMany('Modules\Inventory\Entities\PurchaserequestDetail');
    }

    public function permintaanbarang_details()
    {
        return $this->hasMany('Modules\Inventory\Entities\PermintaanbarangDetail');
    }

    public function barangkeluar_details()
    {
        return $this->hasMany('Modules\Inventory\Entities\BarangkeluarDetail');
    }

    public function asset_details()
    {
        return $this->hasMany('Modules\Inventory\Entities\AssetDetail');
    }

    public function asset_detail_items()
    {
        return $this->hasMany('Modules\Inventory\Entities\AssetDetailItem');
    }

    public function inventories()
    {
        return $this->hasMany('Modules\Inventory\Entities\Inventory');
    }

    public function inventory_transfer_details()
    {
        return $this->hasMany('Modules\Inventory\Entities\InventoryTransferDetail');
    }

    public function goodreceive_details()
    {
        return $this->hasMany('Modules\Inventory\Entities\GoodreceiveDetail');
    }
}

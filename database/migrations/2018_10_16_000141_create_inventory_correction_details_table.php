<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryCorrectionDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'inventory_correction_details';

    /**
     * Run the migrations.
     * @table inventory_correction_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('inventory_correction_id');
            $table->integer('item_id');
            $table->integer('warehouse_id');
            $table->integer('satuan_id');
            $table->integer('quantity_app')->nullable()->default(null);
            $table->integer('quantity_fisik')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["satuan_id"], 'inventory_correction_details_satuan_id_index');

            $table->index(["item_id"], 'inventory_correction_details_item_id_index');

            $table->index(["warehouse_id"], 'inventory_correction_details_warehouse_id_index');

            $table->index(["inventory_correction_id"], 'inventory_correction_details_inventory_correction_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}

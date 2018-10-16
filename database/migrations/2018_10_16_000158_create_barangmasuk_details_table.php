<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangmasukDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'barangmasuk_details';

    /**
     * Run the migrations.
     * @table barangmasuk_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('barangmasuk_id')->nullable()->default(null);
            $table->integer('purchaseorder_detail_id')->nullable()->default(null);
            $table->integer('goodreceive_detail_id')->nullable()->default(null);
            $table->integer('warehouse_id')->nullable()->default(null);
            $table->integer('brand_id')->nullable()->default(null);
            $table->string('quantity', 191)->nullable()->default(null);
            $table->double('price')->nullable()->default(null);
            $table->decimal('ppn', 5, 2)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
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

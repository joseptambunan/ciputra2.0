<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaserequestDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'purchaserequest_details';

    /**
     * Run the migrations.
     * @table purchaserequest_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('purchaserequest_id');
            $table->integer('itempekerjaan_id');
            $table->integer('item_id');
            $table->integer('item_satuan_id');
            $table->integer('brand_id');
            $table->string('recomended_supplier', 191);
            $table->integer('quantity');
            $table->string('description', 191);
            $table->integer('rec_1')->nullable()->default(null);
            $table->integer('rec_2')->nullable()->default(null);
            $table->integer('rec_3')->nullable()->default(null);
            $table->date('delivery_date');
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

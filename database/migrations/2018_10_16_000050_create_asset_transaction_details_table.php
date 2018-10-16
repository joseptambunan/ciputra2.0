<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTransactionDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'asset_transaction_details';

    /**
     * Run the migrations.
     * @table asset_transaction_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('asset_transaction_id')->nullable()->default(null);
            $table->integer('asset_detail_item_id')->nullable()->default(null);
            $table->integer('from_user_id')->nullable()->default(null);
            $table->integer('from_department_id')->nullable()->default(null);
            $table->integer('from_unit_sub_id')->nullable()->default(null);
            $table->integer('from_location_id')->nullable()->default(null);
            $table->integer('to_user_id')->nullable()->default(null);
            $table->integer('to_department_id')->nullable()->default(null);
            $table->integer('to_unit_sub_id')->nullable()->default(null);
            $table->integer('to_location_id')->nullable()->default(null);
            $table->timestamp('received_at')->nullable()->default(null);
            $table->integer('status')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
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

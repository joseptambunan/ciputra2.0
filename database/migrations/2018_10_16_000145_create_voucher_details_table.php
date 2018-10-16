<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'voucher_details';

    /**
     * Run the migrations.
     * @table voucher_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('voucher_id')->nullable()->default(null);
            $table->string('coa_id', 32)->nullable()->default(null);
            $table->integer('head_id')->nullable()->default(null);
            $table->string('head_type', 191)->nullable()->default(null);
            $table->double('nilai')->nullable()->default(null);
            $table->string('type', 191)->nullable()->default(null);
            $table->string('mata_uang', 191)->nullable()->default(null);
            $table->double('kurs')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["head_type"], 'voucher_details_head_type_index');

            $table->index(["coa_id"], 'voucher_details_coa_id_index');

            $table->index(["head_id"], 'voucher_details_head_id_index');

            $table->index(["voucher_id"], 'voucher_details_voucher_id_index');
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

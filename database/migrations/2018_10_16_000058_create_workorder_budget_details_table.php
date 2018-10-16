<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkorderBudgetDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'workorder_budget_details';

    /**
     * Run the migrations.
     * @table workorder_budget_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('workorder_id')->nullable()->default(null);
            $table->integer('itempekerjaan_id')->nullable()->default(null);
            $table->integer('budget_tahunan_id')->nullable()->default(null);
            $table->integer('tahun_anggaran')->nullable()->default(null);
            $table->string('volume', 191)->nullable()->default(null);
            $table->string('satuan', 191)->nullable()->default(null);
            $table->string('nilai', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["workorder_id"], 'workorder_budget_details_workorder_id_index');

            $table->index(["itempekerjaan_id"], 'workorder_budget_details_itempekerjaan_id_index');

            $table->index(["budget_tahunan_id"], 'workorder_budget_details_budget_tahunan_id_index');
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

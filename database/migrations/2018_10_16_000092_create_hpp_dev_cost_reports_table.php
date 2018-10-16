<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHppDevCostReportsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'hpp_dev_cost_reports';

    /**
     * Run the migrations.
     * @table hpp_dev_cost_reports
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('project_id')->nullable()->default(null);
            $table->integer('project_kawasan_id')->nullable()->default(null);
            $table->integer('itempekerjaan')->nullable()->default(null);
            $table->string('budget_awal', 24)->nullable()->default(null);
            $table->string('budget_tahun', 24)->nullable()->default(null);
            $table->string('kontrak_total', 24)->nullable()->default(null);
            $table->string('kontrak_tahun', 24)->nullable()->default(null);
            $table->string('progress_lapangan', 24)->nullable()->default(null);
            $table->string('progress_bap', 24)->nullable()->default(null);
            $table->string('bap_terbayar_total', 24)->nullable()->default(null);
            $table->string('bap_terbayar_tahun', 24)->nullable()->default(null);
            $table->string('saldo_budget_awal', 24)->nullable()->default(null);
            $table->string('saldo_budget_tahun', 24)->nullable()->default(null);
            $table->string('saldo_kontrak_total', 24)->nullable()->default(null);
            $table->string('created_by', 2)->nullable()->default('1');
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->integer('group_cost')->nullable()->default(null);
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

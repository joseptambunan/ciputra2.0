<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHppDevCostSummaryReportsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'hpp_dev_cost_summary_reports';

    /**
     * Run the migrations.
     * @table hpp_dev_cost_summary_reports
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
            $table->integer('efisiensi')->nullable()->default(null);
            $table->double('luas_netto')->nullable()->default(null);
            $table->double('luas_bruto')->nullable()->default(null);
            $table->double('total_budget')->nullable()->default(null);
            $table->double('hpp_netto')->nullable()->default(null);
            $table->double('hpp_bruto')->nullable()->default(null);
            $table->double('total_kontrak')->nullable()->default(null);
            $table->double('hpp_kontrak_netto')->nullable()->default(null);
            $table->double('hpp_kontrak_bruto')->nullable()->default(null);
            $table->double('total_kontrak_terbayar')->nullable()->default(null);
            $table->double('hpp_realisasi_netto')->nullable()->default(null);
            $table->double('hpp_realisasi_bruto')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('delete_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('inactive_by')->nullable()->default(null);
            $table->timestamp('delete_at')->nullable()->default(null);
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

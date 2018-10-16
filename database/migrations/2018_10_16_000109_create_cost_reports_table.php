<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostReportsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'cost_reports';

    /**
     * Run the migrations.
     * @table cost_reports
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
            $table->integer('spk_id')->nullable()->default(null);
            $table->integer('itempekerjaan')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->integer('department')->nullable()->default(null);
            $table->double('progress_lapangan')->nullable()->default(null);
            $table->double('progress_bap')->nullable()->default(null);
            $table->double('nilai')->nullable()->default(null);
            $table->integer('rekanan')->nullable()->default(null);
            $table->integer('rekanan_type')->nullable()->default(null);

            $table->index(["itempekerjaan"], 'itempekerjaan');
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

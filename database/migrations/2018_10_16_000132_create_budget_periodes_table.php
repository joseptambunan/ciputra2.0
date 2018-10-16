<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetPeriodesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'budget_periodes';

    /**
     * Run the migrations.
     * @table budget_periodes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('budget_id')->nullable()->default(null);
            $table->integer('tahun')->nullable()->default(null);
            $table->integer('itempekerjaan_id')->nullable()->default(null);
            $table->integer('volume')->nullable()->default(null);
            $table->integer('satuan')->nullable()->default(null);
            $table->integer('nilai')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["itempekerjaan_id"], 'budget_periodes_itempekerjaan_id_index');

            $table->index(["budget_id"], 'budget_periodes_budget_id_index');
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

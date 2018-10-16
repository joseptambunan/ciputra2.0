<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'budgets';

    /**
     * Run the migrations.
     * @table budgets
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('pt_id')->nullable()->default(null);
            $table->integer('department_id')->nullable()->default(null);
            $table->integer('project_id')->nullable()->default(null);
            $table->integer('parent_id')->nullable()->default(null);
            $table->integer('project_kawasan_id')->nullable()->default(null);
            $table->string('no', 191)->nullable()->default(null);
            $table->date('start_date')->nullable()->default(null);
            $table->date('end_date')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->integer('status_active')->nullable()->default('1');

            $table->index(["project_id"], 'budgets_project_id_index');

            $table->index(["department_id"], 'budgets_department_id_index');

            $table->index(["project_kawasan_id"], 'budgets_project_kawasan_id_index');

            $table->index(["pt_id"], 'budgets_pt_id_index');

            $table->index(["parent_id"], 'budgets_parent_id_index');
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

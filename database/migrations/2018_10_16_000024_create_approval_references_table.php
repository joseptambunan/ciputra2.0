<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalReferencesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'approval_references';

    /**
     * Run the migrations.
     * @table approval_references
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->nullable()->default(null);
            $table->integer('project_id')->nullable()->default(null);
            $table->integer('pt_id')->nullable()->default(null);
            $table->string('document_type', 191)->nullable()->default(null);
            $table->integer('no_urut')->nullable()->default(null);
            $table->double('min_value')->nullable()->default(null);
            $table->double('max_value')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->tinyInteger('is_action')->default('1');
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["user_id", "project_id", "pt_id"], 'approval_references_user_id_project_id_pt_id_index');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectKawasansTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'project_kawasans';

    /**
     * Run the migrations.
     * @table project_kawasans
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
            $table->integer('project_type_id')->nullable()->default(null);
            $table->string('code', 191)->nullable()->default(null);
            $table->string('name', 191)->nullable()->default(null);
            $table->string('lahan_status', 191)->nullable()->default(null);
            $table->double('lahan_luas')->nullable()->default(null);
            $table->double('lahan_sellable')->default('0.00');
            $table->string('zipcode', 191)->nullable()->default(null);
            $table->tinyInteger('is_kawasan')->default('1');
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->integer('id_kawasan_erems')->nullable()->default(null);

            $table->index(["project_id", "project_type_id"], 'project_kawasans_project_id_project_type_id_index');
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

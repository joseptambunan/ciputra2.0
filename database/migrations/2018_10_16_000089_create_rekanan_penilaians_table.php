<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekananPenilaiansTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'rekanan_penilaians';

    /**
     * Run the migrations.
     * @table rekanan_penilaians
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
            $table->integer('rekanan_id')->nullable()->default(null);
            $table->date('review_date')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["project_id", "rekanan_id"], 'rekanan_penilaians_project_id_rekanan_id_index');
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
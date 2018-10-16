<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiutangsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'piutangs';

    /**
     * Run the migrations.
     * @table piutangs
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('rekanan_id')->nullable()->default(null);
            $table->integer('approved_by')->nullable()->default(null);
            $table->integer('project_id')->nullable()->default(null);
            $table->integer('pt_id')->nullable()->default(null);
            $table->string('no', 191)->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->double('nilai')->nullable()->default(null);
            $table->timestamp('approved_at')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["project_id"], 'piutangs_project_id_index');

            $table->index(["approved_by"], 'piutangs_approved_by_index');

            $table->index(["rekanan_id"], 'piutangs_rekanan_id_index');

            $table->index(["pt_id"], 'piutangs_pt_id_index');
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

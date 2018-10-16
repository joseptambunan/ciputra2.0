<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkordersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'workorders';

    /**
     * Run the migrations.
     * @table workorders
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('budget_tahunan_id')->nullable()->default(null);
            $table->integer('department_from')->nullable()->default(null);
            $table->integer('department_to')->nullable()->default(null);
            $table->string('no', 191)->nullable()->default(null);
            $table->string('name', 191)->nullable()->default(null);
            $table->integer('durasi')->default('0');
            $table->integer('satuan_waktu')->default('0');
            $table->double('estimasi_nilaiwo')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->integer('posisi_dokumen')->default('1');
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->dateTime('end_date')->nullable()->default(null);

            $table->index(["department_to"], 'workorders_department_to_index');

            $table->index(["budget_tahunan_id"], 'workorders_budget_tahunan_id_index');

            $table->index(["department_from"], 'workorders_department_from_index');
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

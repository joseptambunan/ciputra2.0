<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitProgressesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'unit_progresses';

    /**
     * Run the migrations.
     * @table unit_progresses
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
            $table->integer('unit_id')->nullable()->default(null);
            $table->string('unit_type', 191)->nullable()->default(null);
            $table->integer('itempekerjaan_id')->nullable()->default(null);
            $table->integer('group_tahapan_id')->nullable()->default(null);
            $table->integer('group_item_id')->nullable()->default(null);
            $table->integer('urutitem')->nullable()->default(null);
            $table->integer('termin')->nullable()->default(null);
            $table->double('nilai')->default('0.00');
            $table->string('volume', 191)->nullable()->default(null);
            $table->string('satuan', 191)->nullable()->default(null);
            $table->decimal('bobot', 7, 4)->nullable()->default(null);
            $table->integer('durasi')->default('0');
            $table->tinyInteger('is_pembangunan')->default('1');
            $table->decimal('progresslapangan_percent', 5, 2)->nullable()->default(null);
            $table->decimal('progressbap_percent', 5, 2)->nullable()->default(null);
            $table->date('mulai_jadwal_date')->nullable()->default(null);
            $table->date('selesai_jadwal_date')->nullable()->default(null);
            $table->date('selesai_actual_date')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["itempekerjaan_id"], 'itempekerjaan_id');

            $table->index(["project_id"], 'unit_progresses_project_id_index');

            $table->index(["unit_id"], 'unit_progresses_unit_id_index');
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

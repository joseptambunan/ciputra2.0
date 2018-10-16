<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpkvoUnitsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'spkvo_units';

    /**
     * Run the migrations.
     * @table spkvo_units
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('spk_detail_id')->nullable()->default(null);
            $table->integer('head_id')->nullable()->default(null);
            $table->string('head_type', 191)->nullable()->default(null);
            $table->integer('templatepekerjaan_id')->nullable()->default(null);
            $table->integer('unit_progress_id')->nullable()->default(null);
            $table->double('nilai')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->float('volume')->nullable()->default(null);
            $table->string('satuan', 191)->nullable()->default(null);
            $table->decimal('ppn', 5, 2)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["templatepekerjaan_id"], 'spkvo_units_templatepekerjaan_id_index');

            $table->index(["spk_detail_id"], 'spkvo_units_spk_detail_id_index');

            $table->index(["unit_progress_id"], 'spkvo_units_unit_progress_id_index');

            $table->index(["head_id"], 'spkvo_units_head_id_index');

            $table->index(["head_type"], 'spkvo_units_head_type_index');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRabPekerjaansTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'rab_pekerjaans';

    /**
     * Run the migrations.
     * @table rab_pekerjaans
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('rab_unit_id')->nullable()->default(null);
            $table->integer('templatepekerjaan_detail_id')->nullable()->default(null);
            $table->integer('itempekerjaan_id')->nullable()->default(null);
            $table->integer('nilai')->nullable()->default(null);
            $table->float('volume')->nullable()->default(null);
            $table->string('satuan', 191)->nullable()->default(null);
            $table->decimal('ppn', 5, 2)->default('0.00');
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->tinyInteger('is_pembangunan')->nullable()->default('1');
            $table->integer('urutitem')->nullable()->default(null);
            $table->integer('termin')->nullable()->default(null);

            $table->index(["rab_unit_id"], 'rab_pekerjaans_rab_unit_id_index');

            $table->index(["templatepekerjaan_detail_id"], 'rab_pekerjaans_templatepekerjaan_detail_id_index');
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

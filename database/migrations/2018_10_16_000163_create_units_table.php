<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'units';

    /**
     * Run the migrations.
     * @table units
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('blok_id')->nullable()->default(null);
            $table->integer('templatepekerjaan_id')->nullable()->default(null);
            $table->integer('pt_id')->nullable()->default(null);
            $table->integer('peruntukan_id')->nullable()->default(null);
            $table->integer('unit_arah_id')->nullable()->default(null);
            $table->integer('unit_hadap_id')->nullable()->default(null);
            $table->integer('unit_type_id')->nullable()->default(null);
            $table->string('code', 191)->nullable()->default(null);
            $table->string('name', 191)->nullable()->default(null);
            $table->double('tanah_luas')->nullable()->default(null);
            $table->double('bangunan_luas')->nullable()->default(null);
            $table->tinyInteger('is_sellable')->default('1');
            $table->integer('status')->default('0');
            $table->string('tag_kategori', 191)->default('b');
            $table->date('st1_date')->nullable()->default(null);
            $table->date('st2_date')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->integer('id_erems')->nullable()->default(null);

            $table->index(["peruntukan_id"], 'units_peruntukan_id_index');

            $table->index(["templatepekerjaan_id"], 'units_templatepekerjaan_id_index');

            $table->index(["unit_arah_id"], 'units_unit_arah_id_index');

            $table->index(["blok_id"], 'units_blok_id_index');

            $table->index(["pt_id"], 'units_pt_id_index');

            $table->index(["unit_type_id"], 'units_unit_type_id_index');
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

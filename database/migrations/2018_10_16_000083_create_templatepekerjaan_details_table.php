<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatepekerjaanDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'templatepekerjaan_details';

    /**
     * Run the migrations.
     * @table templatepekerjaan_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('templatepekerjaan_id')->nullable()->default(null);
            $table->integer('itempekerjaan_id')->nullable()->default(null);
            $table->integer('group_tahapan_id')->nullable()->default(null);
            $table->integer('group_item_id')->nullable()->default(null);
            $table->integer('periode_id')->nullable()->default(null);
            $table->integer('urutitem')->nullable()->default(null);
            $table->integer('termin')->nullable()->default(null);
            $table->double('nilai')->default('0.00');
            $table->string('volume', 191)->nullable()->default(null);
            $table->string('satuan', 191)->nullable()->default(null);
            $table->decimal('bobot', 5, 2)->nullable()->default(null);
            $table->integer('durasi')->default('0');
            $table->tinyInteger('is_pembangunan')->default('1');
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["itempekerjaan_id"], 'templatepekerjaan_details_itempekerjaan_id_index');

            $table->index(["group_tahapan_id"], 'templatepekerjaan_details_group_tahapan_id_index');

            $table->index(["group_item_id"], 'templatepekerjaan_details_group_item_id_index');

            $table->index(["templatepekerjaan_id"], 'templatepekerjaan_details_templatepekerjaan_id_index');
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

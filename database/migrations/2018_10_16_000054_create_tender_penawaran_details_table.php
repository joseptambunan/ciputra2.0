<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderPenawaranDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tender_penawaran_details';

    /**
     * Run the migrations.
     * @table tender_penawaran_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('tender_penawaran_id')->nullable()->default(null);
            $table->integer('rab_pekerjaan_id')->nullable()->default(null);
            $table->string('keterangan', 191)->nullable()->default(null);
            $table->double('nilai')->nullable()->default(null);
            $table->float('volume')->nullable()->default(null);
            $table->string('satuan', 32);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["tender_penawaran_id"], 'tender_penawaran_details_tender_penawaran_id_index');

            $table->index(["rab_pekerjaan_id"], 'tender_penawaran_details_rab_pekerjaan_id_index');
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

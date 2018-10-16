<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetProgressesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'asset_progresses';

    /**
     * Run the migrations.
     * @table asset_progresses
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('asset_id')->nullable()->default(null);
            $table->string('asset_type', 191)->nullable()->default(null);
            $table->integer('templatepekerjaan_detail_id')->nullable()->default(null);
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

            $table->index(["templatepekerjaan_detail_id"], 'asset_progresses_templatepekerjaan_detail_id_index');

            $table->index(["asset_id"], 'asset_progresses_asset_id_index');
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

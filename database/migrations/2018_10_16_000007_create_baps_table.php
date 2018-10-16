<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBapsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'baps';

    /**
     * Run the migrations.
     * @table baps
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('spk_id')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->integer('termin')->nullable()->default(null);
            $table->string('no', 191)->nullable()->default(null);
            $table->double('nilai_administrasi')->nullable()->default(null);
            $table->double('nilai_denda')->nullable()->default(null);
            $table->double('nilai_selisih')->nullable()->default(null);
            $table->decimal('nilai_talangan', 11, 2)->nullable()->default(null);
            $table->decimal('nilai_dp', 11, 2)->nullable()->default(null);
            $table->bigInteger('nilai_bap_1')->nullable()->default(null);
            $table->bigInteger('nilai_bap_2')->nullable()->default(null);
            $table->bigInteger('nilai_bap_3')->nullable()->default(null);
            $table->bigInteger('nilai_bap_dibayar')->nullable()->default(null);
            $table->bigInteger('nilai_retensi');
            $table->integer('nilai_pembayaran_saat_ini')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->integer('spk_retensi_id')->nullable()->default(null);
            $table->decimal('percentage', 5, 2)->nullable()->default(null);
            $table->integer('percentage_lapangan')->nullable()->default(null);
            $table->integer('percentage_sebelumnyas')->nullable()->default(null);
            $table->integer('status_voucher');
            $table->integer('nilai_spk')->nullable()->default(null);
            $table->integer('nilai_vo')->nullable()->default(null);

            $table->index(["spk_id"], 'baps_spk_id_index');
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

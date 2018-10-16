<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekanansTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'rekanans';

    /**
     * Run the migrations.
     * @table rekanans
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('rekanan_group_id')->nullable()->default(null);
            $table->integer('kelas_id')->nullable()->default(null);
            $table->integer('surat_kota')->nullable()->default(null);
            $table->string('name', 191)->nullable()->default(null);
            $table->string('surat_alamat', 191)->nullable()->default(null);
            $table->string('surat_kodepos', 191)->nullable()->default(null);
            $table->string('email', 191)->nullable()->default(null);
            $table->string('telp', 191)->nullable()->default(null);
            $table->string('fax', 191)->nullable()->default(null);
            $table->string('cp_name', 191)->nullable()->default(null);
            $table->string('cp_ktp', 191)->nullable()->default(null);
            $table->string('cp_ktp_image', 191)->nullable()->default(null);
            $table->string('cp_jabatan', 191)->nullable()->default(null);
            $table->string('cp_whatsap', 191)->nullable()->default(null);
            $table->string('cp_line', 191)->nullable()->default(null);
            $table->integer('survey_status')->default('1');
            $table->date('survey_date')->nullable()->default(null);
            $table->date('pkp_date')->nullable()->default(null);
            $table->integer('pkp_status')->default('1');
            $table->integer('aktif_status')->default('2');
            $table->integer('stujk')->default('1');
            $table->string('siup_no', 191)->nullable()->default(null);
            $table->string('siup_image', 191)->nullable()->default(null);
            $table->string('tdp_no', 191)->nullable()->default(null);
            $table->string('tdp_image', 191)->nullable()->default(null);
            $table->date('gabung_date')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->integer('ppn');

            $table->index(["kelas_id", "surat_kota", "rekanan_group_id"], 'rekanans_kelas_id_surat_kota_rekanan_group_id_index');
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

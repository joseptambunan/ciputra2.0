<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpksTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'spks';

    /**
     * Run the migrations.
     * @table spks
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
            $table->integer('dp_nilai')->nullable()->default('0');
            $table->integer('rekanan_id')->nullable()->default(null);
            $table->integer('tender_rekanan_id')->nullable()->default(null);
            $table->integer('spk_type_id')->nullable()->default(null);
            $table->string('spk_parent_id', 21)->nullable()->default(null);
            $table->string('no', 191)->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->string('name', 191)->nullable()->default(null);
            $table->date('start_date')->nullable()->default(null);
            $table->date('finish_date')->nullable()->default(null);
            $table->date('fa_date')->nullable()->default(null);
            $table->decimal('dp_percent', 15, 2)->nullable()->default(null);
            $table->integer('denda_a')->nullable()->default(null);
            $table->integer('denda_b')->nullable()->default(null);
            $table->string('matauang', 191)->nullable()->default(null);
            $table->double('nilai_tukar')->nullable()->default(null);
            $table->string('jenis_kontrak', 191)->nullable()->default(null);
            $table->text('memo_cara_bayar')->nullable()->default(null);
            $table->text('memo_lingkup_kerja')->nullable()->default(null);
            $table->tinyInteger('is_instruksilangsung')->default('0');
            $table->string('description', 191)->nullable()->default(null);
            $table->string('carapembayaran', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->float('garansi_nilai')->nullable()->default(null);
            $table->integer('coa_pph_default_id')->nullable()->default(null);
            $table->integer('pic_id')->nullable()->default(null);
            $table->string('st_1', 12)->nullable()->default(null);
            $table->string('st_2', 12)->nullable()->default(null);
            $table->string('st_3', 12)->nullable()->default(null);

            $table->index(["tender_rekanan_id"], 'spks_tender_rekanan_id_index');

            $table->index(["spk_type_id"], 'spks_spk_type_id_index');

            $table->index(["spk_parent_id"], 'spks_spk_parent_id_index');

            $table->index(["rekanan_id"], 'spks_rekanan_id_index');

            $table->index(["project_id"], 'spks_project_id_index');
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

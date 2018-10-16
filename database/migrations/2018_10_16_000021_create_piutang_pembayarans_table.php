<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiutangPembayaransTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'piutang_pembayarans';

    /**
     * Run the migrations.
     * @table piutang_pembayarans
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('piutang_id')->nullable()->default(null);
            $table->integer('sumber_id')->nullable()->default(null);
            $table->string('sumber_type', 191)->nullable()->default(null);
            $table->double('nilai')->nullable()->default(null);
            $table->string('cara_pembayaran', 191)->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["sumber_type"], 'piutang_pembayarans_sumber_type_index');

            $table->index(["sumber_id"], 'piutang_pembayarans_sumber_id_index');

            $table->index(["piutang_id"], 'piutang_pembayarans_piutang_id_index');
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

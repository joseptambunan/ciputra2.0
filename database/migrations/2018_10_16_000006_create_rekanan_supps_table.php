<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekananSuppsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'rekanan_supps';

    /**
     * Run the migrations.
     * @table rekanan_supps
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('rekanan_id')->nullable()->default(null);
            $table->integer('pt_id')->nullable()->default(null);
            $table->integer('penandatangan')->nullable()->default(null);
            $table->integer('saksi')->nullable()->default(null);
            $table->integer('supp_template_id')->nullable()->default(null);
            $table->string('no', 191)->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->date('expired_at')->nullable()->default(null);
            $table->timestamp('printed_at')->nullable()->default(null);
            $table->timestamp('setuju_at')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["penandatangan"], 'rekanan_supps_penandatangan_index');

            $table->index(["saksi"], 'rekanan_supps_saksi_index');

            $table->index(["pt_id"], 'rekanan_supps_pt_id_index');

            $table->index(["rekanan_id"], 'rekanan_supps_rekanan_id_index');

            $table->index(["supp_template_id"], 'rekanan_supps_supp_template_id_index');
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

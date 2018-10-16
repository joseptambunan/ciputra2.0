<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'vouchers';

    /**
     * Run the migrations.
     * @table vouchers
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('head_id')->nullable()->default(null);
            $table->string('head_type', 191)->nullable()->default(null);
            $table->integer('rekanan_id')->nullable()->default(null);
            $table->integer('rekanan_rekening_id')->nullable()->default(null);
            $table->integer('department_id')->nullable()->default(null);
            $table->integer('pt_id')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->string('no', 191)->nullable()->default(null);
            $table->string('no_faktur', 191)->nullable()->default(null);
            $table->date('tempo_date')->nullable()->default(null);
            $table->date('penyerahan_date')->nullable()->default(null);
            $table->date('pencairan_date')->nullable()->default(null);
            $table->tinyInteger('is_out')->default('1');
            $table->integer('export_count')->nullable()->default(null);
            $table->integer('posting')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->string('spm_status', 1)->nullable()->default(null);

            $table->index(["head_id"], 'vouchers_head_id_index');

            $table->index(["head_type"], 'vouchers_head_type_index');

            $table->index(["pt_id"], 'vouchers_pt_id_index');

            $table->index(["rekanan_id"], 'vouchers_rekanan_id_index');

            $table->index(["department_id"], 'vouchers_department_id_index');
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

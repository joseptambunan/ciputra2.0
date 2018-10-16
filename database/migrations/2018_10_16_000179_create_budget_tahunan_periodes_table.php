<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTahunanPeriodesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'budget_tahunan_periodes';

    /**
     * Run the migrations.
     * @table budget_tahunan_periodes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('budget_id')->nullable()->default(null);
            $table->integer('bulan')->nullable()->default(null);
            $table->integer('itempekerjaan_id')->nullable()->default(null);
            $table->integer('volume')->nullable()->default(null);
            $table->string('satuan', 11)->nullable()->default(null);
            $table->double('nilai')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->float('januari')->nullable()->default(null);
            $table->float('februari')->nullable()->default(null);
            $table->float('maret')->nullable()->default(null);
            $table->float('april')->nullable()->default(null);
            $table->float('mei')->nullable()->default(null);
            $table->float('juni')->nullable()->default(null);
            $table->float('juli')->nullable()->default(null);
            $table->float('agustus')->nullable()->default(null);
            $table->float('september')->nullable()->default(null);
            $table->float('oktober')->nullable()->default(null);
            $table->float('november')->nullable()->default(null);
            $table->float('desember')->nullable()->default(null);

            $table->index(["budget_id"], 'budget_tahunan_periodes_budget_id_index');
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

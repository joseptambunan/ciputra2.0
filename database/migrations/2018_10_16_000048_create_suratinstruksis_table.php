<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratinstruksisTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'suratinstruksis';

    /**
     * Run the migrations.
     * @table suratinstruksis
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
            $table->string('no', 191)->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->string('perihal', 191)->nullable()->default(null);
            $table->mediumText('content')->nullable()->default(null);
            $table->tinyInteger('biaya')->default('0');
            $table->tinyInteger('is_tambahbiaya')->default('0');
            $table->date('start_date')->nullable()->default(null);
            $table->date('finish_date')->nullable()->default(null);
            $table->string('type', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["spk_id"], 'suratinstruksis_spk_id_index');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItempekerjaanProgressesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'itempekerjaan_progresses';

    /**
     * Run the migrations.
     * @table itempekerjaan_progresses
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('item_pekerjaan_id');
            $table->integer('termyn')->nullable()->default(null);
            $table->integer('percentage')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->dateTime('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitProgressDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'unit_progress_details';

    /**
     * Run the migrations.
     * @table unit_progress_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('unit_progress_id')->nullable()->default(null);
            $table->integer('pic_rekanan')->nullable()->default(null);
            $table->integer('pic_internal')->nullable()->default(null);
            $table->date('progress_date')->nullable()->default(null);
            $table->decimal('progress_percent', 5, 2)->nullable()->default(null);
            $table->timestamp('setuju_rekanan_at')->nullable()->default(null);
            $table->timestamp('setuju_internal_at')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["pic_internal"], 'unit_progress_details_pic_internal_index');

            $table->index(["unit_progress_id"], 'unit_progress_details_unit_progress_id_index');

            $table->index(["pic_rekanan"], 'unit_progress_details_pic_rekanan_index');
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

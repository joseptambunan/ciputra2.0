<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryCorrectionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'inventory_corrections';

    /**
     * Run the migrations.
     * @table inventory_corrections
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('no', 191)->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->string('status', 191)->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
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
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItempekerjaansTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'itempekerjaans';

    /**
     * Run the migrations.
     * @table itempekerjaans
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->integer('department_id')->nullable()->default(null);
            $table->integer('group_cost')->nullable()->default(null);
            $table->string('code', 191)->nullable()->default(null);
            $table->integer('tag')->default('0');
            $table->string('name', 191)->nullable()->default(null);
            $table->decimal('ppn', 5, 2)->default('0.00');
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->string('coa_ppn', 64)->nullable()->default(null);
            $table->integer('escrow_id')->nullable()->default(null);

            $table->index(["parent_id"], 'itempekerjaans_parent_id_index');

            $table->index(["department_id"], 'itempekerjaans_department_id_index');
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

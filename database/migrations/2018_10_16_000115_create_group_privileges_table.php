<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPrivilegesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'group_privileges';

    /**
     * Run the migrations.
     * @table group_privileges
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_group_id')->nullable()->default(null);
            $table->integer('menu_id')->nullable()->default(null);
            $table->tinyInteger('add')->default('1');
            $table->tinyInteger('edit')->default('1');
            $table->tinyInteger('delete')->default('1');
            $table->tinyInteger('view')->default('1');
            $table->tinyInteger('visible')->default('1');
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["user_group_id", "menu_id"], 'group_privileges_user_group_id_menu_id_index');
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

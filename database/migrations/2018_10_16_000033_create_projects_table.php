<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'projects';

    /**
     * Run the migrations.
     * @table projects
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('subholding')->nullable()->default(null);
            $table->integer('contactperson')->nullable()->default(null);
            $table->integer('city_id')->nullable()->default(null);
            $table->string('code', 191)->nullable()->default(null);
            $table->string('name', 191)->nullable()->default(null);
            $table->double('luas')->nullable()->default(null);
            $table->string('address', 191)->nullable()->default(null);
            $table->string('zipcode', 191)->nullable()->default(null);
            $table->string('phone', 191)->nullable()->default(null);
            $table->string('fax', 191)->nullable()->default(null);
            $table->string('email', 191)->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["contactperson", "subholding"], 'projects_contactperson_subholding_index');

            $table->index(["city_id"], 'projects_city_id_index');
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

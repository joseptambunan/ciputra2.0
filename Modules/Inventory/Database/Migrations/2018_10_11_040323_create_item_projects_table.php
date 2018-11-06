<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('default_warehouse_id')->nullable();
            $table->integer('stock_min')->nullable();
            $table->smallInteger('is_inventory')->nullable();
            $table->smallInteger('is_consumable')->nullable();
            $table->text('description')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('inactive_at')->nullable();
            $table->integer('inactive_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_projects');
    }
}

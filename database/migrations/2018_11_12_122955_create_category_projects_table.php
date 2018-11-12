<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_projects', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_detail_id')->nullable()->index('category_detail_id');
			$table->integer('unit_type_id')->nullable()->index('unit_type_id');
			$table->integer('project_id')->nullable()->index('project_id');
			$table->integer('created_by')->nullable();
			$table->timestamps();
			$table->integer('updated_by')->nullable();
			$table->date('deleted_at')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
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
		Schema::drop('category_projects');
	}

}

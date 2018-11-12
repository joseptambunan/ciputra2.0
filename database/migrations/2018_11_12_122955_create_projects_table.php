<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('subholding')->nullable();
			$table->integer('contactperson')->nullable();
			$table->integer('city_id')->nullable()->index();
			$table->string('code', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->float('luas', 10)->nullable();
			$table->string('address', 191)->nullable();
			$table->string('zipcode', 191)->nullable();
			$table->string('phone', 191)->nullable();
			$table->string('fax', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('project_id')->nullable();
			$table->integer('luas_nonpengembangan')->nullable();
			$table->index(['contactperson','subholding']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}

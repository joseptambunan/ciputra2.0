<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->nullable();
			$table->string('name', 191)->nullable();
			$table->string('luas_bangunan', 128);
			$table->string('luas_tanah', 11);
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('listrik')->nullable();
			$table->string('kode', 32)->nullable();
			$table->integer('type_id')->nullable();
			$table->string('building_class', 32)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('unit_types');
	}

}

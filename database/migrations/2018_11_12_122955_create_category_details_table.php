<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->nullable()->index('categori_id');
			$table->string('sub_type', 64)->nullable()->index('project_id');
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->decimal('percentage', 11)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_details');
	}

}

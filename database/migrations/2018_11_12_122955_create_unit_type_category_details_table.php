<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitTypeCategoryDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_type_category_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('unit_type_category_id')->nullable()->index('unit_type_category_id_2');
			$table->integer('itempekerjaan_id')->nullable()->index('itempekerjaan_id');
			$table->decimal('volume', 11)->nullable();
			$table->string('satuan', 8)->nullable();
			$table->integer('nilai')->nullable();
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->softDeletes();
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
		Schema::drop('unit_type_category_details');
	}

}

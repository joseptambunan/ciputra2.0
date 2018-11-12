<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHppUpdateDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hpp_update_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('hpp_update_id')->nullable()->index('hpp_update_id');
			$table->integer('budget_id')->nullable()->index('budget_id');
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->softDeletes();
			$table->integer('inactive_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hpp_update_details');
	}

}

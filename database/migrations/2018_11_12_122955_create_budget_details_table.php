<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBudgetDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('budget_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('budget_id')->nullable();
			$table->integer('itempekerjaan_id')->nullable();
			$table->float('nilai', 15)->nullable();
			$table->string('volume', 100)->nullable()->default('0');
			$table->string('satuan', 1000)->nullable()->default('ls');
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->index(['budget_id','itempekerjaan_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('budget_details');
	}

}

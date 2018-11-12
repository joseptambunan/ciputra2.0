<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBudgetDraftDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('budget_draft_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('budget_draft_id')->nullable();
			$table->integer('itempekerjaan_id')->nullable();
			$table->integer('nilai')->nullable();
			$table->integer('volume')->nullable();
			$table->text('satuan', 65535)->nullable();
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
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
		Schema::drop('budget_draft_details');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBudgetPeriodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('budget_periodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('budget_id')->nullable()->index();
			$table->integer('tahun')->nullable();
			$table->integer('itempekerjaan_id')->nullable()->index();
			$table->integer('volume')->nullable();
			$table->integer('satuan')->nullable();
			$table->integer('nilai')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
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
		Schema::drop('budget_periodes');
	}

}

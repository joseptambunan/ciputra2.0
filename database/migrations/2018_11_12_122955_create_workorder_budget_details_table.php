<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkorderBudgetDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workorder_budget_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('workorder_id')->nullable()->index();
			$table->integer('itempekerjaan_id')->nullable()->index();
			$table->integer('budget_tahunan_id')->nullable()->index();
			$table->integer('tahun_anggaran')->nullable();
			$table->string('volume', 191)->nullable();
			$table->string('satuan', 191)->nullable();
			$table->string('nilai', 191)->nullable();
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
		Schema::drop('workorder_budget_details');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHppDevCostReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hpp_dev_cost_reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->nullable();
			$table->integer('project_kawasan_id')->nullable();
			$table->integer('itempekerjaan')->nullable();
			$table->string('budget_awal', 24)->nullable();
			$table->string('budget_tahun', 24)->nullable();
			$table->string('kontrak_total', 24)->nullable();
			$table->string('kontrak_tahun', 24)->nullable();
			$table->string('progress_lapangan', 24)->nullable();
			$table->string('progress_bap', 24)->nullable();
			$table->string('bap_terbayar_total', 24)->nullable();
			$table->string('bap_terbayar_tahun', 24)->nullable();
			$table->string('saldo_budget_awal', 24)->nullable();
			$table->string('saldo_budget_tahun', 24)->nullable();
			$table->string('saldo_kontrak_total', 24)->nullable();
			$table->timestamps();
			$table->string('created_by', 2)->nullable()->default('1');
			$table->integer('updated_by')->nullable();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
			$table->integer('group_cost')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hpp_dev_cost_reports');
	}

}

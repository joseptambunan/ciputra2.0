<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHppConCostSummaryReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hpp_con_cost_summary_reports', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('project_id')->nullable();
			$table->integer('project_kawasan_id')->nullable();
			$table->bigInteger('total_kontrak')->nullable();
			$table->bigInteger('total_bayar')->nullable();
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->softDeletes();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->index(['project_id','project_kawasan_id'], 'project_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hpp_con_cost_summary_reports');
	}

}

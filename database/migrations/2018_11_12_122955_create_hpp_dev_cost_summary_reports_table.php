<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHppDevCostSummaryReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hpp_dev_cost_summary_reports', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('project_id')->nullable();
			$table->integer('project_kawasan_id')->nullable();
			$table->integer('efisiensi')->nullable();
			$table->float('luas_netto', 15)->nullable();
			$table->float('luas_bruto', 15)->nullable();
			$table->float('total_budget', 24)->nullable();
			$table->float('hpp_netto', 15)->nullable();
			$table->float('hpp_bruto', 15)->nullable();
			$table->float('total_kontrak', 24)->nullable();
			$table->float('hpp_kontrak_netto', 15)->nullable();
			$table->float('hpp_kontrak_bruto', 15)->nullable();
			$table->float('total_kontrak_terbayar', 24)->nullable();
			$table->float('hpp_realisasi_netto', 15)->nullable();
			$table->float('hpp_realisasi_bruto', 15)->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('delete_by')->nullable();
			$table->timestamp('inactive_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamps();
			$table->integer('inactive_by')->nullable();
			$table->dateTime('delete_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hpp_dev_cost_summary_reports');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHppConCostDetailReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hpp_con_cost_detail_reports', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('project_id')->nullable();
			$table->integer('project_kawasan_id')->nullable();
			$table->integer('unit_type_id')->nullable();
			$table->integer('total_terbangun')->nullable();
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->index(['project_id','project_kawasan_id','unit_type_id','created_by','updated_by','deleted_by','inactive_by'], 'project_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hpp_con_cost_detail_reports');
	}

}

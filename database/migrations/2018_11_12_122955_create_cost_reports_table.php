<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCostReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cost_reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->nullable();
			$table->integer('project_kawasan_id')->nullable();
			$table->integer('spk_id')->nullable();
			$table->integer('itempekerjaan')->nullable()->index('itempekerjaan');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('department')->nullable();
			$table->float('progress_lapangan', 5)->nullable();
			$table->float('progress_bap', 5)->nullable();
			$table->float('nilai', 15)->nullable();
			$table->integer('rekanan')->nullable();
			$table->integer('rekanan_type')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cost_reports');
	}

}

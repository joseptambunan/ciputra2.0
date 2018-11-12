<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBudgetTahunanPeriodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('budget_tahunan_periodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('budget_id')->nullable()->index();
			$table->integer('bulan')->nullable();
			$table->integer('itempekerjaan_id')->nullable();
			$table->integer('volume')->nullable();
			$table->string('satuan', 11)->nullable();
			$table->float('nilai', 24)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->float('januari', 10, 0)->nullable();
			$table->float('februari', 10, 0)->nullable();
			$table->float('maret', 10, 0)->nullable();
			$table->float('april', 10, 0)->nullable();
			$table->float('mei', 10, 0)->nullable();
			$table->float('juni', 10, 0)->nullable();
			$table->float('juli', 10, 0)->nullable();
			$table->float('agustus', 10, 0)->nullable();
			$table->float('september', 10, 0)->nullable();
			$table->float('oktober', 10, 0)->nullable();
			$table->float('november', 10, 0)->nullable();
			$table->float('desember', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('budget_tahunan_periodes');
	}

}

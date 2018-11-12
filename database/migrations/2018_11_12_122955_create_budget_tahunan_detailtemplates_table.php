<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBudgetTahunanDetailtemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('budget_tahunan_detailtemplates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('budget_id')->nullable()->index();
			$table->integer('template_id')->nullable()->index();
			$table->integer('itempekerjaan_id')->nullable()->index();
			$table->string('volume', 191)->nullable();
			$table->string('satuan', 191)->nullable();
			$table->string('nilai', 191)->nullable();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('budget_tahunan_detailtemplates');
	}

}

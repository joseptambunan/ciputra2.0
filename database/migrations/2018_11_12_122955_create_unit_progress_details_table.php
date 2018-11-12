<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitProgressDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_progress_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('unit_progress_id')->nullable()->index();
			$table->integer('pic_rekanan')->nullable()->index();
			$table->integer('pic_internal')->nullable()->index();
			$table->date('progress_date')->nullable();
			$table->decimal('progress_percent', 5)->nullable();
			$table->dateTime('setuju_rekanan_at')->nullable();
			$table->dateTime('setuju_internal_at')->nullable();
			$table->string('description', 191)->nullable();
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
		Schema::drop('unit_progress_details');
	}

}

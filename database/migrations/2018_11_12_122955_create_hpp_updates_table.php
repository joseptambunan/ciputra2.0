<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHppUpdatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hpp_updates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('project_id')->nullable()->index('project_id');
			$table->string('nilai_budget', 32)->nullable();
			$table->decimal('luas_book', 15)->nullable();
			$table->decimal('luas_erem', 15)->nullable();
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
			$table->integer('netto')->nullable();
			$table->integer('hpp_book')->nullable();
			$table->integer('luas_book_before')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hpp_updates');
	}

}

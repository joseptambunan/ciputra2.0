<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRabsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rabs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('workorder_id')->nullable()->index();
			$table->string('no', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->integer('flow')->default(1);
			$table->string('description', 191)->nullable();
			$table->string('notes', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('budget_tahunan_id')->nullable();
			$table->integer('parent_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rabs');
	}

}

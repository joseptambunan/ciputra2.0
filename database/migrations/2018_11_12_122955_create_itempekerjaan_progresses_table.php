<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItempekerjaanProgressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itempekerjaan_progresses', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('item_pekerjaan_id');
			$table->integer('termyn')->nullable();
			$table->integer('percentage')->nullable();
			$table->integer('created_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
			$table->integer('updated_by')->nullable();
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
		Schema::drop('itempekerjaan_progresses');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpkRetensisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('spk_retensis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('spk_id')->nullable()->index();
			$table->integer('bap_id')->nullable();
			$table->decimal('percent', 5)->nullable();
			$table->integer('hari')->nullable();
			$table->boolean('is_progress')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('status')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('spk_retensis');
	}

}

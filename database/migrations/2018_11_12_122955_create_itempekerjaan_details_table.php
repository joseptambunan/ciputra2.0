<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItempekerjaanDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itempekerjaan_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('itempekerjaan_id')->nullable()->index();
			$table->float('nilai', 15)->default(0.00);
			$table->string('satuan', 191)->nullable();
			$table->float('volume', 10)->default(0.00);
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
		Schema::drop('itempekerjaan_details');
	}

}

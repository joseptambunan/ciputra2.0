<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePtsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('city_id')->nullable()->index();
			$table->string('code', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->string('npwp', 191)->nullable();
			$table->string('phone', 191)->nullable();
			$table->string('rekening', 191)->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('pt_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pts');
	}

}

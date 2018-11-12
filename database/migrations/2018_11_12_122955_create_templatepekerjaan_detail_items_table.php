<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatepekerjaanDetailItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('templatepekerjaan_detail_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('templatepekerjaan_id')->nullable()->index();
			$table->integer('itempekerjaan_id')->nullable()->index();
			$table->string('volume', 191)->nullable();
			$table->string('satuan', 191)->nullable();
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
		Schema::drop('templatepekerjaan_detail_items');
	}

}

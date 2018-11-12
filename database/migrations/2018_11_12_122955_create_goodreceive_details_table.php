<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoodreceiveDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goodreceive_details', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('goodreceive_id')->nullable();
			$table->integer('item_id')->nullable();
			$table->integer('satuan_id')->nullable();
			$table->integer('quantity')->nullable();
			$table->float('price', 15)->nullable();
			$table->decimal('ppn', 5)->nullable();
			$table->decimal('pph', 5)->nullable();
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
		Schema::drop('goodreceive_details');
	}

}

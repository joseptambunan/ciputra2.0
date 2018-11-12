<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangreturDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barangretur_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('barangretur_id')->index();
			$table->integer('goodreceive_detail_id')->index();
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
		Schema::drop('barangretur_details');
	}

}

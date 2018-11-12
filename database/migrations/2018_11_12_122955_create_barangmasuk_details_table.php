<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangmasukDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barangmasuk_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('barangmasuk_id')->nullable();
			$table->integer('purchaseorder_detail_id')->nullable();
			$table->integer('goodreceive_detail_id')->nullable();
			$table->integer('warehouse_id')->nullable();
			$table->integer('brand_id')->nullable();
			$table->string('quantity', 191)->nullable();
			$table->float('price', 15)->nullable();
			$table->decimal('ppn', 5)->nullable();
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
		Schema::drop('barangmasuk_details');
	}

}
